{*<div class="listPlaceholder" data-tabela='{$info.tabela}' data-maxId='{$info.max}' data-sortowanie='{$info.sortowanie}'>
  <ol id='selectable'>
  {foreach $db as $result}
      <div class="grupa">
        {if $result.POZIOM < $db[$result@key+1].POZIOM}
          <span class="plus"><i class="icon-expand-alt"></i></span>
        {/if}
        <li class="elem {if $result.POZIOM < $db[$result@key+1].POZIOM}parent{/if}{if $result.MOZNAWYBRAC == 0} niewybieralne{/if}">
          {if $info.tabela == 'bakterie'}
            <input class="uzywane" type="checkbox" {if $result.UZYWANEID}checked="checked"{/if}>
          {/if}
          <span class="symbol">({$result.SYMBOL})</span>
          <span class="nazwa">{$result.NAZWA}</span>
        </li>
      </div>
      {if $result.POZIOM < $db[$result@key+1].POZIOM}
        <ul class="child" data-parentsymbol="{$result.SYMBOL}">
      {else if $result.POZIOM > $db[$result@key+1].POZIOM}
        {for $i = 1 to $result.POZIOM - $db[$result@key+1].POZIOM}
          </ul>
        {/for}
      {/if}

  {/foreach}
  </ol>
</div>
*}

<div class="listPlaceholder" data-tabela='{$info.tabela}' data-maxId='{$info.max}' data-sortowanie='{$info.sortowanie}'>
  <ol id='selectable'>
    {foreach $db as $result}
      <div class="grupa level-{$result.POZIOM}">
        {if $result.POZIOM < $db[$result@key+1].POZIOM}
          <span class="plus"><i class="icon-expand-alt"></i></span>
        {/if}
        <li class="elem {if $result.POZIOM < $db[$result@key+1].POZIOM}parent{/if}{if $result.MOZNAWYBRAC == 0} niewybieralne{/if}">
          {if $info.tabela == 'bakterie'}
            <input class="uzywane" type="checkbox" {if $result.UZYWANEID}checked="checked"{/if}>
          {/if}
          <span class="symbol">({$result.SYMBOL})</span>
          <span class="nazwa">{$result.NAZWA}</span>
        </li>
      </div>
    {/foreach}
  </ol>
</div>
<div id="template" style="display: none"></div>