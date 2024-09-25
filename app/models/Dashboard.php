<?php
require_once "../app/core/Database.php";

class Dashboard
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getDashboardHome()
    {
        if ($_SESSION["user"]["user_role"] == "admin") {
            $this->db->query("SELECT COUNT(order_id) AS sold_items FROM orders WHERE status=:status;");
            $this->db->bind(':status', 'completed');
            $this->db->execute();
            $orderCount = $this->db->result();

            $this->db->query("SELECT COUNT(auction_id) AS total FROM auction_item;");
            $this->db->execute();
            $auctionCount = $this->db->result();

            $this->db->query("SELECT COUNT(user_id) AS total FROM users;");
            $this->db->execute();
            $usersCount = $this->db->result();

            $this->db->query("SELECT SUM(transaction.amount) * 0.25 as revenue FROM transaction WHERE transaction.status=:status;");
            $this->db->bind(':status', 'payed');
            $this->db->execute();
            $revenueAdmin = $this->db->result();

            $this->db->query("SELECT auction_id, amount, time_stamp FROM bid LIMIT 10;");
            $this->db->execute();
            $recentBids = $this->db->results();

            $this->db->query("SELECT * FROM auction_item LIMIT 10;");
            $this->db->execute();
            $recentAuctions = $this->db->results();

            $this->db->query("
SELECT
    m.month,
    COALESCE(SUM(t.amount), 0) as sales
FROM
    (SELECT 'January' as month, 1 as month_num UNION ALL
     SELECT 'February', 2 UNION ALL
     SELECT 'March', 3 UNION ALL
     SELECT 'April', 4 UNION ALL
     SELECT 'May', 5 UNION ALL
     SELECT 'June', 6 UNION ALL
     SELECT 'July', 7 UNION ALL
     SELECT 'August', 8 UNION ALL
     SELECT 'September', 9 UNION ALL
     SELECT 'October', 10 UNION ALL
     SELECT 'November', 11 UNION ALL
     SELECT 'December', 12) as m
LEFT JOIN
    (SELECT MONTH(date) as month_num, SUM(amount) as amount
     FROM transaction
     WHERE status = 'payed'
     GROUP BY MONTH(date)) as t
ON m.month_num = t.month_num
GROUP BY m.month, m.month_num
ORDER BY m.month_num;
");
            $this->db->execute();
            $monthlySale = $this->db->results();


            return [
                "totalSoldItems" => $orderCount,
                "totalAuctions" => $auctionCount,
                "totalUsers" => $usersCount,
                "adminRev" => $revenueAdmin,
                "recentBids" => $recentBids,
                "recentAuctions" => $recentAuctions,
                "monthlySale" => $monthlySale,
            ];
        }

        $this->db->query("SELECT COUNT(order_id) AS total FROM orders WHERE buyer_id=:user_id AND NOT status=:status;");
        $this->db->bind(':status', 'canceled');
        $this->db->bind(':user_id', $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $userOrders = $this->db->result();

        $this->db->query("SELECT COUNT(auction_id) AS total FROM auction_item WHERE seller_id=:user_id;");
        $this->db->bind(':user_id', $_SESSION["user"]['user_id']);
        $this->db->execute();
        $userAuctions = $this->db->result();

        $this->db->query("SELECT COUNT(order_id) AS total FROM orders WHERE status=:status AND NOT orders.buyer_id=:user_id;");
        $this->db->bind(':status', 'completed');
        $this->db->bind(':user_id', $_SESSION['user']['user_id']);
        $this->db->execute();
        $soldCount = $this->db->result();

        $this->db->query("SELECT SUM(transaction.amount) - SUM(transaction.amount) * 0.25 as revenue
FROM transaction WHERE transaction.status=:status AND transaction.payee_id=:user_id;");
        $this->db->bind(':status', 'payed');
        $this->db->bind(':user_id', $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $userRevenue = $this->db->result();


        $this->db->query("SELECT auction_id, amount, time_stamp FROM bid WHERE user_id=:user_id LIMIT 10;");
        $this->db->bind(':user_id', $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $recentBids = $this->db->results();

        $this->db->query("SELECT * FROM auction_item WHERE seller_id=:user_id LIMIT 10;");
        $this->db->bind(':user_id', $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $recentAuctions = $this->db->results();

        $this->db->query("
SELECT
    m.month,
    COALESCE(SUM(t.amount), 0) as sales
FROM
    (SELECT 'January' as month, 1 as month_num UNION ALL
     SELECT 'February', 2 UNION ALL
     SELECT 'March', 3 UNION ALL
     SELECT 'April', 4 UNION ALL
     SELECT 'May', 5 UNION ALL
     SELECT 'June', 6 UNION ALL
     SELECT 'July', 7 UNION ALL
     SELECT 'August', 8 UNION ALL
     SELECT 'September', 9 UNION ALL
     SELECT 'October', 10 UNION ALL
     SELECT 'November', 11 UNION ALL
     SELECT 'December', 12) as m
LEFT JOIN
    (SELECT MONTH(date) as month_num, SUM(amount) as amount
     FROM transaction
     WHERE status = 'payed' AND payee_id=:user_id
     GROUP BY MONTH(date)) as t
ON m.month_num = t.month_num
GROUP BY m.month, m.month_num
ORDER BY m.month_num;
");
        $this->db->bind(':user_id', $_SESSION["user"]["user_id"]);
        $this->db->execute();
        $monthlySale = $this->db->results();

        return [
            "userOrders" => $userOrders,
            "userAuctions" => $userAuctions,
            "soldCount" => $soldCount,
            "userRev" => $userRevenue,
            "recentBids" => $recentBids,
            "recentAuctions" => $recentAuctions,
            "monthlySale" => $monthlySale,
        ];

    }
}