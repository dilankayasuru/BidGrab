<div class="w-full p-4 border border-blue-500 rounded-xl mb-8">
    <div class="flex justify-between items-center w-full mb-4">
        <div>
            <p>Order Date</p>
            <p><?= date('Y/m/d', strtotime($order["order_date"])) ?></p>
        </div>
        <div>
            <p>Order ID</p>
            <p><?= $order["order_id"] ?></p>
        </div>
        <div>
            <p>Seller</p>
            <p><?= $order["seller"] ?></p>
        </div>
        <div>
            <p>Price</p>
            <p>Rs. <?= $order["price"] ?></p>
        </div>
        <div>
            <p class="rounded-2xl
            <?= $order["status"] == 'completed' ? 'bg-green' : ($order["status"] == 'pending' ? 'bg-orange' : 'bg-red') ?> px-4 py-1.5 text-white w-fit">
                <?= ucfirst($order["status"]) ?>
            </p>
        </div>

    </div>
    <div class="flex justify-between items-end gap-4">
        <div class="flex items-start gap-2">
            <div class="border border-gray rounded-lg overflow-hidden w-48 h-32">
                <?php
                if (empty($order["image"])) {
                    $imageSrc = "/bidgrab/public/images/placeholder.png";
                } else {
                    $imageSrc = "/bidgrab/app/server/auctionImages/" . $order["image"];
                }
                ?>
                <img src="<?= $imageSrc ?>" alt="product image" class="w-full h-full object-cover">
            </div>
            <div>
                <div class="pt-2">
                    <p><?= $order["title"]; ?></p>
                    <p class="text-gray"><?= $order["category"]; ?></p>
                </div>
                <div class="pt-2">
                    <p>Auction ID</p>
                    <p class="text-gray"><?= $order["item_id"]; ?></p>
                </div>
            </div>
        </div>
        <div>
            <?php if ($order["status"] == "completed") : ?>
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <p>Order completed on 27/04/2024</p>
                        <p>Tracking number: #<?= $order["tracking_no"] ?></p>
                    </div>
                    <button type="button"
                            id="orderReview"
                            class="rounded-full border-blue border w-fit py-1.5 px-4 text-blue shadow-md hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md transition-all duration-300">
                        Leave a feedback for seller
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>