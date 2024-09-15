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
        $this->db->query("SELECT * FROM orders");
        $this->db->execute();
        return $this->db->results();
    }
}