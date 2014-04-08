<?php /* Smarty version Smarty-3.1.13, created on 2014-03-03 19:27:04
         compiled from "templates\scripts\lista.tpl" */ ?>
<?php /*%%SmartyHeaderCode:596252e8313883cdc2-29685056%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e604d21ce8ddeeb1bd46af4f7fb55859fddd5723' => 
    array (
      0 => 'templates\\scripts\\lista.tpl',
      1 => 1393763966,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '596252e8313883cdc2-29685056',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52e831389aff95_70331732',
  'variables' => 
  array (
    'info' => 0,
    'db' => 0,
    'result' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52e831389aff95_70331732')) {function content_52e831389aff95_70331732($_smarty_tpl) {?><div class="listPlaceholder" data-tabela='<?php echo $_smarty_tpl->tpl_vars['info']->value['tabela'];?>
' data-maxId='<?php echo $_smarty_tpl->tpl_vars['info']->value['max'];?>
' data-sortowanie='<?php echo $_smarty_tpl->tpl_vars['info']->value['sortowanie'];?>
'>
  <ol id='selectable'>
  <?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['result']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['db']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['result']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value){
$_smarty_tpl->tpl_vars['result']->_loop = true;
 $_smarty_tpl->tpl_vars['result']->index++;
?>
    
      <?php if ($_smarty_tpl->tpl_vars['result']->value['POZIOM']<$_smarty_tpl->tpl_vars['db']->value[$_smarty_tpl->tpl_vars['result']->key+1]['POZIOM']){?>
        <span class="plus" data-ul="<?php echo $_smarty_tpl->tpl_vars['result']->index+1;?>
"><i class="icon-expand-alt"></i></span>
      <?php }?>
      <li id="<?php echo $_smarty_tpl->tpl_vars['result']->index+1;?>
" data-id="<?php echo $_smarty_tpl->tpl_vars['result']->value['ID'];?>
" data-lvl="<?php echo $_smarty_tpl->tpl_vars['result']->value['POZIOM'];?>
" data-ch="<?php echo $_smarty_tpl->tpl_vars['result']->value['MOZNAWYBRAC'];?>
" class="elem <?php if ($_smarty_tpl->tpl_vars['result']->value['POZIOM']<$_smarty_tpl->tpl_vars['db']->value[$_smarty_tpl->tpl_vars['result']->key+1]['POZIOM']){?>parent<?php }?><?php if ($_smarty_tpl->tpl_vars['result']->value['MOZNAWYBRAC']==0){?> niewybieralne<?php }?>">
        <?php if ($_smarty_tpl->tpl_vars['info']->value['tabela']=='bakterie'){?>
          <input class="uzywane" type="checkbox" data-symbol="<?php echo $_smarty_tpl->tpl_vars['result']->value['SYMBOL'];?>
" <?php if ($_smarty_tpl->tpl_vars['result']->value['UZYWANEID']){?> data-uzywaneid="<?php echo $_smarty_tpl->tpl_vars['result']->value['UZYWANEID'];?>
" data-opis="<?php echo $_smarty_tpl->tpl_vars['result']->value['OPIS'];?>
" checked="checked"<?php }?>>
        <?php }?>
        <span id="s_<?php echo $_smarty_tpl->tpl_vars['result']->index+1;?>
">(<?php echo $_smarty_tpl->tpl_vars['result']->value['SYMBOL'];?>
)</span>
        <span id="n_<?php echo $_smarty_tpl->tpl_vars['result']->index+1;?>
"><?php echo $_smarty_tpl->tpl_vars['result']->value['NAZWA'];?>
</span>
      </li>
        
      <?php if ($_smarty_tpl->tpl_vars['result']->value['POZIOM']<$_smarty_tpl->tpl_vars['db']->value[$_smarty_tpl->tpl_vars['result']->key+1]['POZIOM']){?>
        <ul class="child" data-li="<?php echo $_smarty_tpl->tpl_vars['result']->index+1;?>
">
      <?php }elseif($_smarty_tpl->tpl_vars['result']->value['POZIOM']>$_smarty_tpl->tpl_vars['db']->value[$_smarty_tpl->tpl_vars['result']->key+1]['POZIOM']){?>
        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int)ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['result']->value['POZIOM']-$_smarty_tpl->tpl_vars['db']->value[$_smarty_tpl->tpl_vars['result']->key+1]['POZIOM']+1 - (1) : 1-($_smarty_tpl->tpl_vars['result']->value['POZIOM']-$_smarty_tpl->tpl_vars['db']->value[$_smarty_tpl->tpl_vars['result']->key+1]['POZIOM'])+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0){
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++){
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
          </ul>
        <?php }} ?>
      <?php }?>
  <?php } ?>
  </ol>
</div><?php }} ?>