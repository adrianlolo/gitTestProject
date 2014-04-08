<?php
$msg = '';


if ($func == 'loadBakterieWGrupach'){
  $bakteria = $_POST['bakteria'];

  $query = "SELECT grupa FROM bakteriewgrupach WHERE del=0 AND bakteria=".$bakteria;
  $i = 0;

  $db->fetch('row', $query);
  $resultArray = array(
    0 => "empty"
  );

  if ($db->fetchedLen > 1){
    foreach ( $db->fetched as $row) {
      $resultArray[$i++] = $row[0];
    }
  }
  echo json_encode($resultArray);
  $query = ''; //nie wykona sie po wyjsciu ze skryptu
}

if ($func == 'opis'){
  $grupy = $_POST['grupy'];
  $uzywaneId = $_POST['uzywaneid'];

  $query = "SELECT grupa FROM bakteriewgrupach WHERE del=0 AND bakteria=".$uzywaneId;

  $resultArray = $db->fetch('row', $query);
  $grupyArray = explode(",", $grupy);

  $i = 0;
  foreach ( $resultArray as $res ){
    $resultArray[$i++] = $res[0];
  }
  foreach ($grupyArray as $key =>$value) {
    $grupyArray[$key] = intval($value);
  }

  $difference = array();

  // Dodanie nowych
  $difference = array_diff($grupyArray, $resultArray);
  foreach ($difference as $diff_grupa) {
    $query = "INSERT INTO bakteriewgrupach (id, del, dc, dd, pc, pd, bakteria, grupa) values (GEN_ID(GenSlowniki, 1),0,current_timestamp,NULL,0,NULL,".$uzywaneId.",".$diff_grupa.")";
    $db->query( $query );
  }

  // Usuniecie niechcianych
  $difference = array_diff($resultArray, $grupyArray);
  foreach ($difference as $diff_grupa) {
    $query = "UPDATE bakteriewgrupach SET del=id, dd=current_timestamp,pd=0 WHERE bakteria='".$uzywaneId."' AND del = 0 AND grupa=".$diff_grupa;
    $db->query( $query );
  }

  $query = "UPDATE uzywanebakterie SET opis='".$opis."' WHERE bakteria='".$symbol."' AND del = 0";
  file_put_contents("x.txt", $query);
}
elseif ($func == 'nowyOpis') {
  $query = "INSERT INTO uzywanebakterie (id,del,dc,dd,pc,pd,bakteria,opis) VALUES (GEN_ID(GenSlowniki, 1),0,current_timestamp,NULL,0,NULL,'".$symbol."','')";
}
elseif ($func == 'usunOpis') {
  $query = "UPDATE uzywanebakterie SET del=id, dd=current_timestamp,pd=0 WHERE bakteria='".$symbol."' AND del = 0";
}
elseif ($func == 'actualizeHtmlElement'){
  $symbol = $_POST['symbol'];
  $query = "SELECT id FROM uzywanebakterie  WHERE del=0 and bakteria='".$symbol."'";

  $value = $db->fetch('assoc', $query);
  echo json_encode($value['ID']);
  $query = '';
}