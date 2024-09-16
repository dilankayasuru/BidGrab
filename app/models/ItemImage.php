<?php
require_once "../app/core/Database.php";

class ItemImage {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getItemImages($auctionId)
    {
        $this->db->query("SELECT image FROM item_image WHERE auction_id=:auction_id");
        $this->db->bind(':auction_id', $auctionId);
        $this->db->execute();
        return $this->db->results();
    }
}