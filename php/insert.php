<?php

$query = '';
// before, after, group
// sortowanie = 1 to po symbolu

function prepareTable(&$id, $func){
  global $db, $tabela;

  if ($func == 'after' || $func == 'group'){
    $id = $id + 1;
  }

  $preparetable = "UPDATE ".$tabela." SET id = -(id+1) WHERE id >=".$id;
  $db->query( $preparetable );
  $preparetable = "UPDATE ".$tabela." SET id = -id WHERE id < 0";
  $db->query( $preparetable );

  if ( $db->result )
    return true;
  else
    return false;
}

if ($sortowanie == 0){
  if (prepareTable($id, $func)){
    $query = "INSERT INTO ".$tabela." (id,symbol,nazwa,poziom,moznawybrac) VALUES (".$id.",'".$symbol."','".$nazwa."',".$poziom.",".$moznawybrac.")";
  }
}
elseif ($sortowanie == 1 ){
  $query = "INSERT INTO ".$tabela." (id,symbol,nazwa,poziom,moznawybrac) VALUES (GEN_ID(GenSlowniki, 1),'".$symbol."','".$nazwa."',".$poziom.",".$moznawybrac.")";
}