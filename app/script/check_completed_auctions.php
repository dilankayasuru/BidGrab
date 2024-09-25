<?php
require_once '../app/config/config.php';
require_once '../app/core/Database.php';

// Create a new instance of the Database class
$db = new Database();

try {
    // Begin a new transaction
    $db->beginTransaction();

    // Update the status of auction items to 'completed' if they have a winner and the auction has ended
    $db->query("
    UPDATE auction_item SET status=:status
    WHERE winner IS NOT NULL AND CONCAT(auction_item.end_date,' ', auction_item.end_time) < NOW() AND NOT status=:status
    ");
    $db->bind(':status', 'completed');
    $db->execute();

    // Insert new orders for completed auction items that have a winner and no existing order
    $db->query("
    INSERT INTO orders (item_id, buyer_id, price)
    SELECT DISTINCT auction_item.auction_id, auction_item.winner, auction_item.current_price
    FROM auction_item
    LEFT JOIN orders ON auction_item.auction_id = orders.item_id
    WHERE auction_item.status=:status AND auction_item.winner IS NOT NULL AND orders.item_id IS NULL
    ");
    $db->bind(':status', 'completed');
    $db->execute();

    // Insert new transactions for completed auction items that have a winner and no existing transaction
    $db->query("
    INSERT INTO transaction (payee_id, payer_id, order_id, amount) 
    SELECT DISTINCT auction_item.seller_id, auction_item.winner, orders.order_id, auction_item.current_price
    FROM auction_item
    LEFT JOIN orders ON auction_item.auction_id = orders.item_id
    LEFT JOIN transaction ON orders.order_id = transaction.order_id
    WHERE auction_item.status=:status AND auction_item.winner IS NOT NULL AND transaction.transaction_id IS NULL
    ");
    $db->bind(':status', 'completed');
    $db->execute();

    // Commit the transaction
    $response = $db->commitTransaction();

    // Output the result of the transaction
    echo $response ? 'Executed' : 'Failed to execute';
} catch (PDOException $e) {
    // Rollback the transaction in case of an error
    $db->rollback();
    echo $e->getMessage();
}