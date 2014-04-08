<?php /* Smarty version Smarty-3.1.13, created on 2014-04-02 17:55:08
         compiled from "templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:936752ca8647113199-44292478%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6aae8c641d21506c83b2eef3095b796e7ec90482' => 
    array (
      0 => 'templates\\main.tpl',
      1 => 1391186230,
      2 => 'file',
    ),
    '43964ca51c96849d64bd4d6c4770323543e3193e' => 
    array (
      0 => 'templates\\layout.tpl',
      1 => 1395075543,
      2 => 'file',
    ),
    'e9cf85dca2bab446fb1e0b094041ddef8b822660' => 
    array (
      0 => 'templates\\scripts\\toolbox.tpl',
      1 => 1391952014,
      2 => 'file',
    ),
    'e604d21ce8ddeeb1bd46af4f7fb55859fddd5723' => 
    array (
      0 => 'templates\\scripts\\lista.tpl',
      1 => 1396454097,
      2 => 'file',
    ),
    '07da79ace0382a52fa21446496740bdfe349e611' => 
    array (
      0 => 'templates\\scripts\\modal.tpl',
      1 => 1395046070,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '936752ca8647113199-44292478',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52ca86471e2242_18643786',
  'variables' => 
  array (
    'base' => 1396454108,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ca86471e2242_18643786')) {function content_52ca86471e2242_18643786($_smarty_tpl) {?><!DOCTYPE html>
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
  
<div class="container-fluid toolbar"> 
  <div class="row-fluid" >
    <?php /*  Call merged included template "scripts/toolbox.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("scripts/toolbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '936752ca8647113199-44292478');
content_533c32dcf13250_94157366($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "scripts/toolbox.tpl" */?>
  </div>
</div>
<div class="container-fluid" id="content"> 
  <div class="row-fluid">
    <?php /*  Call merged included template "scripts/lista.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("scripts/lista.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '936752ca8647113199-44292478');
content_533c32dcf26ad4_19672400($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "scripts/lista.tpl" */?>
  </div>
</div>
<script src="js/editor.js"></script>
<?php /*  Call merged included template "scripts/modal.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate("scripts/modal.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '936752ca8647113199-44292478');
content_533c32dd02abe1_60017950($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "scripts/modal.tpl" */?>

</body>
</html><?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2014-04-02 17:55:08
         compiled from "templates\scripts\toolbox.tpl" */ ?>
<?php if ($_valid && !is_callable('content_533c32dcf13250_94157366')) {function content_533c32dcf13250_94157366($_smarty_tpl) {?><div id="toolbox" class="btn-toolbar">
  <div class="editButtons pull-left">
    <!-- <div class="btn-group">
      <a class="tool btn btn-id" id="multiselect">Multiselect</a>
      <a class="tool btn btn-id" id="groupSelection">Zaznaczaj grupy</a>
      <a class="tool btn btn-id" id="deselectAll">Odznacz wszystko</a>
      <a class="tool btn btn-id" id="selectAll">Zaznacz wszystko</a>
      <a class="tool btn btn-id" id="reverseSelection">Odwróć zaznaczenie</a>
    </div> -->

    <?php if ($_smarty_tpl->tpl_vars['info']->value['sortowanie']==1){?>
    <div class="btn-group">
      <a class="tool btn btn-primary add" data-script="ajax/api" data-file="insert.php" data-func="add">Dodaj</a>
      <a class="tool btn btn-primary add" disabled="disabled" data-script="ajax/api" data-file="insert.php" data-func="group">Dodaj do grupy</a>
    </div>
    <?php }else{ ?>
    <div class="btn-group">
      <a class="tool btn btn-primary add" data-script="ajax/api" data-file="insert.php" data-func="before">Dodaj</a> <!-- dodaj przed jak zaznaczone -->
      <a class="tool btn btn-primary add" disabled="disabled" data-script="ajax/api" data-file="insert.php" data-func="after">Dodaj po</a>
      <a class="tool btn btn-primary add" disabled="disabled" data-script="ajax/api" data-file="insert.php" data-func="group">Dodaj do grupy</a>
    </div>
    <?php }?>
    <div class="btn-group">
      <a class="tool btn btn-success edit" disabled="disabled" data-script="ajax/api" data-file="update.php" data-func="edit">Edytuj</a>
      <?php if ($_smarty_tpl->tpl_vars['info']->value['sortowanie']==1){?>
      <a class="tool btn btn-success opis" disabled="disabled" data-script="ajax/api" data-file="opis.php" data-func="opis">Opis</a>
      <?php }?>
    </div>
    <div class="btn-group">
      <a class="tool btn btn-danger remove" disabled="disabled" data-script="ajax/api" data-file="remove.php" data-func="remove">Usuń</a>
    </div>
    <div class="btn-group">
      <a class="tool btn export" data-script="ajax/api" data-file="export.php" data-func="export">Eksportuj</a>
      <a class="tool btn logout" href="ajax/logout" id="logout">Zmień bazę/tabelę</a>
    </div>
  </div>
</div>  <?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2014-04-02 17:55:08
         compiled from "templates\scripts\lista.tpl" */ ?>
<?php if ($_valid && !is_callable('content_533c32dcf26ad4_19672400')) {function content_533c32dcf26ad4_19672400($_smarty_tpl) {?>

<div class="listPlaceholder" data-tabela='<?php echo $_smarty_tpl->tpl_vars['info']->value['tabela'];?>
' data-maxId='<?php echo $_smarty_tpl->tpl_vars['info']->value['max'];?>
' data-sortowanie='<?php echo $_smarty_tpl->tpl_vars['info']->value['sortowanie'];?>
'>
  <ol id='selectable'>
    <?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['result']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['db']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value){
$_smarty_tpl->tpl_vars['result']->_loop = true;
?>
      <div class="grupa level-<?php echo $_smarty_tpl->tpl_vars['result']->value['POZIOM'];?>
">
        <?php if ($_smarty_tpl->tpl_vars['result']->value['POZIOM']<$_smarty_tpl->tpl_vars['db']->value[$_smarty_tpl->tpl_vars['result']->key+1]['POZIOM']){?>
          <span class="plus"><i class="icon-expand-alt"></i></span>
        <?php }?>
        <li class="elem <?php if ($_smarty_tpl->tpl_vars['result']->value['POZIOM']<$_smarty_tpl->tpl_vars['db']->value[$_smarty_tpl->tpl_vars['result']->key+1]['POZIOM']){?>parent<?php }?><?php if ($_smarty_tpl->tpl_vars['result']->value['MOZNAWYBRAC']==0){?> niewybieralne<?php }?>">
          <?php if ($_smarty_tpl->tpl_vars['info']->value['tabela']=='bakterie'){?>
            <input class="uzywane" type="checkbox" <?php if ($_smarty_tpl->tpl_vars['result']->value['UZYWANEID']){?>checked="checked"<?php }?>>
          <?php }?>
          <span class="symbol">(<?php echo $_smarty_tpl->tpl_vars['result']->value['SYMBOL'];?>
)</span>
          <span class="nazwa"><?php echo $_smarty_tpl->tpl_vars['result']->value['NAZWA'];?>
</span>
        </li>
      </div>
    <?php } ?>
  </ol>
</div>
<div id="template" style="display: none"></div><?php }} ?><?php /* Smarty version Smarty-3.1.13, created on 2014-04-02 17:55:09
         compiled from "templates\scripts\modal.tpl" */ ?>
<?php if ($_valid && !is_callable('content_533c32dd02abe1_60017950')) {function content_533c32dd02abe1_60017950($_smarty_tpl) {?><div id="edit-dialog" title="Edytor wpisów">
  <p class="validateTips"></p>

  <form>
  <fieldset>
    <label for="symbol">Symbol</label>
    <p id="prefix" class="text ui-widget-content ui-corner-all"></p>
    <input type="text" name="symbol" id="symbol" class="text ui-widget-content ui-corner-all">
    <label for="nazwa">Nazwa</label>
    <input type="text" name="nazwa" id="nazwa" value="" class="text ui-widget-content ui-corner-all input-block-level">
    <label for="moznawybrac">Wybieralne</label>
    <input type="checkbox" name="moznawybrac" id="moznawybrac" value="1" class="text ui-widget-content ui-corner-all">
    <input type="text" style="display:none" id="id" name="id">
    <input type="text" style="display:none" id="poziom" name="poziom">
    <input type="text" style="display:none" id="file" name="file">
    <input type="text" style="display:none" id="func" name="func">
  </fieldset>
  </form>
</div>

<div id="opis-dialog" title="Edytor opisów">
  <p class="validateTips"></p>

  <form>
  <fieldset>
    <label for="symbol">Bakteria</label>
    <p id="opisPrefix" class="text ui-widget-content ui-corner-all"></p>
    <input type="text" name="symbol" id="opisSymbol" style="display:none" class="text ui-widget-content ui-corner-all">
    
    <label for="symbol">Opis</label>
    <textarea name="opis" id="opis" class="span5" rows="5"></textarea>
    <input type="text" style="display:none" id="opisFile" name="file">
    <input type="text" style="display:none" id="opisFunc" name="func">
    <input type="text" style="display:none" id="opisUzywaneId" name="uzywaneid">
    <label for="checkboxListId">Grupy bakterii</label>
    <div id="checkboxListId" class="checkboxList">
      <ol>
        <?php  $_smarty_tpl->tpl_vars['grupa'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['grupa']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['grupybakterii']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['grupa']->key => $_smarty_tpl->tpl_vars['grupa']->value){
$_smarty_tpl->tpl_vars['grupa']->_loop = true;
?>
          <li class="checkboxGrupyBakterii" data-id="<?php echo $_smarty_tpl->tpl_vars['grupa']->value['ID'];?>
">
            <input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['grupa']->value['ID'];?>
" class="checkboxGrupy">
            <span class="nazwaGrupy"><?php echo $_smarty_tpl->tpl_vars['grupa']->value['NAZWA'];?>
</span>
          </li>
        <?php } ?>
      </ol>
    </div>
  </fieldset>
  </form>
</div>

<div id="export-dialog" title="Eksport bazy">
  <p class="validateTips"></p>

  <fieldset>
    <form action="ajax/download" method="post">  
      <div class="row-fluid">
        <div class="exportSection">
          <p>Wybierz tabele którą chcesz eksporotwać</p>
          <select name="tabela" id="tabele">
            <?php  $_smarty_tpl->tpl_vars['e'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['e']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['exportlist']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['e']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['e']->key => $_smarty_tpl->tpl_vars['e']->value){
$_smarty_tpl->tpl_vars['e']->_loop = true;
 $_smarty_tpl->tpl_vars['e']->index++;
?>
              <option value="<?php echo $_smarty_tpl->tpl_vars['e']->index;?>
"><?php echo $_smarty_tpl->tpl_vars['e']->value['caption'];?>
</option>
            <?php } ?>
          </select>
        </div>  
      </div>  
      <div class="row-fluid">
        <div class="exportSection" id="doPliku">
          <button type="submit" class="btn">Eksportuj do pliku</button>
        </div>
      </div>
    </form>
    <div class="row-fluid">
      <div class="exportSection" id="doBazy">
        <div>  
          <div class="span5">
            <h4>Bazy do wyboru</h4>
            <div id="listaBaz">
              <ol class="multiselectBaz poleWyboru">
                <?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['tagsArray']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value){
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
                  <li class="baza"><?php echo $_smarty_tpl->tpl_vars['t']->value;?>
</li>
                <?php } ?>
              </ol>
            </div>
            <div id="poleAdresu">
              <h4>Wpisz adres</h4>
              <input type="text" id="adres">
            </div>
          </div>
          <div class="span1 buttons">
            <div class="arrows">
              <div class="btn right-arrow"><i class="icon-arrow-right"></i></div>
              <div class="btn remove-arrow"><i class="icon-remove"></i></div>
            </div>
          </div>
          <div class="span6">
            <h4>Wybrane bazy</h4>
            <div id="listaBaz">
              <ol class="multiselectBaz wybrane">
                
              </ol>
            </div>
            <button type="button" class="pull-right btn" id="exportDoBazy">Eksportuj do wybranych baz</button>
          </div>
        </div>  
      </div>
    </div>
  </fieldset>
</div>

<div id="confirm-dialog" title="Potwierdź usuwanie">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Czy napewno chcesz usunąć wybrany wpis?</p>
</div>

<div id="info-dialog" title="Stan operacji">
  <p class="message"></p>
</div>

<div id="progress-bar"></div><?php }} ?>