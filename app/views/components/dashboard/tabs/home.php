<?php require_once "../app/views/components/dashboard/displayCards.php"; ?>
<div class="flex justify-start items-center gap-4 mb-4">
    <?php if ($_SESSION["user"]["user_role"] == "admin") : ?>
        <?= displayCard("Total Users", $tabData["totalUsers"]["total"] ?? 0, 'fa-solid fa-users'); ?>
    <?php endif; ?>
    <?php if ($_SESSION["user"]["user_role"] == "user") : ?>
        <?= displayCard("Orders", $tabData["userOrders"]["total"] ?? 0, 'fa-solid fa-truck-fast'); ?>
    <?php endif; ?>
    <?= displayCard("Total Auctions", $tabData["totalAuctions"]["total"] ?? $tabData["userAuctions"]["total"] ?? 0, 'fa-solid fa-boxes-packing'); ?>
    <?= displayCard("Sold Items", $tabData["totalSoldItems"]["sold_items"] ?? $tabData["soldCount"]["total"] ?? 0, 'fa-solid fa-cart-flatbed'); ?>
    <?= displayCard("Total Revenue", 'Rs. '.($tabData["adminRev"]["revenue"] ?? $tabData["userRev"]["revenue"] ?? 0), 'fa-solid fa-chart-column'); ?>
</div>
<div class="flex gap-4 mb-4">
    <div class='w-full border border-blue-500 rounded-xl p-4 bg-fadeWhite'>
        <div class='mb-4'>
            <h1>Recently activities</h1>
        </div>
        <div>
            <div class='grid grid-cols-3 place-items-center text-gray pb-2'>
                <p>Auction</p>
                <p>Amount</p>
                <p>Time</p>
            </div>
            <?php foreach ($tabData["recentBids"] as $bid) : ?>
                <div class='grid grid-cols-3 place-items-center mb-1'>
                    <p><?= $bid["auction_id"] ?></p>
                    <p><?= 'Rs. '.$bid["amount"] ?></p>
                    <p><?= date('Y/m/d',strtotime($bid["time_stamp"])) ?></p>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <?php if ($_SESSION["user"]["user_role"] == "admin") : ?>
        <div class='w-full border border-blue-500 rounded-xl p-4 bg-fadeWhite'>
            <div class='mb-4'>
                <h1>Recently added auctions</h1>
            </div>
            <div>
                <div class='grid grid-cols-3 place-items-center text-gray pb-2'>
                    <p>Title</p>
                    <p>Current Price</p>
                    <p>Status</p>
                </div>
                <?php foreach ($tabData["recentAuctions"] as $auction) : ?>
                    <div class='grid grid-cols-3 place-items-center mb-1'>
                        <p><?= $auction["title"] ?></p>
                        <p><?= 'Rs. '.$auction["current_price"] ?></p>
                        <p><?= $auction["status"] ?></p>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    <?php else: ?>
        <?php require_once "../app/views/components/dashboard/cards/profileCard.php"; ?>
    <?php endif; ?>

</div>
<?php require_once "../app/views/components/dashboard/cards/monthlySale.php"; ?>
