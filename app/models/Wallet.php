<?php
require_once "../app/core/Database.php";

class Wallet
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get the wallet details of the current user
    public function getUserWallet()
    {
        // Query to get the total amount on hold for the user
        $this->db->query("
SELECT SUM(t.amount) AS onHold 
FROM users u 
    JOIN transaction t ON u.user_id=t.payee_id 
WHERE t.status='onhold' AND u.user_id=:user_id;");
        $this->db->bind(":user_id", $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $onHold = $this->db->result();

        // Query to get the total amount spent by the user
        $this->db->query("
SELECT SUM(t.amount) AS spent 
FROM users u 
    JOIN transaction t ON u.user_id=t.payer_id 
WHERE t.status='payed' AND u.user_id=:user_id;");
        $this->db->bind(":user_id", $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $spent = $this->db->result();

        // Query to get the total amount received by the user
        $this->db->query("
SELECT SUM(t.amount) AS received 
FROM users u 
    JOIN transaction t ON u.user_id=t.payee_id 
WHERE t.status='payed' AND u.user_id=:user_id;");
        $this->db->bind(":user_id", $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $received = $this->db->result();

        // Query to get the current balance of the user's wallet
        $this->db->query("SELECT w.balance FROM wallet w JOIN users u ON w.wallet_id=u.wallet_id WHERE u.user_id=:user_id;");
        $this->db->bind(":user_id", $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $balance = $this->db->result();

        // Return the wallet details as an associative array
        return ["onHold" => $onHold, "spent" => $spent, "received" => $received, "balance" => $balance];
    }

    // Deposit a specified amount into the user's wallet
    public function deposit($amount)
    {
        try {
            $this->db->beginTransaction();

            // Update the wallet balance by adding the deposit amount
            $this->db->query("UPDATE wallet SET balance=balance+:amount WHERE wallet_id=:wallet_id");
            $this->db->bind(':amount', $amount);
            $this->db->bind(':wallet_id', $_SESSION["user"]["wallet_id"]);
            $this->db->execute();

            $this->db->commitTransaction();

            // Redirect to the wallet dashboard
            header("Location: dashboard/wallet");

        } catch (PDOException $e) {
            $this->db->rollback();
            // Redirect to the error page in case of an exception
            header("Location: dashboard/error");
        }
    }

    // Withdraw a specified amount from the user's wallet
    public function withdraw($amount)
    {
        try {
            $this->db->beginTransaction();

            // Update the wallet balance by subtracting the withdrawal amount if sufficient balance is available
            $this->db->query("UPDATE wallet SET balance=balance-:amount WHERE wallet_id=:wallet_id AND balance >= :amount");
            $this->db->bind(':amount', $amount);
            $this->db->bind(':wallet_id', $_SESSION["user"]["wallet_id"]);
            $this->db->execute();

            $this->db->commitTransaction();

            // Redirect to the wallet dashboard
            header("Location: dashboard/wallet");

        } catch (PDOException $e) {
            $this->db->rollback();
            // Redirect to the error page in case of an exception
            header("Location: dashboard/error");
        }
    }
}