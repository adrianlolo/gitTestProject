<?php
// 0 -adres bazy, 1 -nazwa tabeli, 2 -sposób sortowania (1 wg symbolu, 0 wg id), 3 -user, 4 -pass
// select z polem wyboru tabeli jest w php/templates/scripts/logowanie.tpl

//jesli 1 to ustawiamy elementy wzgledem symbolu

include_once 'ibase.class.php';

$tabInfo = array(
  'bakterie' => 1,
  'kodyrozpoznan' => 0,
  'kodyprocedur' => 0
);


if ($_POST['func'] == 'reload'){
  $host = $_SESSION['host'];
  $tabela = $data['info']['tabela'] = $_SESSION['tabela'];
  $sort = $data['info']['sortowanie'] = $tabInfo[$tabela];
}
else {
  $host = $data['info']['host'];
  $tabela =  $data['info']['tabela'];
  $sort = $data['info']['sortowanie'] = $tabInfo[$tabela];
}

$db = new ibase();
$db->dbSettings['host'] = $host;

if ( $db->dbconnect() ) {
  if ( $sort ){
    $dbquery = "SELECT BAKTERIE.ID, BAKTERIE.SYMBOL, BAKTERIE.NAZWA, BAKTERIE.POZIOM, BAKTERIE.MOZNAWYBRAC, UZYWANEBAKTERIE.ID as UZYWANEID, UZYWANEBAKTERIE.OPIS FROM BAKTERIE LEFT JOIN UZYWANEBAKTERIE ON BAKTERIE.SYMBOL = UZYWANEBAKTERIE.BAKTERIA AND UZYWANEBAKTERIE.DEL = 0";
    $dbquery .= ' ORDER BY symbol';
  }
  else  {
    $dbquery = 'SELECT * FROM '.$tabela;
    $dbquery .= ' ORDER BY id';
  }

  $data['db'] = $db->fetch( 'assoc', $dbquery );

  if ($tabela == 'bakterie'){
    $dbquery =
      "SELECT GRUPYBAKTERII.ID, GRUPYBAKTERII.NAZWA, GRUPYBAKTERII.MECHANIZMOPORNOSCIOWY".
      " FROM GRUPYBAKTERII".
      " WHERE GRUPYBAKTERII.DEL = 0".
      " ORDER BY GRUPYBAKTERII.MECHANIZMOPORNOSCIOWY DESC, GRUPYBAKTERII.NAZWA";

    $data['grupybakterii'] = $db->fetch( 'assoc', $dbquery );

  }


  $query = 'SELECT MAX(id) FROM '.$tabela;
  $temp = $db->fetch('assoc', $query);
  $data['info']['max'] = $temp[0]['MAX'];
  file_put_contents("log.txt", json_encode($data['info']['max'], JSON_PRETTY_PRINT));

  if ( $tabela == 'bakterie' || $tabela =='kodyrozpoznan' || $tabela = 'kodyprocedur'){
    $query = "select symbol, nazwa from ".$tabela." where id=0";
    $db->query( $query );
    $col = ibase_field_info( $db->result, 0 );
    $data['info']['symbolLen'] = $col['length']/4;
    $col = ibase_field_info( $db->result, 1 );
    $data['info']['nazwaLen'] = $col['length']/4;

    $query = "select opis from uzywanebakterie where id=0";
    $db->query( $query );
    $col = ibase_field_info( $db->result, 0 );
    $data['info']['opisLen'] = $col['length']/4;
  }

  $db->freeResult();

  if ($_POST['func'] == 'reload'){
    $ISPARENT = '';
    $parentsArray = array();
    foreach($data['db'] as $i => $record){
      $record['ISPARENT'] = '';
      $record['PREFIX'] = '';
      $record['SYMBOLPART'] = '';
      $record['LASTCHILD'] = 0;
      $record['PRZYPISANEGRUPY'] = array();

      if ($ISPARENT != ''){
        $record["PREFIX"] = $ISPARENT;
        $record["SYMBOLPART"] = substr( $record['SYMBOL'], strlen($ISPARENT) );
      }
      if ($record['POZIOM'] < $data['db'][$i+1]['POZIOM']){
        $record['ISPARENT'] = 1;
        $parentsArray[ $record['POZIOM'] ] = $ISPARENT = $record['SYMBOL'];
      }
      else if ($record['POZIOM'] > $data['db'][$i+1]['POZIOM']){
        $record['LASTCHILD'] = ($record['POZIOM'] - $data['db'][$i+1]['POZIOM']);

        if ( $record['POZIOM'] > 1 ){
          $ISPARENT = ( $data['db'][$i+1]['POZIOM'] > 0 ) ? $parentsArray[ $data['db'][$i+1]['POZIOM']-1 ] : '' ;
          $parentsArray = array_slice( $parentsArray, 0, $data['db'][$i+1]['POZIOM'] );
        }
        else
          $ISPARENT = '';
      }

      if ($record['UZYWANEID'] != null){

        $query = "SELECT grupa FROM bakteriewgrupach WHERE del=0 AND bakteria=".$record['UZYWANEID'];
        $j = 0;

        $db->fetch('row', $query);
        if ($db->fetchedLen > 1){
          foreach ( $db->fetched as $row) {
            $resultArray[$j++] = $row[0];
          }
          $record['PRZYPISANEGRUPY'] = $resultArray;
        }
      }
      $data['db'][$i] = array_change_key_case($record);
    }

    echo json_encode($data);

    $db->disconnect();
    exit();
  }
}

