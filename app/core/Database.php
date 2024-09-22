<?php

class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;
    private $dbPORT = DB_PORT;

    private $dbh; // DB Handler
    private $stmt; // DB Statement
    private $error; // DB Error

    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;port=$this->dbPORT";

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function results()
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function result()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function bind($param, $value)
    {
        $this->stmt->bindValue($param, $value);
    }

    public function beginTransaction()
    {
        $this->dbh->beginTransaction();
    }

    public function commitTransaction()
    {
        return $this->dbh->commit();
    }

    public function rollback()
    {
        return $this->dbh->rollBack();
    }

    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}