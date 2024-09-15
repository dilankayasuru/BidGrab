<?php
require_once "../app/core/Database.php";

class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addNew(
        $productTitle,
        $description,
        $condition,
        $category,
        $startDate,
        $endDate,
        $startTime,
        $endTime,
        $basePrice)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query("INSERT INTO auction_item (title, description, category_id, product_condition, start_date, end_date, start_time, end_time, current_price, seller_id) VALUES (:title, :description, :category, :condition, :start_date, :end_date, :start_time, :end_time, :current_price, :seller_id)");
            $this->db->bind(':title', $productTitle);
            $this->db->bind(':description', $description);
            $this->db->bind(':category', $category);
            $this->db->bind(':condition', $condition);
            $this->db->bind(':start_date', $startDate);
            $this->db->bind(':end_date', $endDate);
            $this->db->bind(':start_time', $startTime);
            $this->db->bind(':end_time', $endTime);
            $this->db->bind(':current_price', $basePrice);
            $this->db->bind(':seller_id', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            $temp = "Jewelry and accessories, Electronics, Mobile phones, Computers, Home appliance, Clothing, Furniture, Artworks, Shoes, Automotive, Grocery, Other";

            $this->db->commitTransaction();

            header("Location: ../dashboard?tab=auctions");
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    public function getAllAuctions($role)
    {
        $query = $role == "user" ? "SELECT * FROM auction_item WHERE seller_id=:userId" : "SELECT * FROM auction_item";
        $this->db->query($query);

        if ($role == "user") {
            $this->db->bind(':userId', $_SESSION["user"]["user_id"]);
        }

        $this->db->execute();
        return $this->db->results();
    }
}