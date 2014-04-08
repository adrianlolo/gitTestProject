{extends file="layout.tpl"}
{block name=body}
    <script>
    var availableTags = [
          {$tags}
        ];
    {literal}
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
    {/literal}
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
            {foreach $tagsArray as $t}
              <li class="baza">{$t}</li>
            {/foreach}
          </ul>
        </div>
        <div class="control-group">
          <label class="control-label" for="table">Tabela</label>
          <div class="controls">
            <select name="tabela" id="tabela">
              {foreach $tabele as $t}
                <option value="{$t.name}">{$t.caption}</option>
              {/foreach}
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
{/block}