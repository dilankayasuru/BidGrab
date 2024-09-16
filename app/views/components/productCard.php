<div class="product-card rounded-xl border border-blue-500 shadow-md p-2 w-full bg-white">
    <div class="product-image mb-2">
        <?php
        if (empty($product["image"])) {
            $imageSrc = "/bidgrab/public/images/placeholder.png";
        } else {
            $imageSrc = "/bidgrab/app/server/auctionImages/" . $product["image"];
        }
        ?>
        <img src="<?= $imageSrc ?>" alt="shoe image" class="w-full h-32 object-cover rounded-lg">
    </div>
    <div class="product-name mb-2">
        <p><?= $product["title"] ?></p>
        <p class="text-gray text-sm"><?= $product["category"] ?></p>
    </div>
    <div class="bidding-info mb-4 flex justify-between gap-2">
        <div class="bidding-info-left">
            <p>Last Bid</p>
            <p class="text-sm border border-blue-500 bg-fadeWhite py-2 px-4 rounded-lg">Rs. <?= $product["current_price"] ?></p>
        </div>
        <div class="biddin-info-right">
            <p>Ending in</p>
            <?php
            $endTimeStamp = new DateTime($product["end_date"] . " " . $product["end_time"]);
            $now = new DateTime();
            $remaining = $now->diff($endTimeStamp);
            ?>
            <p class="text-sm border border-blue-500 bg-fadeWhite py-2 px-4 rounded-lg">
                <?= $remaining->days ?>d <?= $remaining->h ?>h left</p>
        </div>
    </div>
    <div class="actionBtn">
        <a href="product?id=<?= $product['auction_id'] ?>" class="primary-btn w-full h-full block text-center">View
            Auction</a>
    </div>

</div>