<?php
require_once "../app/core/Database.php";

class Wallet
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserWallet()
    {
        $this->db->query("
SELECT SUM(t.amount) AS onHold 
FROM users u 
    JOIN transaction t ON u.user_id=t.payee_id 
WHERE t.status='onhold' AND u.user_id=:user_id;");
        $this->db->bind(":user_id", $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $onHold = $this->db->result();

        $this->db->query("
SELECT SUM(t.amount) AS spent 
FROM users u 
    JOIN transaction t ON u.user_id=t.payer_id 
WHERE t.status='payed' AND u.user_id=:user_id;");
        $this->db->bind(":user_id", $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $spent = $this->db->result();


        $this->db->query("
SELECT SUM(t.amount) AS received 
FROM users u 
    JOIN transaction t ON u.user_id=t.payee_id 
WHERE t.status='payed' AND u.user_id=:user_id;");
        $this->db->bind(":user_id", $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $received = $this->db->result();

        $this->db->query("SELECT w.balance FROM wallet w JOIN users u ON w.wallet_id=u.wallet_id WHERE u.user_id=:user_id;");
        $this->db->bind(":user_id", $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $balance = $this->db->result();

        return ["onHold" => $onHold, "spent" => $spent, "received" => $received, "balance" => $balance];


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