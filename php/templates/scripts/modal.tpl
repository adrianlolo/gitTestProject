<div id="edit-dialog" title="Edytor wpisów">
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
        {foreach $grupybakterii as $grupa}
          <li class="checkboxGrupyBakterii" data-id="{$grupa.ID}">
            <input type="checkbox" value="{$grupa.ID}" class="checkboxGrupy">
            <span class="nazwaGrupy">{$grupa.NAZWA}</span>
          </li>
        {/foreach}
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
            {foreach $exportlist as $e}
              <option value="{$e@index}">{$e.caption}</option>
            {/foreach}
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
                {foreach $tagsArray as $t}
                  <li class="baza">{$t}</li>
                {/foreach}
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

<div id="progress-bar"></div>