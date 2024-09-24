<?php
require_once '../app/config/config.php';
require_once '../app/core/Database.php';
$db = new Database();

try {
    $db->beginTransaction();

    $db->query("
UPDATE auction_item SET status=:status
WHERE winner IS NOT NULL AND CONCAT(auction_item.end_date,' ', auction_item.end_time) < NOW() AND NOT status=:status
");
    $db->bind(':status', 'completed');
    $db->execute();

    $db->query("
INSERT INTO orders (item_id, buyer_id, price)
SELECT DISTINCT auction_item.auction_id, auction_item.winner, auction_item.current_price
FROM auction_item
LEFT JOIN orders ON auction_item.auction_id = orders.item_id
WHERE auction_item.status=:status AND auction_item.winner IS NOT NULL AND orders.item_id IS NULL
");
    $db->bind(':status', 'completed');
    $db->execute();

    $response = $db->commitTransaction();

    echo $response ? 'Executed' : 'Failed to execute';
}
catch (PDOException $e) {
    $db->rollback();
    echo $e->getMessage();
}


