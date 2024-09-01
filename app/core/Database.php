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
        $dsn = "mysql:host=$this->dbh;dbname=$this->dbname;port=$this->dbPORT";

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
            echo "Connected to the $this->dbname";

        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
}