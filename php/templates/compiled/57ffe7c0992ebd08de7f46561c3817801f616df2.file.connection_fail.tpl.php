<?php /* Smarty version Smarty-3.1.13, created on 2014-02-20 12:54:42
         compiled from "templates\connection_fail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155975305e78831fc40-55889869%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57ffe7c0992ebd08de7f46561c3817801f616df2' => 
    array (
      0 => 'templates\\connection_fail.tpl',
      1 => 1392897279,
      2 => 'file',
    ),
    '43964ca51c96849d64bd4d6c4770323543e3193e' => 
    array (
      0 => 'templates\\layout.tpl',
      1 => 1390244552,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155975305e78831fc40-55889869',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5305e7883622d0_97385218',
  'variables' => 
  array (
    'base' => 1392897282,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5305e7883622d0_97385218')) {function content_5305e7883622d0_97385218($_smarty_tpl) {?><!DOCTYPE html>
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

  <link href="scss/style.scss" rel="stylesheet" type="text/css"/>
  <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"> -->
</head>
<body>
  
<div class="container">
  <h4>Nie udało się nawiązać połączenia z bazą</h4>
  <br>
  <p><b>Dane połączenia:</b></p>
  <table>
    <tr>
      <td>Baza:</td>
      <td><b><?php echo $_smarty_tpl->tpl_vars['fail']->value['db'];?>
</b></td>
    </tr>
    <tr>
      <td>User:</td>
      <td><b><?php echo $_smarty_tpl->tpl_vars['fail']->value['user'];?>
</b></td>
    </tr>
    <tr>
      <td>Pass:</td>
      <td><b><?php echo $_smarty_tpl->tpl_vars['fail']->value['pass'];?>
</b></td>
    </tr>
  </table>
  <br>  
  <p>
    <a class="tool btn logout" href="ajax/logout" id="logout">Wróć do wyboru bazy</a>
  </p>
</div>

</body>
</html><?php }} ?>