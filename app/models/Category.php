<?php
require_once "../app/core/Database.php";

class Category {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAllCategories()
    {
        $this->db->query("SELECT category_id, name FROM category");
        $this->db->execute();
        return $this->db->results();
    }
}