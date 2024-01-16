<?php

class db{
private $host = "localhost";
private $username = "sam";
private $password = "224657";
private $dbname = "lappyblog";

public function connect(){
    try {
        $dsn = "mysql:hostname=" . $this->host . ";dbname=". $this->dbname;
        $pdo = new PDO($dsn, $this->username, $this->password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;

    } catch (PDOException $e) {
       die ("ERROR MESSAGE:" . $e->getMessage());
    }
}

}

