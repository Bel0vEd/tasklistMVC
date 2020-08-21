<?php
    $hostDB = 'localhost';
    $database = 'tasklist';
    $userDB = 'belov';
    $passwordDB = 'qwert';
    $link = mysqli_connect($hostDB, $userDB, $passwordDB, $database);
    if (!$link) {
        die('Ошибка соединения: ' . mysqli_error());
    }
?>