<?php

class Database{
    private $serverName = "";
    private $userName = "";
    private $password = "";
    private $dbName = "";

    protected function connect(){
        $conn = new mysqli($this->serverName,$this->userName,$this->password,$this->dbName);
        return $conn;
    }
}
