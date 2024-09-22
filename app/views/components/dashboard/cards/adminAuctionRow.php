<div class="grid grid-cols-7 place-items-center mb-4">
    <p><?= $product["auction_id"] ?></p>
    <p><?= $product["date_added"] ?></p>
    <p><?= $product["seller"] ?></p>
    <p><?= $product["title"] ?></p>
    <p class="justify-self-end">Rs. <?= $product["current_price"] ?></p>
    <div>
        <p class="rounded-2xl <?= $product["status"] == 'live' ? 'bg-red' : ($product["status"] == 'pending' ? 'bg-orange' : ($product['status'] == 'completed' ? 'bg-green' : 'bg-gray')) ?> px-4 py-1.5 text-white w-fit"><?= $product["status"] ?></p>
    </div>
    <div>
        <a href="<?= BASE_URL ?>product?id=<?= $product['auction_id'] ?>" class="px-2" target="_blank">
            <i class="fa-solid fa-eye"></i>
        </a>
        <button type="button" value="<?= $product['auction_id'] ?>" onclick="manageAuction(event)" class="px-2">
            <i class="fa-solid fa-pen-to-square"></i>
        </button>
    </div>
</div>