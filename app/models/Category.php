<?php
require_once "../app/core/Database.php";

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllCategories()
    {
        $this->db->query("SELECT * FROM category");
        $this->db->execute();
        return $this->db->results();
    }

    public function getTrendingCategories()
    {
        $this->db->query(
            "SELECT COUNT(auction_item.auction_id) AS occurrence, category.* FROM category 
                JOIN auction_item ON category.category_id=auction_item.category_id 
                GROUP BY category.category_id 
                ORDER BY occurrence DESC LIMIT 12;"
        );
        $this->db->execute();
        return $this->db->results();
    }

    public function getCategory($id)
    {
        $this->db->query("SELECT * FROM category WHERE category_id=:id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->result();
    }

    public function addNew($name, $description, $image)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query("INSERT INTO category (name, description, picture) VALUES (:name, :description, :picture)");
            $this->db->bind(':name', $name);
            $this->db->bind(':description', $description);
            $this->db->bind(':picture', $image);
            $this->db->execute();

            $this->db->commitTransaction();

            header("Location: /bidgrab/public/dashboard/categories");
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->db->rollback();
        }
    }

    public function edit($id, $name, $description, $image)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query("UPDATE category SET name=:name, description=:description, picture=:picture WHERE category_id=:id");
            $this->db->bind(':name', $name);
            $this->db->bind(':description', $description);
            $this->db->bind(':picture', $image);
            $this->db->bind(':id', $id);
            $this->db->execute();

            $this->db->commitTransaction();
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->db->rollback();
        }
    }

    public function delete($id)
    {
        try {
            $this->db->beginTransaction();

            $this->db->query("SELECT picture FROM category WHERE category_id=:id");
            $this->db->bind(':id', $id);
            $this->db->execute();
            $picture = $this->db->result();

            if (!empty($picture["picture"])) {
                FileHandler::removeImage($picture["picture"], 'categoryImages');
            }

            $this->db->query("DELETE FROM category WHERE category_id=:id");
            $this->db->bind(':id', $id);
            $this->db->execute();

            $this->db->commitTransaction();

            header("Location: /bidgrab/public/dashboard/categories");
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->db->rollback();
        }
    }
}