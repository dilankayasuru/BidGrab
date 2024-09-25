<?php
require_once "../app/core/Database.php";

class Transactions
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function newTransaction($payeeId, $payerId, $orderId, $amount)
    {
        $this->db->beginTransaction();

        try {

            $this->db->query("
INSERT INTO transaction 
    (payee_id, payer_id, order_id, amount) 
VALUES 
    (:payee_id, :payer_id, :order_id, :amount)");
            $this->db->bind(':payee_id', $payeeId);
            $this->db->bind(':payer_id', $payerId);
            $this->db->bind(':order_id', $orderId);
            $this->db->bind(':amount', $amount);

            $this->db->execute();
            $this->db->commitTransaction();
        }
        catch (Exception $e) {
            $this->db->rollback();
            echo $e->getMessage();
        }
    }

    public function updateTransaction($id, $status)
    {
        $this->db->beginTransaction();

        try {

            $this->db->query("UPDATE transaction SET status=:status WHERE order_id=:order_id");
            $this->db->bind(':status', $status);
            $this->db->bind(':order_id', $id);
            $this->db->execute();
            $this->db->commitTransaction();
        }
        catch (Exception $e) {
            $this->db->rollback();
            echo $e->getMessage();
        }
    }

    public function getTransactions($filter = "all", $sort = "default")
    {
        $this->db->beginTransaction();

        try {
            $sortQuery = $sort == "old" ? " ORDER BY date ASC" : ($sort == "new" ? " ORDER BY date DESC" : "");

            if ($_SESSION["user"]["user_role"] === "admin") {
                $this->db->query("SELECT * FROM transaction".$sortQuery);
            } else {
                $filterQuery = $filter === "incoming" ? "payee_id=:userId" : ($filter === "outgoing;" ? "payer_id=:userId" : "payee_id=:userId OR payer_id=:userId");
                $this->db->query("SELECT * FROM transaction WHERE ".$filterQuery.$sortQuery);
                $this->db->bind(':userId', $_SESSION["user"]["user_id"]);
            }
            $this->db->execute();
            $this->db->commitTransaction();

            return $this->db->results();
        }
        catch (Exception $e) {
            $this->db->rollback();
            echo $e->getMessage();
        }
    }
}