<div class="product-card rounded-xl border border-blue-500 shadow-md p-2 h-full w-full bg-white relative grid">
    <?php if ($product["isLive"]) : ?>
        <span class="bg-white absolute top-0 left-0 px-2 py-1 mt-4 ml-4 shadow-lg rounded-md text-sm text-red font-bold flex justify-center items-center gap-2">
            <span class="block w-2 h-2 rounded-full bg-red animate-ping"></span>
            Live
        </span>
    <?php endif; ?>
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
            <p class="text-sm border border-blue-500 bg-fadeWhite py-2 px-4 rounded-lg">
                Rs. <?= $product["current_price"] ?></p>
        </div>
        <div class="biddin-info-right">
            <p>Ending in</p>
            <?php
            // Split the time difference into hours, minutes, and seconds
            list($hours, $minutes, $seconds) = explode(':', $product["timeDifference"]);

            // Convert hours, minutes, and seconds to total seconds
            $totalSeconds = ($hours * 3600) + ($minutes * 60) + (int)$seconds;

            // Calculate days, hours, minutes, and seconds
            $days = floor($totalSeconds / 86400);
            $hours = floor(($totalSeconds % 86400) / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $seconds = $totalSeconds % 60;

            ?>
            <p class="text-sm border border-blue-500 bg-fadeWhite py-2 px-4 rounded-lg">
                <?= $days > 0 ? $days.'d ' : '' ?>
                <?= $hours > 0 ? $hours.'h ' : '' ?>
                <?= $minutes > 0 ? $minutes.'m ' : '' ?>
                <?= $seconds > 0 ? $seconds.'s ' : '' ?>
            </p>
        </div>
    </div>
    <div class="actionBtn justify-self-end w-full h-fit">
        <a href="product?id=<?= $product['auction_id'] ?>" class="primary-btn w-full h-full block text-center">View
            Auction</a>
    </div>
</div>