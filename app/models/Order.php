<?php
require_once "../app/core/Database.php";

class Order
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllOrders()
    {

        if ($_SESSION["user"]["user_role"] === "user") {

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
}