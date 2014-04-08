{extends file="layout.tpl"}
{block name=body}
<div class="container-fluid toolbar"> 
  <div class="row-fluid" >
    {include file="scripts/toolbox.tpl"}
  </div>
</div>
<div class="container-fluid" id="content"> 
  <div class="row-fluid">
    {include file="scripts/lista.tpl"}
  </div>
</div>
<script src="js/editor.js"></script>
{include file="scripts/modal.tpl"}
{/block}