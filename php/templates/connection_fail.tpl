{extends file="layout.tpl"}
{block name=body}
<div class="container">
  <h4>Nie udało się nawiązać połączenia z bazą</h4>
  <br>
  <p><b>Dane połączenia:</b></p>
  <table>
    <tr>
      <td>Baza:</td>
      <td><b>{$fail.db}</b></td>
    </tr>
    <tr>
      <td>User:</td>
      <td><b>{$fail.user}</b></td>
    </tr>
    <tr>
      <td>Pass:</td>
      <td><b>{$fail.pass}</b></td>
    </tr>
  </table>
  <br>  
  <p>
    <a class="tool btn logout" href="ajax/logout" id="logout">Wróć do wyboru bazy</a>
  </p>
</div>
{/block}