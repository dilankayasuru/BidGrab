<?php
require_once "../app/core/Database.php";

class Category
{
    private $db;

    // Constructor to initialize the Database object
    public function __construct()
    {
        $this->db = new Database();
    }

    // Method to get all categories
    public function getAllCategories()
    {
        $this->db->query("SELECT * FROM category");
        $this->db->execute();
        return $this->db->results();
    }

    // Method to get trending categories based on the number of auction items
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

    // Method to get a specific category by ID
    public function getCategory($id)
    {
        $this->db->query("SELECT * FROM category WHERE category_id=:id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->result();
    }

    // Method to add a new category
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

            // Redirect to the categories dashboard after successful addition
            header("Location: /bidgrab/public/dashboard/categories");
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->db->rollback();
        }
    }

    // Method to edit an existing category
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

    // Method to delete a category by ID
    public function delete($id)
    {
        try {
            $this->db->beginTransaction();

            // Get the picture associated with the category
            $this->db->query("SELECT picture FROM category WHERE category_id=:id");
            $this->db->bind(':id', $id);
            $this->db->execute();
            $picture = $this->db->result();

            // Remove the image file if it exists
            if (!empty($picture["picture"])) {
                FileHandler::removeImage($picture["picture"], 'categoryImages');
            }

            // Delete the category from the database
            $this->db->query("DELETE FROM category WHERE category_id=:id");
            $this->db->bind(':id', $id);
            $this->db->execute();

            $this->db->commitTransaction();

            // Redirect to the categories dashboard after successful deletion
            header("Location: /bidgrab/public/dashboard/categories");
        } catch (Exception $e) {
            echo $e->getMessage();
            $this->db->rollback();
        }
    }
}