<?php
require_once "../app/core/Database.php";

class Product
{
    private $db;

    public function __construct()
    {
        // Initialize the database connection
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
            // Begin a database transaction
            $this->db->beginTransaction();

            // Insert a new auction item into the auction_item table
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

            // Get the ID of the newly inserted auction item
            $auctionId = $this->db->lastInsertId();

            // Upload images associated with the auction item
            $this->uploadImages($auctionId);

            // Commit the transaction
            $this->db->commitTransaction();

            // Redirect to the auctions dashboard
            header("Location: /bidgrab/public/dashboard/auctions");
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $this->db->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }

    public function getRecentlyAddedAuctions()
    {
        // Begin a database transaction
        $this->db->beginTransaction();

        // Construct the query to fetch recently added auction items
        $query = "
    SELECT auction_item.*, item_image.image, category.name as category,
           CONCAT(auction_item.start_date,' ', auction_item.start_time) < NOW() AND CONCAT(auction_item.end_date,' ', auction_item.end_time) > NOW() AND auction_item.status = :status AS isLive,
           TIMEDIFF(CONCAT(auction_item.end_date,' ', auction_item.end_time), NOW()) AS timeDifference
    FROM auction_item LEFT JOIN item_image on auction_item.auction_id=item_image.image 
    LEFT JOIN category on category.category_id=auction_item.category_id 
    WHERE auction_item.status=:status AND CONCAT(auction_item.end_date,' ', auction_item.end_time) > NOW()
    GROUP BY auction_item.auction_id 
    ORDER by auction_item.date_added DESC LIMIT 10";

        // Prepare the query
        $this->db->query($query);

        // Bind the status parameter
        $this->db->bind(':status', 'approved');

        // Execute the query
        $this->db->execute();

        // Commit the transaction
        $this->db->commitTransaction();

        // Return the results of the query
        return $this->db->results();
    }

    public function getAllAuctions($role, $sort)
    {
        // Begin a database transaction
        $this->db->beginTransaction();

        // Determine the order by clause based on the sort parameter
        $orderBy = $sort == "latest" ? "ORDER BY date_added DESC" : ($sort == "old" ? "ORDER BY date_added ASC" : "");

        // Construct the main query to fetch auction items
        $query = "
    SELECT auction_item.*, 
           CONCAT(auction_item.start_date,' ', auction_item.start_time) < NOW() AND CONCAT(auction_item.end_date,' ', auction_item.end_time) > NOW() AND auction_item.status = :status AS isLive, 
           CONCAT(auction_item.end_date,' ', auction_item.end_time) < NOW() AS isExpired, 
           item_image.image, category.name as category, users.first_name as seller,
           orders.tracking_no, orders.status as order_status, orders.order_id as order_id, orders.buyer_id as buyer_id, orders.price as order_price
    FROM auction_item 
        LEFT JOIN item_image on auction_item.auction_id=item_image.image 
        LEFT JOIN category on category.category_id=auction_item.category_id 
        JOIN users on users.user_id=auction_item.seller_id
        LEFT OUTER JOIN orders ON auction_item.auction_id=orders.item_id";

        // If the role is 'user', add a condition to filter auctions by the seller ID
        if ($role == "user") {
            $query = $query . " WHERE auction_item.seller_id=:userId GROUP BY auction_item.auction_id $orderBy";
        } else {
            // Otherwise, group the results by auction ID and apply the order by clause
            $query = $query . " GROUP BY auction_item.auction_id " . $orderBy;
        }

        // Prepare the query
        $this->db->query($query);

        // Bind the user ID parameter if the role is 'user'
        if ($role == "user") {
            $this->db->bind(':userId', $_SESSION["user"]["user_id"]);
        }
        // Bind the status parameter
        $this->db->bind(':status', "approved");

        // Execute the query
        $this->db->execute();

        // Commit the transaction
        $this->db->commitTransaction();

        // Return the results of the query
        return $this->db->results();
    }

    private function uploadImages($auctionId)
    {
        // Loop through each uploaded file
        foreach ($_FILES['products']['tmp_name'] as $key => $tmp_name) {
            // Check if the file was uploaded
            if (is_uploaded_file($tmp_name)) {
                // Initialize the FileHandler for the 'products' directory
                $fileHandler = new FileHandler('products');
                // Set the temporary file details
                $fileHandler->tempFile = [
                    'name' => $_FILES['products']['name'][$key],
                    'type' => $_FILES['products']['type'][$key],
                    'tmp_name' => $tmp_name,
                    'error' => $_FILES['products']['error'][$key],
                    'size' => $_FILES['products']['size'][$key]
                ];
                // Upload the file and get the new file name
                $auctionImage = $fileHandler->uploadFile(uniqid("$auctionId-"), "auctionImages");

                // If the file was successfully uploaded insert the image record into the database
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
        // Filter and get the list of old images from the POST request
        $oldImages = array_filter(array_values($_POST['oldImages']));

        // Create a string of placeholders for the query
        $deleteArray = rtrim(str_repeat('?, ', count($oldImages)), ', ');

        // Prepare the SQL query to delete images that are not in the list of old images
        $this->db->query("DELETE FROM item_image WHERE auction_id=? AND image NOT IN ($deleteArray)");

        // Bind the auction ID to the query
        $this->db->bind(1, $auctionId);

        // Bind each old image to the query
        foreach ($oldImages as $index => $image) {
            $this->db->bind($index + 2, $image);
        }

        // Execute the query
        $this->db->execute();

        // Remove the old images from the file system
        FileHandler::removeAuctionImages($auctionId, $oldImages);
    }

    public function deleteProduct($id)
    {
        try {
            // Begin a database transaction
            $this->db->beginTransaction();
            $this->db->query("DELETE FROM auction_item WHERE auction_id=:auctionId");
            $this->db->bind(':auctionId', $id);
            $this->db->execute();

            if ($this->db->commitTransaction()) {
                FileHandler::removeAuctionImages($id);
            }

            // Redirect to the auctions dashboard
            header("Location: /bidgrab/public/dashboard/auctions");
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $this->db->rollback();
            echo $e->getMessage();
        }
    }

    public function getProduct($id): array
    {
        // Begin a database transaction
        $this->db->beginTransaction();

        // Prepare the SQL query to select the auction item details
        $this->db->query(
            "
        SELECT *, 
               (SELECT name FROM category WHERE category_id=auction_item.category_id) as category, 
               (SELECT COUNT(bid_id) FROM bid WHERE auction_id=auction_item.auction_id) as bidCount
        FROM auction_item WHERE auction_id=:auctionId"
        );
        // Bind the auction ID parameter to the query
        $this->db->bind(':auctionId', $id);
        // Execute the query
        $this->db->execute();

        // Fetch the auction item details
        $product = $this->db->result();

        // Prepare the SQL query to select the images associated with the auction item
        $this->db->query("SELECT image FROM item_image WHERE auction_id=:auctionId");
        // Bind the auction ID parameter to the query
        $this->db->bind(':auctionId', $id);
        // Execute the query
        $this->db->execute();

        // Fetch the images
        $images = $this->db->results();

        // Prepare the SQL query to select the seller details
        $this->db->query("SELECT first_name, last_name, rating_count as rating, profile_pic FROM users WHERE user_id=:id");
        // Bind the seller ID parameter to the query
        $this->db->bind(':id', $product["seller_id"]);
        // Execute the query
        $this->db->execute();

        // Fetch the seller details
        $seller = $this->db->result();

        // Prepare the SQL query to check if the auction has started or expired
        $this->db->query("SELECT CONCAT(start_date,' ', start_time) < NOW() AS isStarted, CONCAT(end_date,' ', end_time) < NOW() AS isExpired FROM auction_item WHERE auction_id=:auction_id");
        // Bind the auction ID parameter to the query
        $this->db->bind(':auction_id', $id);
        // Execute the query
        $this->db->execute();

        // Fetch the auction status
        $isStarted = $this->db->result()["isStarted"];
        $isExpired = $this->db->result()["isExpired"];

        // Commit the transaction
        $this->db->commitTransaction();

        // If the product is not found, redirect to the item-not-found page
        if (!$product) {
            header("Location: item-not-found");
        }

        // Return the product details, images, seller details, and auction status
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
            // Begin a database transaction
            $this->db->beginTransaction();

            // Prepare the SQL query to update the auction item
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

            // Bind the parameters to the query
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

            // Execute the query
            $this->db->execute();

            // Remove old images associated with the auction item
            $this->removeOldImages($id);

            // Upload new images for the auction item
            $this->uploadImages($id);

            // Commit the transaction
            $this->db->commitTransaction();

            // Redirect to the auctions dashboard
            header("Location: /bidgrab/public/dashboard/auctions");
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $this->db->rollback();
            echo $e->getMessage();
        }
    }

    public function getCountOfAuctions()
    {
        // Begin a database transaction
        $this->db->beginTransaction();

        // Prepare the query to count the number of auctions
        $this->db->query("SELECT COUNT(auction_id) as auctionCount FROM auction_item");

        // Execute the query
        $this->db->execute();

        // Commit the transaction
        $this->db->commitTransaction();

        // Return the result of the query
        return $this->db->result();
    }

    public function displayAuctions($category = "all", $sort = '', $status = 'approved', $search = '')
    {
        // Begin a database transaction
        $this->db->beginTransaction();

        // If a search term is provided, perform a full-text search
        if (!empty($search)) {
            $query = "
SELECT 
    auction_item.*,
    CONCAT(auction_item.end_date,' ', auction_item.end_time) < NOW() AS isExpired,
    CONCAT(auction_item.start_date,' ', auction_item.start_time) < NOW() AND CONCAT(auction_item.end_date,' ', auction_item.end_time) > NOW() AND auction_item.status = :status AS isLive,
    item_image.image, category.name as category 
FROM auction_item LEFT JOIN item_image on auction_item.auction_id=item_image.image 
    LEFT JOIN category on category.category_id=auction_item.category_id 
WHERE auction_item.status=:status AND MATCH(auction_item.title, auction_item.description) 
AGAINST(:search IN BOOLEAN MODE) 
GROUP BY auction_item.auction_id;";

            // Prepare and execute the query
            $this->db->query($query);
            $this->db->bind(':status', $status);
            $this->db->bind(':search', $search);
            $this->db->execute();

            // Commit the transaction and return the results
            $this->db->commitTransaction();
            return $this->db->results();
        }

        // If a specific category is selected, add a category filter to the query
        if ($category !== "all") {
            $categoryQuery = ' AND category.category_id=:categoryId';
        } else {
            $categoryQuery = '';
        }

        // Determine the sorting order based on the provided sort parameter
        $sortQuery = '';
        if ($sort !== '') {
            $sortQuery = 'ORDER by auction_item.' . $sort;
        }

        // Construct the main query to fetch auction items
        $query = "
SELECT 
    auction_item.*,
    CONCAT(auction_item.end_date,' ', auction_item.end_time) < NOW() AS isExpired,
    CONCAT(auction_item.start_date,' ', auction_item.start_time) < NOW() AND CONCAT(auction_item.end_date,' ', auction_item.end_time) > NOW() AND auction_item.status = :status AS isLive,
    item_image.image, category.name as category 
FROM auction_item LEFT JOIN item_image on auction_item.auction_id=item_image.image 
    LEFT JOIN category on category.category_id=auction_item.category_id WHERE auction_item.status=:status$categoryQuery GROUP BY auction_item.auction_id $sortQuery";

        // Prepare and execute the query
        $this->db->query($query);
        if ($category !== "all") {
            $this->db->bind(':categoryId', $category);
        }
        $this->db->bind(':status', $status);
        $this->db->execute();

        // Commit the transaction and return the results
        $this->db->commitTransaction();
        return $this->db->results();
    }

    public function changeStatus($status, $id)
    {
        try {
            // Begin a database transaction
            $this->db->beginTransaction();

            // Update the status of the auction item with the given ID
            $this->db->query("UPDATE auction_item SET status=:status WHERE auction_id=:id");
            $this->db->bind(':status', $status);
            $this->db->bind(':id', $id);
            $this->db->execute();

            // Commit the transaction
            $this->db->commitTransaction();
        } catch (PDOException $e) {
            // Output the error message in case of an exception
            echo $e->getMessage();
        }
    }

    public function placeBid($auctionId, $amount)
    {
        // Begin a database transaction
        $this->db->beginTransaction();

        try {
            // Retrieve the current price and wallet ID of the previous highest bidder
            $this->db->query("
SELECT ai.current_price, w.wallet_id
FROM auction_item ai JOIN users ON ai.winner=users.user_id 
JOIN wallet w ON w.wallet_id=users.wallet_id
WHERE auction_id=:auction_id");
            $this->db->bind(':auction_id', $auctionId);
            $this->db->execute();
            $oldBidInfo = $this->db->result();

            // If there was a previous bid, refund the previous highest bidder
            if (!empty($oldBidInfo)) {
                $this->db->query("UPDATE wallet SET balance=balance+:prevBid WHERE wallet_id=:wallet_id");
                $this->db->bind(':prevBid', $oldBidInfo["current_price"]);
                $this->db->bind(':wallet_id', $oldBidInfo["wallet_id"]);
                $this->db->execute();
            }

            // Check if the current user has sufficient balance to place the bid
            $this->db->query("SELECT balance >= :amount as sufficientBalance FROM wallet WHERE wallet_id=(SELECT wallet_id FROM users WHERE user_id=:user_id)");
            $this->db->bind(':amount', $amount);
            $this->db->bind(':user_id', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            // If the user does not have sufficient balance, throw an exception
            if (!$this->db->result()["sufficientBalance"]) {
                throw new Exception("Insufficient wallet balance");
            }

            // Deduct the bid amount from the current user's wallet
            $this->db->query("UPDATE wallet SET balance=balance-:amount WHERE wallet_id=(SELECT wallet_id FROM users WHERE user_id=:user_id)");
            $this->db->bind(':amount', $amount);
            $this->db->bind(':user_id', $_SESSION["user"]["user_id"]);
            $this->db->execute();

            // Insert the new bid into the bid table
            $this->db->query("INSERT INTO bid (auction_id, user_id, amount) VALUES (:auction_id, :user_id, :amount)");
            $this->db->bind(':auction_id', $auctionId);
            $this->db->bind(':user_id', $_SESSION["user"]["user_id"]);
            $this->db->bind(':amount', $amount);
            $this->db->execute();

            // Update the auction item with the new highest bid and winner
            $this->db->query("UPDATE auction_item SET current_price=:amount, winner=:userId WHERE auction_id=:auction_id");
            $this->db->bind(':amount', $amount);
            $this->db->bind(':userId', $_SESSION["user"]["user_id"]);
            $this->db->bind(':auction_id', $auctionId);
            $this->db->execute();

            // Commit the transaction
            $this->db->commitTransaction();
            return true;
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $this->db->rollback();
            return false;
        }
    }
}