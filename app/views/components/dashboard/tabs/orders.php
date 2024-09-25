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


<?php if ($_SESSION["user"]["user_role"] == "admin") : ?>
    <div class="h-dvh w-dvw backdrop-blur bg-black bg-opacity-25 absolute top-0 left-0 z-10 justify-center hidden items-center manageOrderContainer">
        <div>
            <form method="POST" action="/bidgrab/public/order/manage" id="manageOrderForm"
                  class="bg-white p-8 shadow-lg rounded-xl text-center relative">
                <div class="mb-8">
                    <i class="fa-solid fa-circle-check text-green text-5xl"></i>
                </div>
                <div class="mb-4">
                    <p class="text-gray text-xl">Check order tracking number!</p>
                </div>
                <div class="mb-4 w-full">
                    <div class="flex justify-between items-center">
                        <p>Seller: </p>
                        <p id="orderManageSeller"></p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p>Buyer: </p>
                        <p id="orderManageBuyer"></p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p>Price: </p>
                        <p id="orderManagePrice"></p>
                    </div>
                    <div class="flex justify-between items-center">
                        <p>Tracking no: </p>
                        <p id="orderManageTracking"></p>
                    </div>
                </div>
                <input name="orderId" type="text" id="order_manage_id" class="hidden invisible">
                <div class="flex gap-4 items-center justify-center">
                    <button
                            onclick="closeOrderManage()"
                            type="submit"
                            name="approve"
                            class="py-2 px-4 rounded-lg bg-green text-white manageAuctionFormClose">
                        Approve
                    </button>
                    <button
                            onclick="closeOrderManage()"
                            type="submit"
                            name="reject"
                            class="py-2 px-4 rounded-lg bg-red text-white">
                        Reject
                    </button>
                </div>
                <i class="fa-solid fa-xmark cursor-pointer absolute right-0 top-0 m-4 text-xl" onclick="closeOrderManage()"></i>
            </form>
        </div>
    </div>
<?php endif; ?>