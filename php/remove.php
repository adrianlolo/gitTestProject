<?php
  $query = '';
  if ($func=='remove'){
      $query .= "DELETE FROM ".$tabela." WHERE id IN (".$ids.")";
  }
