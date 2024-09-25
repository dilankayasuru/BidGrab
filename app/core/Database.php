<?php

class Database
{
    // credentials for the database connection
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;
    private $dbPORT = DB_PORT;

    private $dbh; // DB Handler
    private $stmt; // DB Statement
    private $error; // DB Error

    // Initialize connection
    public function __construct()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;port=$this->dbPORT";

        // Persistent connection and throw PDO errors on error handling
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        // Try to establish connection
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Prepare SQL query
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Execute the prepared statement
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Fetch all results as an associative array
    public function results()
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch a single result as an associative array
    public function result()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Bind a value to a parameter in the prepared statement
    public function bind($param, $value)
    {
        $this->stmt->bindValue($param, $value);
    }

    // Begin a transaction
    public function beginTransaction()
    {
        $this->dbh->beginTransaction();
    }

    // Commit the current transaction
    public function commitTransaction()
    {
        return $this->dbh->commit();
    }

    // Roll back the current transaction
    public function rollback()
    {
        return $this->dbh->rollBack();
    }

    // Get the last inserted ID
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    // Get the number of affected rows
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}