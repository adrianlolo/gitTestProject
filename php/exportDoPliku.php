<?php
  // 0 -adres bazy, 1 -nazwa tabeli, 2 -sposób sortowania (1 wg symbolu, 0 wg id), 3 -user, 4 -pass
  // select z polem wyboru tabeli jest w php/templates/scripts/logowanie.tpl 

//jesli 1 to ustawiamy elementy wzgledem symbol
function createSql($tabela, &$result, &$sql){
  $count = 1;
  $sql .= "DELETE FROM ".$tabela.";\n";
  while ($row = ibase_fetch_row($result)){
    if ($tabela == 'uzywanebakterie')
      $sql .= 'insert into '.$tabela.' (id,bakteria,opis) values (';
    elseif ($tabela == 'bakteriewgrupach')
      $sql .= 'insert into '. $tabela .' (id,bakteria,grupa) values (';
    elseif ($tabela == 'grupybakterii')
      $sql .= 'insert into '.$tabela.' (id, symbol, nazwa, mechanizmopornosciowy, opis) values (';
    else
      $sql .= 'insert into '.$tabela.' (id,symbol,nazwa,poziom,moznawybrac) values (';

    for ($i = 0; $i < count($row); $i++) {
      $value = $row[$i];
      if ($i == 0){
        if ( $tabela == 'bakterie' || $tabela == 'uzywanebakterie' || $tabela == 'bakteriewgrupach'  || $tabela == 'grupybakterii' )
          $sql .= 'GEN_ID(GenSlowniki, 1)';  
        else
          $sql .= ''.$count; 
      }
      elseif (is_numeric($value)) {
        $sql .= $value; 
      }
      else {
        if ($tabela == 'bakteriewgrupach' && $i == count($row)-1 ){
          $sql .= "(select id from GRUPYBAKTERII where symbol='".$value."')";
        }
        else
          $sql .= "'".str_replace("'", "''", $value)."'";
      }

      if ($i < count($row)-1)
        $sql .=','; 
    }
    $sql .= ");\n";
    $count++;
  }
}


//include('lib/YamlConfig.php');
$config = YamlConfig('config');

$tabele = $config['exports'];
$tabela = $tabele[$_POST['tabela']]['table'];

$sql = '';

$host = $_SESSION['host'];

$db = new ibase();
$db->dbSettings['host'] = $host;

if ( $db->dbconnect() ) {
  if (is_array($tabela)){
    foreach ($tabela as $v) {
      if ($v == 'uzywanebakterie')
        $dbquery = 'SELECT id, bakteria, opis FROM '.$v.' WHERE del=0 ORDER BY id';
      elseif ($v == 'bakteriewgrupach'){
        $dbquery = 'SELECT BAKTERIEWGRUPACH.ID,BAKTERIEWGRUPACH.BAKTERIA,GRUPYBAKTERII.SYMBOL AS SYMBOLGRUPY '.
                  ' FROM BAKTERIEWGRUPACH'.
                  ' LEFT JOIN GRUPYBAKTERII ON ( BAKTERIEWGRUPACH.GRUPA = GRUPYBAKTERII.ID)'.
                  ' WHERE BAKTERIEWGRUPACH.DEL=0';
      }
      elseif ($v == 'grupybakterii'){
          $dbquery = 'SELECT id, symbol, nazwa, mechanizmopornosciowy, opis from '.$v.' where del=0';
      }
      else
        $dbquery = 'SELECT * FROM '.$v.' ORDER BY id';

      $db->query( $dbquery );
      createSql($v,$db->result,$sql);
    }
  } else {
    if ($tabela == 'uzywanebakterie')
      $dbquery = 'SELECT id, bakteria, opis FROM '.$tabela.' ORDER BY id';
    elseif ($tabela == 'bakteriewgrupach'){
      $dbquery = 'SELECT BAKTERIEWGRUPACH.ID,BAKTERIEWGRUPACH.BAKTERIA,GRUPYBAKTERII.SYMBOL AS SYMBOLGRUPY '.
                ' FROM BAKTERIEWGRUPACH'.
                ' LEFT JOIN GRUPYBAKTERII ON ( BAKTERIEWGRUPACH.GRUPA = GRUPYBAKTERII.ID)'.
                ' WHERE BAKTERIEWGRUPACH.DEL=0';
    }
    elseif ($tabela == 'grupybakterii'){
      $dbquery = 'SELECT id, symbol, nazwa, mechanizmopornosciowy, opis from '.$tabela.' where del=0';
    }
    else
      $dbquery = 'SELECT * FROM '.$tabela.' ORDER BY id';

    $db->query( $dbquery );
    createSql($tabela,$db->result,$sql);
  }

  
  $filename = '';
  
  if (is_array($tabela)){
    for ($i=0; $i < count($tabela); $i++) {
      if ($i == 0)
        $filename .= $tabela[$i];
      else
        $filename .= '_'.$tabela[$i];
    }
    $filename .= '.sql';
  }
  else 
    $filename = $tabela.'.sql';

  $filename = "exports/".$filename;

  $db->commit();
  $db->disconnect();

  $sql = iconv('UTF-8', 'Windows-1250', $sql);
  file_put_contents($filename, $sql);
}
