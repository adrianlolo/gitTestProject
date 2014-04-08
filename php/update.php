<?php

$stary = $_POST['oldSymbol'];
$nowy = $_POST['newSymbol'];
$roznicaPoziomow = $_POST['roznicaPoziomow'];
$nazwa = $_POST['nazwa'];
$moznawybrac = $_POST['moznawybrac'];
$id = $_POST['id'];
$uzywaneId = $_POST['uzywaneid'];

if ( $func=='edit' ){
  if ( $sortowanie ){
    if ( $stary != $nowy ){
      $query = "UPDATE bakterie SET symbol=replace(symbol, '".$stary."', '".$nowy."'), poziom=poziom+".$roznicaPoziomow." WHERE symbol LIKE '".$stary."_%'";
      $db->query( $query );

      if ( $uzywaneId ){
        $query = "UPDATE uzywanebakterie SET bakteria=replace(bakteria, '".$stary."', '".$nowy."') WHERE bakteria LIKE '".$stary."_%' AND del=0";
        $db->query( $query );
      }
    }
    $query = "UPDATE ".$tabela." SET nazwa='".$nazwa."', moznawybrac=".$moznawybrac." WHERE id=".$id;
  }
  else {
    $query = "UPDATE ".$tabela." SET sybmol='".$nowy."', nazwa='".$nazwa."', poziom=poziom+".$roznicaPoziomow.", moznawybrac=".$moznawybrac." WHERE id=".$id;
  }
}

if ( $func == 'aktualizujSymbole' ){

  $query = "UPDATE bakterie SET symbol=replace(symbol, '".$stary."', '".$nowy."') WHERE symbol LIKE '".$stary."_%'";

}

if ( $func == 'aktualizujLevele' ){
  $query = "UPDATE ".$tabela." SET poziom=poziom+".$roznica." WHERE id IN (".$ids.")";
}
