<?php
require_once "../app/core/Database.php";

class Wallet
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserWallet($filter = "all")
    {
        $this->db->query("SELECT * FROM wallet WHERE wallet_id=:wallet_id");
        $this->db->bind(":wallet_id", $_SESSION["user"]["wallet_id"]);
        $this->db->execute();
        return $this->db->result();
    }

    public function deposit($amount)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query("UPDATE wallet SET balance=balance+:amount WHERE wallet_id=:wallet_id");
            $this->db->bind(':amount', $amount);
            $this->db->bind(':wallet_id', $_SESSION["user"]["wallet_id"]);
            $this->db->execute();

            $this->db->commitTransaction();

            header("Location: dashboard/wallet");


        } catch (PDOException $e) {
            $this->db->rollback();
            header("Location: dashboard/error");
        }
    }

    public function withdraw($amount)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query("UPDATE wallet SET balance=balance-:amount WHERE wallet_id=:wallet_id AND balance >= :amount");
            $this->db->bind(':amount', $amount);
            $this->db->bind(':wallet_id', $_SESSION["user"]["wallet_id"]);
            $this->db->execute();

            $this->db->commitTransaction();

            header("Location: dashboard/wallet");

        } catch (PDOException $e) {
            $this->db->rollback();
            header("Location: dashboard/error");
        }
    }
}