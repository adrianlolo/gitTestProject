//w bazie tabela pracowincy
//TYLKO LOGOWANIE, TABELA I BAZA NA SZTYWNO W YAMLU

okno opis checkbox list, wyswietla nazwy z tabelki grupybakteri posortowane opornosciowe desc potem nazwy asc where del = 0

<?php
      if (!empty($_REQUEST['wylogowanie'])) {
        global $database;
        baza_zaloguj();
        if (!empty($_SESSION['zalogowany'])) {
          $sql = 'update Logowanie set Wylogowanie = current_timestamp where ID = '.$_SESSION['zalogowany'];
          ibase_query($database, $sql);
          unset($_SESSION['zalogowany']);
        }
        baza_wyloguj();
      }
      elseif (!empty($_POST['LOGOWANIE']) && !empty($_POST['HASLO'])) {
        global $database;
        baza_zaloguj();
        
        if (!empty($_SESSION['zalogowany'])) {
          $sql = 'update Logowanie set Wylogowanie = current_timestamp where ID = '.$_SESSION['zalogowany'];
          ibase_query($database, $sql);
          unset($_SESSION['zalogowany']);
        }
        
        $sql = 
          'select P.ID, P.Nazwisko '.
          'from Pracownicy P '.
          'where P.Logowanie = '.str2pgsql(strtoupper2($_POST['LOGOWANIE'])).
            ' and P.Haslo = '.str2pgsql(md5($_POST['HASLO'])).
            ' and P.DEL = 0';
        $qry = ibase_query($database, $sql);
        if ($row = ibase_fetch_assoc($qry)) {
          $_SESSION['zalogowany'] = ibase_gen_id('GENHISTORIA');
          $_SESSION['nazwiskozalogowanego'] = $row['NAZWISKO'];
          $sql = 'insert into Logowanie (ID, Pracownik, Logowanie, Stanowisko) values ('.$_SESSION['zalogowany'].', '.$row['ID'].' , current_timestamp, '.str2pgsql($_SERVER['HTTP_HOST']).')';
          ibase_query($database, $sql);
          baza_wyloguj();
          header("Location: index.php");
          exit();
        }
        else {
          baza_wyloguj();
          header("Location: login.php?zledane=1");
          exit();
        }
      }
    
      if (empty($_SESSION['zalogowany']))
        header("Location: login.php");
    }
