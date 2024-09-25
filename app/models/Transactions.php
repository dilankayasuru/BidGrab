<?php
require_once "../app/core/Database.php";

class Transactions
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Create a new transaction record in the database.
    public function newTransaction($payeeId, $payerId, $orderId, $amount)
    {
        // Begin a database transaction
        $this->db->beginTransaction();

        try {
            // Insert a new transaction record
            $this->db->query("
INSERT INTO transaction 
    (payee_id, payer_id, order_id, amount) 
VALUES 
    (:payee_id, :payer_id, :order_id, :amount)");
            $this->db->bind(':payee_id', $payeeId);
            $this->db->bind(':payer_id', $payerId);
            $this->db->bind(':order_id', $orderId);
            $this->db->bind(':amount', $amount);

            // Execute the query and commit the transaction
            $this->db->execute();
            $this->db->commitTransaction();
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $this->db->rollback();
            echo $e->getMessage();
        }
    }

    // Update the status of a transaction.
    public function updateTransaction($id, $status)
    {
        // Begin a database transaction
        $this->db->beginTransaction();

        try {
            // Update the status of the transaction
            $this->db->query("UPDATE transaction SET status=:status WHERE order_id=:order_id");
            $this->db->bind(':status', $status);
            $this->db->bind(':order_id', $id);

            // Execute the query and commit the transaction
            $this->db->execute();
            $this->db->commitTransaction();
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $this->db->rollback();
            echo $e->getMessage();
        }
    }

    // Retrieve transactions based on filter and sort criteria.

    public function getTransactions($filter = "all", $sort = "default")
    {
        // Begin a database transaction
        $this->db->beginTransaction();

        try {
            // Determine the sort query based on the sort criteria
            $sortQuery = $sort == "old" ? " ORDER BY date ASC" : ($sort == "new" ? " ORDER BY date DESC" : "");

            if ($_SESSION["user"]["user_role"] === "admin") {
                // Admin can view all transactions
                $this->db->query("SELECT * FROM transaction" . $sortQuery);
            } else {
                // Non-admin users can view their own transactions based on the filter criteria
                $filterQuery = $filter === "incoming" ? "payee_id=:userId" : ($filter === "outgoing" ? "payer_id=:userId" : "payee_id=:userId OR payer_id=:userId");
                $this->db->query("SELECT * FROM transaction WHERE " . $filterQuery . $sortQuery);
                $this->db->bind(':userId', $_SESSION["user"]["user_id"]);
            }

            // Execute the query and commit the transaction
            $this->db->execute();
            $this->db->commitTransaction();

            // Return the results
            return $this->db->results();
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $this->db->rollback();
            echo $e->getMessage();
        }
    }
}