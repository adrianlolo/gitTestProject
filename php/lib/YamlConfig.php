<?php

function YamlConfig($name, $define = false) {
  $result = null;
  $cache = 'cfg/cfg_cache';
  $out = $cache.'/'.$name.'.vars';
  if (is_file($out)) {
    $mtime = filemtime($out);
    if (filemtime('cfg/'.$name.'.yml') <= $mtime)
      $result = unserialize(file_get_contents($out));
  }

  if (!isset($result)) {
    include_once('lib/yaml/sfYamlParser.php');
    $file = file_get_contents('cfg/'.$name.'.yml');
    $yaml = new sfYamlParser();
    $result = $yaml->parse($file);
    if (!is_dir($cache))
      @mkdir($cache);
    @file_put_contents($out, serialize($result));
  }

  if ($define)
    foreach ($result as $key=>$val)
      if (!is_array($val))
        define($key, $val);

  return $result;
}
