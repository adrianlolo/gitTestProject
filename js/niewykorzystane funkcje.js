/* Aktualizacja listy po zmianach */
function actualizeList(data){
  console.log('Aktualizacja listy');
  //Przyogtowanie obiektu z danymi po zmianach
  var done = true;
  var obj = {};
  $.each(data, function(index, val) {
    obj[val.name] = val.value;
  });
  //console.log(obj);

  var func = obj.func;
  var selectedElem = $('.selected');

  /* Usuwanie elementow z listy */

  if( func == 'remove' ){
    $.each(selected, function(index, val) {
      var li = $('li#'+val);

      if (li.hasClass('parent')){
        $(".plus[data-ul='"+val+"'], ul[data-li='"+val+"']").remove();
      }

      li.remove();

    });
  }
  /* Zmiana po edycji */
  else if ( func == 'edit' && sortowanie == 1 ){
    var o = selectedElem, pelnySymbol = obj.prefix+obj.symbol, starySymbol, textLen;
    var id = o.attr('id'), 
        symbol = $('#s_'+id),
        nazwa = $('#n_'+id);
      
    nazwa.text(obj.nazwa);
    
    textLen = symbol.text().length-1;
    starySymbol = removeBracket(symbol.text());
    symbol.text('('+pelnySymbol+')');
  
    if (o.hasClass('parent') && pelnySymbol != starySymbol){
      changeSymbols(id, textLen, pelnySymbol);
    }
  }
  /* Dodanie nowego elementu */
  else if (checkSymbols(obj.prefix+obj.symbol)) {
    if ( func == 'group' && !selectedElem.hasClass('parent')){ 
      var liId = selectedElem.attr('id');
      var plusTemplate = '<span class="plus" data-ul="'+liId+'"><i class="icon-expand-alt"></i></span>';
      var ulTemplate = '<ul class="child" data-li="'+liId+'" style="display: none;"></ul>';
      selectedElem.before(plusTemplate);
      selectedElem.after(ulTemplate);
      selectedElem.addClass('parent');         
    }
    if (sortowanie == 1){
      var place, method,
          calySymbol = obj.prefix+obj.symbol,
          pos = findPosition( calySymbol ),
          ok = true,
          thisLi = $('.elem').eq(pos-1),
          thisLiLevel = +thisLi.data( 'lvl' ),
          thisLiSymbol = removeBracket( thisLi.children('span').eq(0).text() );

      
      if ( thisLi.hasClass('parent') ){
        place = $("[data-li='"+thisLi.attr("id")+"']");
        method = 'prepend'; //dodanie na poczatek ul
        obj.poziom = thisLiLevel+1;  
      } 
      else if ( thisLi.parent('ul.child') ){
        /*if ( thisLi == $('ul.child li:last-child') ){
          if ( thisLi.data('lvl') !=  )
        }*/
        /* jesli element ma rodzica i zgadza sie prefix to dodajemy do tej grupy*/
        if ( comparePrefix( thisLi, calySymbol ) ){
          place = thisLi;
          method = 'after'
        }

        var ul = thisLi.parent('ul.child');
        var ulParentSymbol = removeBracket( $('#'+ul.data('li')).children('span').eq(0).text() );
      }

      console.log(thisLiSymbol);

      /*if ( func != 'group' && thisLi.hasClass('parent') && thisLiSymbol == calySymbol.slice(0, thisLiSymbol.length) ){
        ok = confirm('Dodawany element ma taki sam prefix jak już istniejący wpis z przypisaną grupą. \nJeżeli chcesz dodać element do istniejącej grupy użyj polecenia "Dodaj do grupy". \nDodanie wpisu w tym momencie może spowodować niekorzystne zmiany w aktualnej strukturze. \n\nCzy mimo to chcesz kontynuować?');
      }
      if (obj.poziom != thisLi.data('lvl')){
        ok = confirm('Poziom elementu poprzedzającego nowy wpis jest różny od wybranego. \nCzy chcesz dodać ten wpis (zostanie zmieniony poziom dodawanego elementu)?\nJeżeli anulujesz wpis nie zostanie dodany.');  
        if (ok){
          if (ulParentSymbol && ulParentSymbol == calySymbol.slice(0, ulParentSymbol.length)){
            obj.poziom = thisLi.data('lvl');  
          }
          else {
            thisLi = ul;
          }
        }
      }*/
      
      if (ok){
        
        var wybieralne = 0;
        if (obj.wybieralne)
          wybieralne = 1;
  
        var pattern = '<li id="temp_'+pos+'" data-id="'+maxId+1+'" data-lvl="'+obj.poziom+'" data-ch="'+wybieralne+'" class="elem "><span id="s_temp_'+pos+'">('+calySymbol+')</span><span id="n_temp_'+pos+'">'+obj.nazwa+'</span></li>';
        
        if (method == 'prepend'){
          place.prepend(pattern);  
        }
        else if (method == 'after'){
          place.after(pattern);
        }
      }
    }
    else {
      
    }
  } 
  else {
    done = false;
  }

  if (done)
    sendQuery(obj);
}


/* Przygotowanie elementu do wstawinia na strone */
function insertNewElement(obj, elemIndex, li){
  var func = obj.func;
  var idToSet, id;
  if (sortowanie == 1){
    idToSet = maxId;
    console.log(li[elemIndex]);  
    id = li.eq(elemIndex).attr('id');
    console.log('elemIndex = '+elemIndex+'\nid = '+id);
  }
  else {
    li = $('ol li');
    if (func == 'before'){
      idToSet = obj.id;
      id = idToSet;
    }
    if (func == 'after' || func == 'group'){
      idToSet = obj.id + 1
      id = idToSet;
    }
  }
  var lista = $('ol li');
  console.log(lista);
  $.each(lista, function(index, val) {
    if (index >= id-1){
      var o = $(this);
      var oldId = o.attr('id');
      console.log('Old id ('+index+'):'+oldId);
      var newId = +oldId + 1;
      console.log('New id ('+index+'):'+newId);
      if (o.hasClass('parent')){
        $('span.plus[data-ul="'+oldId+'"]').data('ul', newId);
        $('ul[data-li="'+oldId+'"]').data('li', newId);
        $('#s_'+oldId).attr('id', 's_'+newId);
        $('#n_'+oldId).attr('id', 'n_'+newId);
      }
      o.attr('id', newId);
      //console.log(o); 
    }
    else {
      console.log(index +" : "+ id);
    }
  });  
  console.log(lista);
  /*$.each(lista, function(index, val) {
    if ($(this).attr('id') == id){
      control = 1;

    if (control)  
      $(this).attr('id', $(this).attr('id')+1);  
    }
  });*/

  var liTemplate = '<li id="'+id+'" data-id="'+idToSet+'" data-lvl="'+obj.poziom+'" data-ch="1" class="elem"><span id="s_'+idToSet+'">('+obj.prefix+obj.symbol+')</span><span id="n_'+idToSet+'">'+obj.nazwa+'</span></li>';
  console.log('Template: '+liTemplate);  
  if (sortowanie == 1){
    li.eq(elemIndex).before(liTemplate);
  }
  else {
    var placeToInsert = $('li#'+id-1);
    if (placeToInsert.hasClass('parent')){
      placeToInsert = $('ul[data-li="'+id-1+'"]');  
    }

    placeToInsert.after(liTemplate);
  }
}


  /* Buttony od zaznaczania */
/*  $('#multiselect').click(function(){ setMultiselect($(this)); });
  $('#groupSelection').click(function(){ setGroupSelection($(this)); });
  $('#selectAll').click(function(){ selectAll(); });
  $('#deselectAll').click(function(){ deselectAll(); });
  $('#reverseSelection').click(function(){ reverseSelection(); });
*/