<div class="grid grid-cols-7 place-items-center mb-4 relative">
    <p><?= $product["auction_id"] ?></p>
    <p><?= $product["date_added"] ?></p>
    <p><?= $product["seller"] ?></p>
    <p><?= $product["title"] ?></p>
    <p class="justify-self-end">Rs. <?= $product["current_price"] ?></p>
    <div>
        <p class="rounded-2xl <?= $product["status"] == 'approved' ? 'bg-green' : ($product["status"] == 'pending' ? 'bg-orange' : 'bg-red') ?> px-4 py-1.5 text-white w-fit"><?= $product["status"] ?></p>
    </div>
    <div>
        <a href="<?= BASE_URL ?>product?id=<?= $product['auction_id'] ?>" class="px-2" target="_blank">
            <i class="fa-solid fa-eye"></i>
        </a>
        <button type="button" value="<?= $product['auction_id'] ?>" onclick="manageAuction(event)" class="px-2">
            <i class="fa-solid fa-pen-to-square"></i>
        </button>
    </div>
    <?php if ($product["isLive"] && $product["status"] == "approved" && !$product["isExpired"]) : ?>
        <p class="absolute flex gap-2 justify-center items-center left-0 ml-2">
            <span class="block w-2 h-2 rounded-full bg-red animate-ping"></span>
            <span class="text-red font-bold text-sm">Live</span>
        </p>
    <?php endif; ?>
    <?php if ($product["isExpired"]) : ?>
        <p class="absolute left-0 ml-2 text-gray font-bold text-sm">
            Expired!
        </p>
    <?php endif; ?>
</div>