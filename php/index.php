<?php
  session_start();
  $base = dirname($_SERVER['SCRIPT_NAME']);
  $page = substr($_SERVER['REQUEST_URI'], strlen($base));

  if ($_SERVER['HTTPS'])
    $base = 'https://'.$_SERVER['HTTP_HOST'].$base;
  else
    $base = 'http://'.$_SERVER['HTTP_HOST'].$base;

  mb_internal_encoding("UTF-8");
  
  $query = $_SERVER['QUERY_STRING'];
  if ($query != '')
    $page = substr($page, 0, -strlen($query)-1);
  $arguments = '';
  
  if (substr($page, 0, 5) == '/scss') {
    require('lib/scss/scss.php');
    $_SERVER['QUERY_STRING'] = substr($page, 5);
    scss_server::serveFrom('scss');
    exit();
  }
  
  include('lib/YamlConfig.php');
  $config = YamlConfig('config');
  $structure = YamlConfig('structure');
  
  
  require('lib/smarty/Smarty.class.php');
  $smarty = new Smarty;
  $smarty->setTemplateDir('templates');
  $smarty->setCompileDir('templates/compiled');
  $smarty->setCacheDir('templates/cache');
  $smarty->setConfigDir('templates/configs');

  $smarty->assign('base', $base.'/', time(), true);
  $smarty->assign('title', $title);
  $smarty->assign('structure', $structure);
  $smarty->assign('config', $config);
  $smarty->assign('page', $page);
    
  
  $data = array();

  if (substr($page, 0, 5) == "/ajax"){
    $scripts = $config['ajax'];
    $name = substr($page, 6);
    include($scripts[$name]);
  }

  $pageList = $structure['strony'];
  if ( $_SESSION['login'] ){
    $element = $pageList['main'];
    $_SESSION['db'] = $config['dbsettings'];
    $data['info'] = $_SESSION;
    $data['exportlist'] = $config['exports'];
  } else {
    $element = $pageList['login'];
  }  
  
  $template = $element['template'];
  
  if (isset($element['script']))
    include($element['script']);  

  

  if (isset($template)) {
    foreach ($data as $key=>$val)
      $smarty->assign($key, $val);

    $smarty->display($template);
  }