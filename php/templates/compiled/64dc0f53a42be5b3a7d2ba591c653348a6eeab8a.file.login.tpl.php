<?php /* Smarty version Smarty-3.1.13, created on 2014-03-27 10:55:38
         compiled from "templates\login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1836352ca7fa970edc6-43088591%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64dc0f53a42be5b3a7d2ba591c653348a6eeab8a' => 
    array (
      0 => 'templates\\login.tpl',
      1 => 1391776678,
      2 => 'file',
    ),
    '43964ca51c96849d64bd4d6c4770323543e3193e' => 
    array (
      0 => 'templates\\layout.tpl',
      1 => 1395075543,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1836352ca7fa970edc6-43088591',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52ca7fa97d9ff8_10951793',
  'variables' => 
  array (
    'base' => 1395914138,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ca7fa97d9ff8_10951793')) {function content_52ca7fa97d9ff8_10951793($_smarty_tpl) {?><!DOCTYPE html>
<html lang="pl">
<head>
  <title>Panel edycji</title>
  <base href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
"/>
  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="keywords" content=""/>
  <meta name="description" content=""/>
  
  <link rel="icon" href="img/favicon.ico"/> 
  <link href="css/bootstrap.min.css" rel="stylesheet"/>
  <link href="css/font-awesome.min.css" rel="stylesheet"/>
  <link href="css/jquery-ui.min.css" rel="stylesheet"/>
  <!--[if IE 7]>
    <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
  <![endif]-->
  <!--[if !IE 7]>
    <style type="text/css">
      #wrap {
        display:table;
        height:100%
      }
    </style>
  <![endif]-->
  
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.simplemodal.min.js"></script>
  <script src="js/handlebars.js"></script>
  <script src="js/shuffle.min.js"></script>

  <link href="scss/style.scss" rel="stylesheet" type="text/css"/>
  <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"> -->
</head>
<body>
  
    <script>
    var availableTags = [
          <?php echo $_smarty_tpl->tpl_vars['tags']->value;?>

        ];
    
      $(document).ready(function() {
        $( "#db" ).autocomplete({
          source: availableTags
        });
      });
      jQuery(document).ready(function($) {
        $('.baza').click(function() {
          $('#db').val($(this).text());
        });
      });
    </script>
    
    <div class="loginForm">
      <div class="titleBar">Panel logowania</div>
      <form class="form" action="ajax/login" method="POST">
        <div class="control-group">
          <label class="control-label" for="db">Adres bazy</label>
          <div class="controls">
            <input type="text" id="db" name="db" required>
          </div>
        </div>
        <div id="listaBaz">
          <ul>
            <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tagsArray']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value){
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
              <li class="baza"><?php echo $_smarty_tpl->tpl_vars['t']->value;?>
</li>
            <?php } ?>
          </ul>
        </div>
        <div class="control-group">
          <label class="control-label" for="table">Tabela</label>
          <div class="controls">
            <select name="tabela" id="tabela">
              <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tabele']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value){
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['t']->value['name'];?>
"><?php echo $_smarty_tpl->tpl_vars['t']->value['caption'];?>
</option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn">Załaduj</button>
          </div>
        </div>
      </form>
    </div>

</body>
</html><?php }} ?>