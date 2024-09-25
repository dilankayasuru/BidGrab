<div class="grid grid-cols-7 place-items-center mb-4 relative">
    <p><?= $order["order_id"] ?></p>
    <p><?= date('Y/m/d', strtotime($order["order_date"])) ?></p>
    <p><?= $order["seller"] ?></p>
    <p><?= $order["buyer"] ?></p>
    <p><?= $order["item_id"] ?></p>
    <div>
        <p class="rounded-2xl <?= $order["status"] == 'completed' ? 'bg-green' : ($order["status"] == 'pending' ? 'bg-orange' : 'bg-red') ?> px-4 py-1.5 text-white w-fit"><?= $order["status"] ?></p>
    </div>
    <button type="button" value="<?= $order['order_id'] ?>"
            onclick="openOrderManage(event,
                    {
                        orderId: '<?= $order["order_id"] ?>',
                        seller : '<?= $order["seller"] ?>',
                        buyer : '<?= $order["buyer"] ?>',
                        price : '<?= $order["price"] ?>',
                        tracking : '<?= $order["tracking_no"] ?>',
                    })"
            class="px-2 <?= $order["status"] != 'completed' ? 'cursor-pointer' : 'cursor-not-allowed text-gray' ?>">
        <i class="fa-solid fa-pen-to-square"></i>
    </button>
</div>