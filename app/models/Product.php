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

            $this->db->query("INSERT INTO auction_item (title, description, category_id, product_condition, start_date, end_date, start_time, end_time, current_price, base_price, seller_id) VALUES (:title, :description, :category, :condition, :start_date, :end_date, :start_time, :end_time, :current_price, :base_price, :seller_id)");
            $this->db->bind(':title', $productTitle);
            $this->db->bind(':description', $description);
            $this->db->bind(':category', $category);
            $this->db->bind(':condition', $condition);
            $this->db->bind(':start_date', $startDate);
            $this->db->bind(':end_date', $endDate);
            $this->db->bind(':start_time', $startTime);
            $this->db->bind(':end_time', $endTime);
            $this->db->bind(':current_price', $basePrice);
            $this->db->bind(':base_price', $basePrice);
            $this->db->bind(':seller_id', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            $auctionId = $this->db->lastInsertId();

            $this->uploadImages($auctionId);

            $this->db->commitTransaction();

            header("Location: /bidgrab/public/dashboard/auctions");
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    public function getRecentlyAddedAuctions()
    {
        $this->db->beginTransaction();

        $query = "
SELECT auction_item.*, item_image.image, category.name as category 
FROM auction_item LEFT JOIN item_image on auction_item.auction_id=item_image.image 
    LEFT JOIN category on category.category_id=auction_item.category_id WHERE auction_item.status=:status GROUP BY auction_item.auction_id ORDER by auction_item.date_added DESC LIMIT 10";

        $this->db->query($query);

        $this->db->bind(':status', 'live');

        $this->db->execute();

        $this->db->commitTransaction();

        return $this->db->results();
    }

    public function getAllAuctions($role, $sort)
    {
        $this->db->beginTransaction();

        $orderBy = $sort == "latest" ? "ORDER BY date_added DESC" : ($sort == "old" ? "ORDER BY date_added ASC" : "");

        $query = "
SELECT auction_item.*, CONCAT(auction_item.start_date,' ', auction_item.start_time) < NOW() AS isLive, CONCAT(auction_item.end_date,' ', auction_item.end_time) < NOW() AS isExpired, item_image.image, category.name as category, users.first_name as seller 
FROM auction_item LEFT JOIN item_image on auction_item.auction_id=item_image.image 
    LEFT JOIN category on category.category_id=auction_item.category_id JOIN users on users.user_id=auction_item.seller_id";

        if ($role == "user") {
            $query = $query . " WHERE auction_item.seller_id=:userId GROUP BY auction_item.auction_id $orderBy";
        } else {
            $query = $query . " GROUP BY auction_item.auction_id " . $orderBy;
        }

        $this->db->query($query);

        if ($role == "user") {
            $this->db->bind(':userId', $_SESSION["user"]["user_id"]);
        }

        $this->db->execute();

        $this->db->commitTransaction();

        return $this->db->results();
    }

    private function uploadImages($auctionId)
    {
        foreach ($_FILES['products']['tmp_name'] as $key => $tmp_name) {
            if (is_uploaded_file($tmp_name)) {
                $fileHandler = new FileHandler('products');
                $fileHandler->tempFile = [
                    'name' => $_FILES['products']['name'][$key],
                    'type' => $_FILES['products']['type'][$key],
                    'tmp_name' => $tmp_name,
                    'error' => $_FILES['products']['error'][$key],
                    'size' => $_FILES['products']['size'][$key]
                ];
                $auctionImage = $fileHandler->uploadFile(uniqid("$auctionId-"), "auctionImages");

                if ($auctionImage) {
                    $this->db->query("INSERT INTO item_image (auction_id, image) VALUES (:auction_id, :image)");
                    $this->db->bind(':auction_id', $auctionId);
                    $this->db->bind(':image', $auctionImage);
                    $this->db->execute();
                }
            }
        }
    }

    private function removeOldImages($auctionId)
    {
        $oldImages = array_filter(array_values($_POST['oldImages']));
        $deleteArray = rtrim(str_repeat('?, ', count($oldImages)), ', ');
        $this->db->query("DELETE FROM item_image WHERE auction_id=? AND image NOT IN ($deleteArray)");
        $this->db->bind(1, $auctionId);

        foreach ($oldImages as $index => $image) {
            $this->db->bind($index + 2, $image);
        }
        $this->db->execute();

        FileHandler::removeAuctionImages($auctionId, $oldImages);
    }

    public function deleteProduct($id)
    {
        try {
            $this->db->beginTransaction();
            $this->db->query("DELETE FROM auction_item WHERE auction_id=:auctionId");
            $this->db->bind(':auctionId', $id);
            $this->db->execute();

            if ($this->db->commitTransaction()) {
                FileHandler::removeAuctionImages($id);
            }

            header("Location: /bidgrab/public/dashboard/auctions");
        } catch (Exception $e) {
            $this->db->rollback();
            echo $e->getMessage();
        }
    }

    public function getProduct($id): array
    {
        $this->db->beginTransaction();

        $this->db->query("SELECT *, (SELECT name FROM category WHERE category_id=auction_item.category_id) as category FROM auction_item WHERE auction_id=:auctionId");
        $this->db->bind(':auctionId', $id);
        $this->db->execute();

        $product = $this->db->result();

        $this->db->query("SELECT image FROM item_image WHERE auction_id=:auctionId");
        $this->db->bind(':auctionId', $id);
        $this->db->execute();

        $images = $this->db->results();

        $this->db->query("SELECT first_name, last_name, rating_count as rating, profile_pic FROM users WHERE user_id=:id");
        $this->db->bind(':id', $product["seller_id"]);
        $this->db->execute();

        $seller = $this->db->result();

        $this->db->query("SELECT CONCAT(start_date,' ', start_time) < NOW() AS isStarted, CONCAT(end_date,' ', end_time) < NOW() AS isExpired FROM auction_item WHERE auction_id=:auction_id");
        $this->db->bind(':auction_id', $id);
        $this->db->execute();

        $isStarted = $this->db->result()["isStarted"];
        $isExpired = $this->db->result()["isExpired"];

        $this->db->commitTransaction();

        if (!$product) {
            header("Location: item-not-found");
        }

        return ["product" => $product, "images" => $images, "seller" => $seller, "isStarted" => $isStarted, "isExpired" => $isExpired];
    }

    public function editProduct(
        $id,
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
            $this->db->query(
                "UPDATE auction_item SET
                        title=:title,
                        description=:description,
                        product_condition=:condition,
                        category_id=:category,
                        start_date=:start_date,
                        end_date=:end_date,
                        start_time=:start_time,
                        end_time=:end_time,
                        base_price=:base_price,
                        status=:status
                    WHERE auction_id=:auctionId"
            );
            $this->db->bind(':auctionId', $id);
            $this->db->bind(':title', $productTitle);
            $this->db->bind(':description', $description);
            $this->db->bind(':condition', $condition);
            $this->db->bind(':category', $category);
            $this->db->bind(':start_date', $startDate);
            $this->db->bind(':end_date', $endDate);
            $this->db->bind(':start_time', $startTime);
            $this->db->bind(':end_time', $endTime);
            $this->db->bind(':base_price', $basePrice);
            $this->db->bind(':status', 'pending');
            $this->db->execute();

            $this->removeOldImages($id);

            $this->uploadImages($id);

            $this->db->commitTransaction();

            header("Location: /bidgrab/public/dashboard/auctions");
        } catch (Exception $e) {
            $this->db->rollback();
            echo $e->getMessage();
        }
    }

    public function getCountOfAuctions()
    {
        $this->db->beginTransaction();
        $this->db->query("SELECT COUNT(auction_id) as auctionCount FROM auction_item");
        $this->db->execute();
        $this->db->commitTransaction();
        return $this->db->result();
    }

    public function displayAuctions($category = "all", $sort = '', $status = 'approved')
    {
        $this->db->beginTransaction();

        if ($category !== "all") {
            $categoryQuery = ' AND category.category_id=:categoryId';
        } else {
            $categoryQuery = '';
        }

        $sortQuery = '';

        if ($sort !== '') {
            $sortQuery = 'ORDER by auction_item.' . $sort;
        }

        $query = "
SELECT auction_item.*, item_image.image, category.name as category 
FROM auction_item LEFT JOIN item_image on auction_item.auction_id=item_image.image 
    LEFT JOIN category on category.category_id=auction_item.category_id WHERE auction_item.status=:status$categoryQuery GROUP BY auction_item.auction_id $sortQuery";

        $this->db->query($query);

        if ($category !== "all") {
            $this->db->bind(':categoryId', $category);
        }
        $this->db->bind(':status', $status);

        $this->db->execute();

        $this->db->commitTransaction();

        return $this->db->results();
    }

    public function changeStatus($status, $id)
    {
        try {
            $this->db->beginTransaction();
            $this->db->query("UPDATE auction_item SET status=:status WHERE auction_id=:id");
            $this->db->bind(':status', $status);
            $this->db->bind(':id', $id);
            $this->db->execute();
            $this->db->commitTransaction();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}