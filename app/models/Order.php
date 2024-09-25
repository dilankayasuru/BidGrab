<?php
require_once "../app/core/Database.php";

class Order
{
    private $db;

    public function __construct()
    {
        // Initialize the database connection
        $this->db = new Database();
    }

    public function getAllOrders()
    {
        // Check if the user is a regular user
        if ($_SESSION["user"]["user_role"] === "user") {
            // Query to get all orders for the logged-in user
            $this->db->query("
SELECT o.*, CONCAT(seller.first_name,' ',seller.last_name) AS seller, ai.image, item.title, c.name as category, item.auction_id
FROM orders o JOIN auction_item item ON o.item_id=item.auction_id 
JOIN users seller ON item.seller_id=seller.user_id JOIN category c ON c.category_id=item.category_id
JOIN item_image ai ON ai.auction_id=item.auction_id
WHERE o.buyer_id=:userId GROUP BY o.order_id
");
            $this->db->bind(':userId', $_SESSION["user"]["user_id"]);

            $this->db->execute();
            return $this->db->results();
        }

        // Query to get all orders with tracking numbers for admin
        $this->db->query("
SELECT o.*, 
CONCAT(seller.first_name, ' ', seller.last_name) as seller, 
CONCAT(buyer.first_name, ' ', buyer.last_name) as buyer
FROM orders o JOIN users buyer ON o.buyer_id=buyer.user_id
JOIN auction_item ON o.item_id=auction_item.auction_id
JOIN users seller ON auction_item.seller_id=seller.user_id
WHERE o.tracking_no IS NOT NULL
GROUP BY o.order_id
");
        $this->db->execute();
        return $this->db->results();
    }

    public function submitOrder($id, $tracking_no)
    {
        try {
            // Begin a transaction
            $this->db->beginTransaction();

            // Update the order with the tracking number
            $this->db->query("UPDATE orders SET tracking_no=:tracking_no WHERE item_id=:item_id");
            $this->db->bind(':tracking_no', $tracking_no);
            $this->db->bind(':item_id', $id);
            $this->db->execute();

            // Commit the transaction
            $this->db->commitTransaction();
        }
        catch (PDOException $e) {
            // Rollback the transaction in case of an error
            $this->db->rollback();
            echo $e->getMessage();
        }
    }

    public function manageOrder($id, $status)
    {
        try {
            // Begin a transaction
            $this->db->beginTransaction();

            // Update the order status
            $this->db->query("UPDATE orders SET status=:status WHERE order_id=:order_id");
            $this->db->bind(':status', $status);
            $this->db->bind(':order_id', $id);
            $this->db->execute();

            // Determine the transaction status based on the order status
            $transactionStatus = $status == "completed" ? "payed" : "canceled";

            // Update the transaction status
            $this->db->query("UPDATE transaction SET status=:status WHERE order_id=:order_id");
            $this->db->bind(':status', $transactionStatus);
            $this->db->bind(':order_id', $id);
            $this->db->execute();

            // Commit the transaction
            $this->db->commitTransaction();
            header('Location: '.BASE_URL.'dashboard/orders');
        }
        catch (PDOException $e) {
            // Rollback the transaction in case of an error
            $this->db->rollback();
            echo $e->getMessage();
        }
    }
}