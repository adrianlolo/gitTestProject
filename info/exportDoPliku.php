<?php
  // 0 -adres bazy, 1 -nazwa tabeli, 2 -sposób sortowania (1 wg symbolu, 0 wg id), 3 -user, 4 -pass
  // select z polem wyboru tabeli jest w php/templates/scripts/logowanie.tpl 

//jesli 1 to ustawiamy elementy wzgledem symbolu
function createSql($tabela, &$result, &$sql){
  $count = 1;
  while ($row = ibase_fetch_row($result)){
    if ($tabela == 'uzywanebakterie')
      $sql .= 'insert into '.$tabela.' (id,bakteria,opis) values (';
    else
      $sql .= 'insert into '.$tabela.' (id,symbol,nazwa,poziom,moznawybrac) values (';

    for ($i = 0; $i < count($row); $i++) {
      $value = $row[$i];
      
      if ($i == 0){
        if ($tabela == 'bakterie' || $tabela == 'uzywanebakterie')
          $sql .= 'GEN_ID(GenSlowniki, 1)';  
        else
          $sql .= ''.$count; 
      }
      elseif (is_numeric($value)) {
        $sql .= $value; 
      }
      else {
        $sql .= "'".str_replace("'", "''", $value)."'";
      }

      if ($i < count($row)-1)
        $sql .=','; 
    }
    $sql .= ");\n";
    $count++;
  }
}



$config = YamlConfig('config');


//$tabele = array('bakterie', 'uzywanebakterie',array('bakterie', 'uzywanebakterie'), 'kodyrozpoznan');
$tabele = $config['exports'];
$tabela = $tabele[$_POST['tabela']]['table'];

$sql = '';

$host = $_SESSION['host'];
if ($host){
  $user = $_SESSION['db']['user'];
  $pass = $_SESSION['db']['pass'];
  $db = ibase_connect($host, $user, $pass, 'UTF8');
}

if ($db) {
  if (is_array($tabela)){
    foreach ($tabela as $v) {
      if ($v == 'uzywanebakterie')
        $dbquery = 'SELECT id, bakteria, opis FROM '.$v.' ORDER BY id';
      else
        $dbquery = 'SELECT * FROM '.$v.' ORDER BY id';
      
      $sql .= "DELETE FROM ".$v.";\n";
      $result = ibase_query($db, $dbquery);
      createSql($v,$result,$sql);
    }
  } else {
    if ($tabela == 'uzywanebakterie')
      $dbquery = 'SELECT id, bakteria, opis FROM '.$tabela.' ORDER BY id';
    else
      $dbquery = 'SELECT * FROM '.$tabela.' ORDER BY id';
    
    $sql .= "DELETE FROM ".$tabela.";\n";
    $result = ibase_query($db, $dbquery);
    createSql($tabela,$result,$sql);
  }

  ibase_free_result($result);
  ibase_close($db);
  file_put_contents($filename, $sql);
}
