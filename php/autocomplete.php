<?php
  
$file = 'cfg/autocomplete.txt';
$text = file_get_contents($file);

$replace = str_replace("'", "", str_replace("\\\\", "\\", $text));

$data['tags'] = $text;
$data['tagsArray'] = array_slice(explode(',', $replace), 0, 10);
$data['tabele'] = $config['tabele']; 
