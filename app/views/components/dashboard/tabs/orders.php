<?php if (count($orders) > 0) : ?>
    <div class="pb-32">
        <?php if ($_SESSION["user"]["user_role"] == "admin") : ?>
            <div class="grid grid-cols-7 place-items-center mb-4 text-gray">
                <p>Order ID</p>
                <p>Date</p>
                <p>Seller</p>
                <p>Buyer</p>
                <p>Item ID</p>
                <p>Status</p>
                <p>Action</p>
            </div>
        <?php endif; ?>

        <?php foreach ($orders as $order) : ?>
            <?php if ($filter === $order["status"] || $filter == "all"): ?>
                <?php if ($_SESSION["user"]["user_role"] == "admin") : ?>
                    <?php require "../app/views/components/dashboard/cards/adminOrderRow.php"; ?>
                <?php else: ?>
                    <?php require "../app/views/components/dashboard/cards/orderCard.php"; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (count($orders) <= 0): ?>
    <div class="h-fit text-center">
        <p class="text-gray text-xl">No orders to display!</p>
    </div>
<?php endif; ?>