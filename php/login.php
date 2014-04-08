<?php

$db = $_POST['db'];
$table = $_POST['tabela'];

$_SESSION['login'] = 1;  
$_SESSION['host'] = $db;
$_SESSION['tabela'] = $table;

header('Location:'.$base);
exit();