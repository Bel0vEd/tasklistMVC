<?php

class connect_database{

    private $link;
    private $mysqli;

    function __construct()
    {
        $hostDB = 'localhost';
        $database = 'tasklist';
        $userDB = 'belov';
        $passwordDB = 'qwert';
        $this->link = mysqli_connect($hostDB, $userDB, $passwordDB, $database);
        $this->mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
        if (!$this->link) {
            die('Ошибка соединения: ' . mysqli_error());
        }
    }

    public function getLink()
    {
        return $this->link;
    }
    public function getMysqli()
    {
        return $this->mysqli;
    }
        
}
?>
