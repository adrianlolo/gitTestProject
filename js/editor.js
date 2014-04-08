var info = [],
    db = [],
    grupy = [],
    symbols = [],  // lista symboli przydatan przy prawdzaniu powtorzen
    actualFunc = '',// nazwa aktualnie wykonywanej funkcji (edit, add, itp)
    actualFile = '',// nazwa aktualnie wykonywanej funkcji (edit, add, itp)
    index = null;  // index wybranego elementu to id rekordy
    record = {     // dane wybranego rekordu
      id: null,
      lastchild: null,
      moznawybrac: null,
      nazwa: null,
      isparent: null,
      opis: null,
      poziom: null,
      prefix: null,
      symbol: null,
      symbolpart: null,
      uzywaneid: null,
      przypisanegrupy: []
    },
    dom = null, // uchwyt do elementu od ktorego nalezy zaczac wstawianie
    tabela = '';
    changes = {
      removed: [],
      added: [],
      edited: []
    }; // tablica zawieracjaca nowo dodane rekordy i te zmodyfikowane, jest wysyłana do API

function init(){
  $.ajax({
    url: 'ajax/reload',
    type: 'POST',
    dataType: 'json',
    data: {func: 'reload'}
  })
  .done(function(msg) {
    info = msg.info;
    db = msg.db;
    grupy = msg.grupybakterii;

    var len = db.length;
    for ( i=0 ; i<len ; i++ ){
      symbols[i] = db[i]['symbol'];
    }

    tabela = $( ".listPlaceholder").data('tabela');

    $(".grupa:not(.level-0)").toggle();

    bindEvents();
    getFormFields();
  });
}

function copyRecord(){
  window.historyRecord = {     // dane wybranego rekordu
    id: record.id,
    lastchild: record.lastchild,
    isparent: record.isparent,
    moznawybrac: record.moznawybrac,
    nazwa: record.nazwa,
    opis: record.opis,
    poziom: record.poziom,
    prefix: record.prefix,
    symbol: record.symbol,
    symbolpart: record.symbolpart,
    uzywaneid: record.uzywaneid,
    przypisanegrupy: record.przypisanegrupy
  };
}

function copyObj( data ){
  return {     // dane wybranego rekordu
    id: data.id,
    lastchild: data.lastchild,
    isparent: data.isparent,
    moznawybrac: data.moznawybrac,
    nazwa: data.nazwa,
    opis: data.opis,
    poziom: data.poziom,
    prefix: data.prefix,
    symbol: data.symbol,
    symbolpart: data.symbolpart,
    uzywaneid: data.uzywaneid,
    przypisanegrupy: data.przypisanegrupy
  };
}
// globalne zmienne dostepu do pol formularzy
function getFormFields(){
  window.prefix = $("#prefix");
  window.symbol = $("#symbol");
  window.nazwa = $("#nazwa");
  window.moznawybrac = $("#moznawybrac");
  window.id = $("#id");
  window.poziom = $("#poziom");
  window.file = $("#file");
  window.func = $("#func");
  window.opis = $("#opis");
  window.opisPrefix = $("#opisPrefix");
  window.opisSymbol = $("#opisSymbol");
  window.opisFile = $("#opisFile");
  window.opisFunc = $("#opisFunc");
  window.opisUzywaneId = $("#opisUzywaneId");
  window.checkboxGrupyBakterii = $(".checkboxGrupy");
}

function unbindEvents(){
  var grupa = $(".grupa");
  grupa.unbind( 'click' );
  grupa.unbind( 'dbclick' );
  $(".plus").unbind( 'click' );
  $(".tool").unbind( 'click' );
  $(".edit").unbind( 'click' );
  $(".opis").unbind( 'click' );
  $(".add").unbind( 'click' );
  $(".export").unbind( 'click' );
}

function bindEvents(){
  $(".grupa").click(function( ev ){
    var o = $(this);
    index = $(".grupa").index(o);
    record = db[index];

    $(".grupa li").removeClass("selected");
    o.children(".elem").addClass('selected');


    // Aktywacja przycisku opis
    if ( record.uzywaneid ){
      $('.opis').addClass('activeOpis').removeAttr('disabled');
    }
    else {
      $('.opis').removeClass('activeOpis').attr('disabled', 'disabled');
    }

    // Aktywacja przyciskow po zaznaczeniu
    if ($('.selected').length>0){
      $('.add, .edit, .remove').removeAttr('disabled');
      $('.add[data-func="before"]').text('Dodaj przed');
    }
    else {
      $('.add[data-func="after"], .add[data-func="group"], .edit, .remove').attr('disabled','disabled');
      $('.add[data-func="before"]').text('Dodaj');
    }
  });

  $(".uzywane").click( function(){
    setUzywane( $(this) );
  });

  $(".plus").click(function(){
    index = $(".grupa").index( $(this).parent( ".grupa" ) );
    showhide( $(this) );
  });

  $('.grupa').dblclick(function(event){
    event.preventDefault();
    if (window.getSelection){
      window.getSelection().removeAllRanges();
    }
    else if (document.selection){
      document.selection.empty();
    }
    var o = $(this);
    index = $(".grupa").index(o);
    var plus = $(this).children(".plus");
    showhide( plus, true );
  });


  $(".tool").click(function(){
    var o = $(this);
    actualFunc = o.data('func');
    actualFile = o.data('file');
  });

  $(".edit").click(function(){
    setData();
    $("#edit-dialog").dialog('open');
  });
  $(".opis").click(function(){
    setData();
    $("#opis-dialog").dialog('open');
  });
  $(".add").click(function(){
    setData();
    $("#edit-dialog").dialog('open');
  });
  $(".remove").click(function(){
    fetchData();
  });
  $(".export").click(function(){
    $("#export-dialog").dialog('open');
  });

}
// Pobranie danych listy
function setData(){
  clearForm();

  var symbolContent = record.symbol;
  if ( record.prefix && actualFunc == "edit" ){
    prefix.css("display", "block");
    symbolContent = record.symbolpart;
  }

  if ( actualFunc == 'edit' ){
    prefix.text(record.prefix);
    symbol.val(symbolContent);
    nazwa.val(record.nazwa);
    id.val(record.id);
    if (record.moznawybrac){
      moznawybrac.attr("checked", "checked");
    }
    poziom.val(record.poziom);
    file.val(actualFile);
    func.val(actualFunc);
  }
  else if ( actualFunc == 'add' ){
    symbol.val(record.symbol);
    poziom.val(record.poziom);
    file.val(actualFile);
    func.val(actualFunc);
  }
  else if ( actualFunc == 'group' ){
    prefix.css("display", "block");
    prefix.text(record.symbol);
    poziom.val(record.poziom+1);
    file.val(actualFile);
    func.val(actualFunc);
  }
  else if ( actualFunc == 'opis' ){
    opisPrefix.css("display", "block");
    opisPrefix.text(record.symbol);
    opisSymbol.val(record.symbol);
    opis.val(record.opis);
    opisUzywaneId.val(record.uzywaneid);
    opisFile.val(actualFile);
    opisFunc.val(actualFunc);
    if (record.przypisanegrupy){
      var l = checkboxGrupyBakterii.length,
          k = record.przypisanegrupy.length;
      for (i=0; i<l; i++){
        var checkbox = checkboxGrupyBakterii.eq(i);
        for (j=0; j<k; j++){
          if ( checkbox.val() == record.przypisanegrupy[j] )
            checkbox.prop('checked', true);
        }
      }
    }
  }
}

function clearRecord(){
  record = {     // dane wybranego rekordu
    id: null,
    lastchild: null,
    moznawybrac: null,
    nazwa: null,
    isparent: null,
    opis: null,
    poziom: null,
    prefix: null,
    symbol: null,
    symbolpart: null,
    uzywaneid: null,
    przypisanegrupy: []
  };
}

function getData( form ){
  if ( form == 'edit' ){
    record.symbolpart = ( prefix.text() == '' ) ? '' : symbol.val() ;
    record.prefix = ( prefix.text() == '' ) ? '' : prefix.text() ;
    record.symbol = ( prefix.text() == '' ) ? symbol.val() : record.prefix + record.symbolpart;
    symbols[ index ] = record.symbol;
    record.nazwa = nazwa.val();
    if ( moznawybrac.prop('checked') )
      record.moznawybrac = 1;
    else
      record.moznawybrac = 0;
  }
  else if ( form == 'add' || form == 'group' ){
    clearRecord();
    record.symbolpart = ( prefix.text() == '' ) ? '' : symbol.val() ;
    record.prefix = ( prefix.text() == '' ) ? '' : prefix.text() ;
    record.symbol = ( prefix.text() == '' ) ? symbol.val() : record.prefix + record.symbolpart;
    record.nazwa = nazwa.val();
    if ( moznawybrac.prop('checked') )
      record.moznawybrac = 1;
    else
      record.moznawybrac = 0;
  }
  else if ( form == 'opis' ){
    record.opis = opis.val();
    record.przypisanegrupy = [];
    $.each( checkboxGrupyBakterii, function(){
      var check = $(this);
      if ( check.prop( "checked" ) ){
        console.log( check.val() );
        record.przypisanegrupy.push( check.val() );
      }
    });
    console.log( record.przypisanegrupy );
  }
}

// Funkcja wywoływana po edit, ad, group
function updateListArray(){
  var listSlice = [],
      symbolsSlice = [],
      toRemove = [],
      symbolsLength = symbols.length,
      counter = 1;

  if ( actualFunc == "edit" ) {
    while ( db[ index+counter ] != undefined && record.isparent && record.poziom < db[ index+counter ].poziom  ){
      db[ index + counter ].prefix = record.symbol;
      db[ index + counter ].symbol = record.symbol + db[ index + counter ].symbolpart;
      symbols[ index+counter ] = db[ index + counter ].symbol;
      counter++;
    }
  }
  else if ( actualFunc == "add" || actualFunc == "group" ){
    listSlice.push( record );
    symbolsSlice.push( record.symbol );
    if ( info.sortowanie )
      listSlice[0].id = info.max + 1;
  }

  for ( x = 0; x < symbolsLength; x++ ){
    if ( symbols[ x ].indexOf( record.symbol ) == 0 ){
      listSlice.push( db[ x ] );
      symbolsSlice.push( symbols[ x ] );
      toRemove.push( x );
      symbolsLength--;
    }
  }
  removeDomElements( toRemove );
  prepareData( listSlice, symbolsSlice );

  db = db.concat( listSlice );
  symbols = symbols.concat( symbolsSlice );

  multiDimSort( db );
  symbols.sort();

  compileData( listSlice, symbolsSlice );
}

function compileData( source, symbols ){
  var tabela = $(".listPlaceholder").data("tabela");
  for ( i=0; i < source.length; i++ ){
    source[i].tabela = tabela;
  }

  addToChanges( source );

  var content = {
    lista: source
  };

  var template, html;
  handlebarsHelpers();
  $("#template").load("php/templates/handlebars/list_tpl.html #all", function( responseText ){
    template = Handlebars.compile(responseText);
    html = template( content );
    insertData( html, source, symbols );
  });
}

function prepareData( listSlice, symbolsSlice ){
  multiDimSort( listSlice );
  symbolsSlice.sort();

  // Znalezienie ustawien poczatkowy pierwszego elementu
  var curr, next;
  index = findIndex( symbolsSlice[0] );

  if ( index >= 0 ){
    curr = db[ index ];
    next = listSlice[0];
    var isparent = curr.isparent;
    updateRecords( curr, next, db, symbols );
    if ( !isparent && curr.isparent ){
      addToChanges( curr );
      var plus = '<span class="plus"><i class="icon-expand-alt icon-collapse-alt"></i></span>';
      $(".grupa").eq( index).prepend( plus );
    }
  }
  else {
    var t = listSlice[0];
    t.prefix = "";
    t.symbolpart = "";
    t.poziom = 0;
    t.lastchild = 0;
    t.isparent = 0;
  }

  var listSliceLen = listSlice.length;

  for ( i = 0; i < listSliceLen-1; i++ ){
    curr = listSlice[i];
    next = listSlice[i+1];
    updateRecords( curr, next, listSlice, symbolsSlice );
  }
}

function addToChanges( o ){
  var objArray = [];
  if ( o instanceof Array ){
    objArray = o ;
  }
  else if ( o instanceof Object ){
    objArray.push( o );
  }

  console.log( objArray );

  for ( x in objArray ){
    var c = objArray[x];
    if ( c.id )
      changes.edited.push( c );
    else
      changes.added.push( c );
  }
}

function updateRecords( curr, next, listSlice, symbolsSlice ){
  if ( children( curr.symbol, next.symbol ) ){
    curr.isparent = 1;
    next.prefix = curr.symbol;
    next.symbolpart = symbolPart( next, curr.symbol );
    next.symbol = next.prefix + next.symbolpart;
    next.poziom = curr.poziom+1;
  }
  else if ( children( curr.prefix, next.symbol ) ){
    curr.isparent = 0;
    next.prefix = curr.prefix;
    next.symbolpart = symbolPart( next, curr.prefix );
    next.symbol = next.prefix + next.symbolpart;
    next.poziom = curr.poziom;
  }
  else if ( curr.poziom > 1 ){
    var parent = {},
      prefix = curr.prefix;
    for ( j = curr.poziom-1; j > 0; j-- ){
      parent = listSlice[ findParent( symbolsSlice, prefix ) ];
      console.log( curr,prefix,parent );
      if ( parent.prefix && children( parent.prefix, next.symbol ) ){
        next.prefix = parent.prefix;
        next.symbolpart = symbolPart( next, parent.prefix );
        next.symbol = next.prefix + next.symbolpart;
        next.poziom = parent.poziom;
        break;
      }

      if ( parent.prefix != "" )
        prefix = parent.prefix;
    }
    curr.isparent = 0;
    curr.lastchild = 1;
  }
  else {
    next.poziom = 0;
    next.prefix = "";
    next.symbolpart = "";
    next.lastchild = 0;
  }
}

function insertData( html ){
  if ( index < 0 ){
    $("#selectable").prepend( html );
  }
  else {
    $(".grupa").eq( index ).after( html );
  }

  unbindEvents();
  bindEvents();
}

function symbolPart( next, prefix ){
  return next.symbol.substr( prefix.length );
}

function multiDimSort( array ){
  array.sort(function(a, b) { return (a['symbol'] < b['symbol'] ? -1 : (a['symbol'] > b['symbol'] ? 1 : 0)); });
}

// index elementu za ktory umiescimy nowe dane
function findIndex( symbol ){
  symbols.push( symbol );
  symbols.sort();
  var r = symbols.indexOf( symbol );
  symbols.splice( r, 1 );
  return r-1;
}

/*
function updateListArray(){
  var grupa = $(".grupa");

  // zapisany wczesniej index to pozycja wyjsciowa edytowanego elementu na liscie DOM i w tablicy
  //zapis uchwytu do edytowanego elementu
  var current = grupa.eq(index);

  // sprawdzenie ze wybrany element jest rodzicem, jeżeli tak (na podstawie historyRecord), do uchwytu dodajemy przynalezacego ul
  var childLen = 0, child;
  if ( historyRecord.isparent == 1 ){
    child = $(".child[data-parentsymbol='"+historyRecord.symbol+"']");
    childLen = child.find(".grupa").length; // liczba dzieci elementu
  }

  // zmiana symboli na liscie i w tablicy
  symbols[index] = record.symbol;
  if ( childLen > 0 ){
    for (i = index+1; i <= index+childLen ; i++){
      var newSymbol = record.symbol + db[i].symbolpart;
      db[i].prefix = record.symbol;
      db[i].symbol = newSymbol;
      symbols[i] = newSymbol;
    }
  }

  oldIndex = index;
  len = childLen + 1;
  removeDomElements( current, child );

  // sortowanie tablic
  symbols.sort();
  db.sort(function(a, b) { return (a['symbol'] < b['symbol'] ? -1 : (a['symbol'] > b['symbol'] ? 1 : 0)); });

  newIndex = symbols.indexOf( record.symbol);

  var startIndex = findDomIndex(),
      counter = startIndex,
      changes = [ startIndex ],  // zawiera indexy zmodyfikowanych rekordow
      i = 0;

  //if ( db[ startIndex ].lastchild &&  )

  do {

    var curr = db[ counter ],
        next = db[ counter+1 ],
        copyNext, lastParent, change = 0;
    console.log( curr, next );
    if ( next != undefined && children( record.symbol, next.symbol ) ){
      copyNext = copyObj( next );
      if ( children( curr.symbol, next.symbol ) ){
        curr.isparent = 1;
        curr.lastchild = 0;
        lastParent = curr;
        setParent( next, curr.symbol );
        next.poziom = curr.poziom+1;
      }
      else {
        if ( curr.poziom > 0 ){
          var poziom = curr.poziom,
              actualParent = db[ findParentIndex( curr.symbol ) ];

          while ( poziom ){
            if ( children( actualParent.symbol, next.symbol ) ){
              next.isparent = 0;
              setParent( next, actualParent.symbol );
              next.poziom = actualParent.poziom+1;
              if ( next.poziom < curr.poziom )
                curr.lastchild = curr.poziom - next.poziom;
              else
                curr.lastchild = 0;

              break;
            }
            else {
              poziom--;
              if ( poziom ){
                actualParent = db[ findParentIndex( actualParent.symbol ) ];
                curr.lastchild = curr.poziom - poziom;
              }
              else {
                next.isparent = 0;
                next.poziom = 0;
                curr.lastchild = curr.poziom;
                setParent( next, '' );
              }
            }
          }
        }
        else {
          next.isparent = 0;
          next.poziom = 0;
          next.lastchild = 0;
          setParent( next, '' );
        }
      }
      if ( checkChanges( next, copyNext ) ){
        change = 1;
        changes.push( counter+1 );
      }
    }
    else {
        curr.lastchild = curr.poziom;
    }

    counter++;
    i++
  } while( change || i < childLen+1 );

  console.log( changes );
  removeDomElements( changes );
  compileData( changes );
} // end updateListArray()
*/

// Funkcja sprawdza czy pierwszy argument moze byc rodzicem drugiego, zwraca true lub false
function children( parent, child ){
  return ( child.indexOf( parent ) == 0 );
}
// Znajduje index rodzica elementu
function findParent( lista, symbol ){
  return lista.indexOf( symbol );
}

function removeDomElements( toRemove ){
  var i = 0,
      step = 0;

  for ( x in toRemove ){
    i = toRemove[x] - step;
    $(".grupa").eq( i ).remove();
    db.splice( i, 1 );
    symbols.splice( i, 1 );
    step++;
  }
}

function handlebarsHelpers(){
  // HELPER: #key_value
//
// Usage: {{#key_value obj}} Key: {{key}} // Value: {{value}} {{/key_value}}
//
// Iterate over an object, setting 'key' and 'value' for each property in
// the object.
  Handlebars.registerHelper("key_value", function(obj, fn) {
    var buffer = "",
      key;

    for (key in obj) {
      if (obj.hasOwnProperty(key)) {
        buffer += fn({key: key, value: obj[key]});
      }
    }

    return buffer;
  });

// HELPER: #each_with_key
//
// Usage: {{#each_with_key container key="myKey"}}...{{/each_with_key}}
//
// Iterate over an object containing other objects. Each
// inner object will be used in turn, with an added key ("myKey")
// set to the value of the inner object's key in the container.
  Handlebars.registerHelper("each_with_key", function(obj, fn) {
    var context,
      buffer = "",
      key,
      keyName = fn.hash.key;

    for (key in obj) {
      if (obj.hasOwnProperty(key)) {
        context = obj[key];

        if (keyName) {
          context[keyName] = key;
        }

        buffer += fn(context);
      }
    }

    return buffer;
  });
  Handlebars.registerHelper('ifCond', function (v1, operator, v2, options) {
    switch (operator) {
      case '==':
        return (v1 == v2) ? options.fn(this) : options.inverse(this);
      case '===':
        return (v1 === v2) ? options.fn(this) : options.inverse(this);
      case '<':
        return (v1 < v2) ? options.fn(this) : options.inverse(this);
      case '<=':
        return (v1 <= v2) ? options.fn(this) : options.inverse(this);
      case '>':
        return (v1 > v2) ? options.fn(this) : options.inverse(this);
      case '>=':
        return (v1 >= v2) ? options.fn(this) : options.inverse(this);
      case '&&':
        return (v1 && v2) ? options.fn(this) : options.inverse(this);
      case '||':
        return (v1 || v2) ? options.fn(this) : options.inverse(this);
      default:
        return options.inverse(this);
    }
  });

  Handlebars.registerHelper('for', function(number, options) {
    var buffer = '';
    for ( i = 0; i < number; i++ ){
      buffer += options.fn(number);
    }
    return buffer;
  });

}

function showhide( o, test ){
  if ( test && !db[index].isparent ){
    return false;
  }
  else {
    var start = $(".grupa").eq( index ),
        i = index+1,
        icon = o.find('i');

    while ( db[i] != undefined && db[i].poziom > db[index].poziom ){
      start = start.next();
      if ( db[ i ].poziom == db[index].poziom+1 && !icon.hasClass( 'icon-collapse-alt' ) ){
         start.show(400);
      }
      else if ( icon.hasClass( 'icon-collapse-alt' ) ){
        start.hide(400);
        if ( db[i].isparent )
          start.find('i').removeClass( "icon-collapse-alt" );
      }
      i++;
    }

    icon.toggleClass('icon-collapse-alt');
    return true;
  }

}

function remove(){
  if ( record.isparent ){
    var parent = record.symbol,
        counter = 0,
        toRemove = [];
    do {
      counter++;
      toRemove.push( index + counter );
    } while( children( parent, symbols[ index + counter + 1 ] ) );
  }

  toRemove.push( index );
  toRemove.sort(function(a,b){return b-a});
  var grupa = $(".grupa");
  for ( x in toRemove ){
    changes.removed.push( db[ toRemove[x] ].id );
    db.splice( toRemove[x], 1 );
    symbols.splice( toRemove[x], 1 );
    grupa.eq( toRemove[x] ).remove();
  }

}


// wniesienie zmian na liscie
function fetchData(){

  if (actualFunc == 'edit'){
    copyRecord(); // wykonuje kopie record'u przed wprawdzeniem zmian, bedzie potrzebne przy szukaniu pozycji w DOM
    getData('edit'); // pobiera dane z formularza i zapisuje je w record
    updateListArray();
  }
  else if (actualFunc == 'add'){
    copyRecord(); // wykonuje kopie record'u przed wprawdzeniem zmian, bedzie potrzebne przy szukaniu pozycji w DOM
    getData('add');
    updateListArray();
  }
  else if (actualFunc == 'group'){
    copyRecord(); // wykonuje kopie record'u przed wprawdzeniem zmian, bedzie potrzebne przy szukaniu pozycji w DOM
    getData('add');
    updateListArray();
  }
  else if (actualFunc == 'opis'){
    getData('opis');
  }
  else if (actualFunc == 'remove'){
    remove();
  }
}

/* Czyszczenie formularza */
function clearForm(){
  var allFields = $("input:text");
  checkboxGrupyBakterii.attr('checked', false);
  moznawybrac.attr('checked', false);
  allFields.val('');
  $('#prefix').css('display', 'none').text('');
}

function checkSymbols(symbol){
  if (symbols.indexOf(symbol) >= 0)
    return false;
  else
    return true;
}

jQuery(document).ready(function() {

  /* obluga okien */
  var height = window.innerHeight;
  $( "#edit-dialog" ).dialog({
    dialogClass: 'fixed-dialog',
    autoOpen: false,
    height: height,
    width: 600,
    modal: true,
    buttons: {
      Zatwierdź: function() {
        var tips = $( ".validateTips" ).text('');
        var symbolField = $('#symbol');
        var symbol = $('#prefix').text() + symbolField.val();
        symbolField.removeClass('ui-state-error');
        
        if (symbol.length == 0){
          symbolField.addClass('ui-state-error');
          tips.text('Musisz wypełnić pole symbolu');
          tips.addClass( "ui-state-highlight" );
          setTimeout(function() {
            tips.removeClass( "ui-state-highlight", 1500 );
          }, 500 );
        }
        else if (!checkSymbols(symbol) && actualFunc != "edit"){
          symbolField.addClass('ui-state-error');
          tips.text('Wpis o podanym symbolu jest już w bazie');
          tips.addClass( "ui-state-highlight" );
          setTimeout(function() {
            tips.removeClass( "ui-state-highlight", 1500 );
          }, 500 ); 
        }
        else if ( actualFunc == "edit" && db[index]['symbol'] != symbol && !checkSymbols(symbol) ){
          symbolField.addClass('ui-state-error');
          tips.text('Wpis o podanym symbolu jest już w bazie');
          tips.addClass( "ui-state-highlight" );
          setTimeout(function() {
            tips.removeClass( "ui-state-highlight", 1500 );
          }, 500 );
        }
        else {
          fetchData();
          $( this ).dialog("close");
          clearForm();
        }
      },
      Anuluj: function() {
        $( this ).dialog( "close" );
        clearForm();
      }
    },
    close: function() {
      clearForm();
    }
  });

  $('#opis-dialog').dialog({
    dialogClass: 'fixed-dialog',
    autoOpen: false,
    height: height,
    width: 600,
    modal: true,
    buttons: {
      Zatwierdź: function() {
        fetchData();
        $( this ).dialog("close");
        clearForm();
      },
      Anuluj: function() {
        $( this ).dialog( "close" );
       }
    },
    close: function() {
    }
  });
  

  $('#export-dialog').dialog({
    dialogClass: 'fixed-dialog',
    autoOpen: false,
    height: height,
    width: '80%',
    modal: true,
    buttons: {
      Anuluj: function() {
        $( this ).dialog( "close" );
       }
    },
    close: function() {
    }
  });

  $( "#confirm-dialog" ).dialog({
    resizable: false,
    autoOpen: false,
    modal: true,
    buttons: {
      "Potwierdź": function() {
        var sel = $('.remove');
        removeElements(sel);
        $( this ).dialog( "close" );
      },
      "Anuluj": function() {
        $( this ).dialog( "close" );
      }
    }
  });
  $( "#info-dialog" ).dialog({
    resizable: false,
    autoOpen: false,
    modal: true,
    buttons: {
      "Zakmnij": function() {
        $( this ).dialog( "close" );
      }
    }
  });

  init();

});