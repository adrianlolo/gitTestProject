<div id="toolbox" class="btn-toolbar">
  <div class="editButtons pull-left">
    <!-- <div class="btn-group">
      <a class="tool btn btn-id" id="multiselect">Multiselect</a>
      <a class="tool btn btn-id" id="groupSelection">Zaznaczaj grupy</a>
      <a class="tool btn btn-id" id="deselectAll">Odznacz wszystko</a>
      <a class="tool btn btn-id" id="selectAll">Zaznacz wszystko</a>
      <a class="tool btn btn-id" id="reverseSelection">Odwróć zaznaczenie</a>
    </div> -->

    {if $info.sortowanie == 1}
    <div class="btn-group">
      <a class="tool btn btn-primary add" data-script="ajax/api" data-file="insert.php" data-func="add">Dodaj</a>
      <a class="tool btn btn-primary add" disabled="disabled" data-script="ajax/api" data-file="insert.php" data-func="group">Dodaj do grupy</a>
    </div>
    {else}
    <div class="btn-group">
      <a class="tool btn btn-primary add" data-script="ajax/api" data-file="insert.php" data-func="before">Dodaj</a> <!-- dodaj przed jak zaznaczone -->
      <a class="tool btn btn-primary add" disabled="disabled" data-script="ajax/api" data-file="insert.php" data-func="after">Dodaj po</a>
      <a class="tool btn btn-primary add" disabled="disabled" data-script="ajax/api" data-file="insert.php" data-func="group">Dodaj do grupy</a>
    </div>
    {/if}
    <div class="btn-group">
      <a class="tool btn btn-success edit" disabled="disabled" data-script="ajax/api" data-file="update.php" data-func="edit">Edytuj</a>
      {if $info.sortowanie == 1}
      <a class="tool btn btn-success opis" disabled="disabled" data-script="ajax/api" data-file="opis.php" data-func="opis">Opis</a>
      {/if}
    </div>
    <div class="btn-group">
      <a class="tool btn btn-danger remove" disabled="disabled" data-script="ajax/api" data-file="remove.php" data-func="remove">Usuń</a>
    </div>
    <div class="btn-group">
      <a class="tool btn export" data-script="ajax/api" data-file="export.php" data-func="export">Eksportuj</a>
      <a class="tool btn logout" href="ajax/logout" id="logout">Zmień bazę/tabelę</a>
    </div>
  </div>
</div>  