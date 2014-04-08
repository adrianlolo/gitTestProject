<?php

  include 'ibase.class.php';

  $tabInfo = array(
    'bakterie' => 1,
    'kodyrozpoznan' => 0,
    'kodyprocedur' => 0
  );

  $host = $_SESSION['host'];
  
  $tabela = $_SESSION['tabela'];
  $sortowanie = $tabInfo[$tabela];
  $func = $_POST['func'];
  $file = $_POST['file'];
  $reload = $_POST['reload'];

  if ( $func == 'opis' || $func == 'setOpis' || $func == ''){
    $symbol = $_POST['symbol'];
    $opis = $_POST['opis'];
  } 
  elseif ($func == 'remove'){
    $ids = $_POST['ids'];
  } 
  else {
    $maxId = $_POST['maxId'];    
    $id = $_POST['id'];
    if (!$id) 
      $id = $maxId;
    $symbol = $_POST['prefix'].$_POST['symbol'];
    $nazwa = $_POST['nazwa'];
    $poziom = $_POST['poziom'];
    if (!$poziom)
      $poziom = 0;
  }
  
  // Zastapienie ' na '' do bazy fb
if (isset($symbol))
  $symbol = trim( strtoupper( htmlspecialchars_decode( str_replace("'", "''", $symbol) ) ) );
if (isset($nazwa))
  $nazwa =  htmlspecialchars_decode( str_replace("'", "''", $nazwa) );
if (isset($opis))
  $opis =  htmlspecialchars_decode( str_replace("'", "''", $opis) );

$db = new ibase();
$db->dbSettings['host'] = $host; //user i pass pobrane sa z confgiu

if ( $db->dbconnect(true) ){

  if ($_POST['moznawybrac'])
    $moznawybrac = $_POST['moznawybrac'];
  else
    $moznawybrac = 0;

  // zalaczenie pliku
  include($file);

  if ($query != ''){
    $db->query( $query );
  }
  $db->commit();
  $db->disconnect();

}
else {
  echo 'Problem z połączeniem z bazą';
}

exit();
