<?php

class Database{
    private $serverName = "localhost";
    private $userName = "prince_sadariya";
    private $password = "deep70";
    private $dbName = "prince_sadariya1";

    protected function connect(){
        $conn = new mysqli($this->serverName,$this->userName,$this->password,$this->dbName);
        return $conn;
    }
}