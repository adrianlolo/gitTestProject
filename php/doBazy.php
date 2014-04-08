<?php

include 'exportDoPliku.php';
include_once 'ibase.class.php';
// exportDoPliku.php deklaruje $filename, $tabela (moze byc tablicą)

$hosts = $_POST['bazy'];
$msg = '';

foreach ($hosts as $host) {
  if ($host){
    $db = new ibase();
    $db->dbSettings['host'] = $host;
  }
  if ( $db->dbconnect( true ) ){

    $data = file_get_contents($filename);
    $data = explode(";\n", $data);
    array_pop($data);

    foreach ($data as $line) {
      if ($line){
        $db->query($line);
        if ( !$db->result ){
          break;
        }
      }
    }

    $db->commit();
    $db->disconnect();
  } 
  else {
    $msg .= "Nie udało się nawiązać połączenia z bazą: ".$host."\n";
  }
}

if ($msg != ''){
  echo json_encode($msg);
}
else {
  $msg = "Operacja wykonana pomyślnie";
  echo json_encode($msg);
}

exit();