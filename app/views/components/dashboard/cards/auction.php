<div class="h-44 w-full p-4 border border-blue-500 rounded-xl relative flex justify-between mb-8">
    <div class="flex gap-2">
        <div class="flex gap-2 w-80">
            <div class="border border-gray rounded-lg overflow-hidden w-48 h-32">
                <?php
                if (empty($product["image"])) {
                    $imageSrc = "/bidgrab/public/images/placeholder.png";
                }
                else {
                    $imageSrc = "/bidgrab/app/server/auctionImages/".$product["image"];
                }
                ?>
                <img src="<?= $imageSrc ?>" alt="product image" class="w-full h-full object-cover">
            </div>
            <div class="pt-2">
                <p><?= $product["title"]; ?></p>
                <p class="text-gray"><?= $product["category"]; ?></p>
                <p class="text-gray text-sm"><?= $product["product_condition"]; ?></p>
            </div>
        </div>
        <div>
            <div class="grid grid-cols-4 gap-8 mb-4">
                <div>
                    <p class="text-gray">Date Added</p>
                    <p><?= date( "Y-m-d" ,strtotime($product["date_added"])); ?></p>
                </div>
                <div>
                    <p class="text-gray">Auction ID</p>
                    <p><?= $product["auction_id"]; ?></p>
                </div>
                <div>
                    <p class="text-gray">Base Price</p>
                    <p><?= $product["base_price"]; ?></p>
                </div>
                <div>
                    <p class="text-gray">Current Price</p>
                    <p><?= $product["current_price"]; ?></p>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-8">
                <div>
                    <p class="text-gray">Start</p>
                    <p><?= $product["start_date"] ?></p>
                    <p><?= $product["start_time"] ?></p>
                </div>
                <div>
                    <p class="text-gray">End</p>
                    <p><?= $product["end_date"] ?></p>
                    <p><?= $product["end_time"] ?></p>
                </div>
                <div>
                    <p class="text-gray">Total Bids</p>
                    <p>Total bids</p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <p class="rounded-2xl <?= $product["status"] == 'live' ? 'bg-red' : ($product["status"] == 'pending' ? 'bg-orange' : 'bg-green') ?> px-4 py-1.5 text-white w-fit"><?= $product["status"] ?></p>
    </div>
    <?php if ($product["status"] == "completed") : ?>
        <form action="" method="POST" class="absolute bottom-0 right-0 mb-4 mr-4">
            <div class="flex gap-2 items-center justify-end mb-1">
                <input type="text"
                       id="trackingNo"
                       placeholder="Enter tracking number"
                       class="appearance-none rounded-full border-blue border w-fit py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <button type="submit"
                        class="block bg-blue py-1.5 px-4 rounded-2xl text-white shadow-md hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md transition-all duration-300">
                    Send
                </button>
            </div>
            <label for="trackingNo">Enter tracking number to receive the payment</label>
        </form>
    <?php elseif ($product["status"] == "pending") : ?>
        <div class="flex gap-2 items-center justify-start absolute bottom-0 right-0 mb-4 mr-4">
            <button type="button" onclick="deleteAuction()" value="<?= $product["auction_id"] ?>" class="block border border-blue py-1.5 px-4 rounded-2xl text-blue shadow-md hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md transition-all duration-300">
                Delete auction</button>

            <a href="/bidgrab/public/dashboard/auction-edit?id=<?= $product['auction_id'] ?>"
               class="block border border-blue py-1.5 px-4 rounded-2xl text-blue shadow-md hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md transition-all duration-300">
                Edit auction</a>
        </div>
    <?php else: ?>
        <div class="flex gap-2 items-center justify-start absolute bottom-0 right-0 mb-4 mr-4">
            <a href="#"
               class="block border border-blue py-1.5 px-4 rounded-2xl text-blue shadow-md hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md transition-all duration-300">
                View auction</a>
        </div>
    <?php endif; ?>
</div>

