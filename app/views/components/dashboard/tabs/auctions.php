<?php $noAuctions = true; ?>
<?php if (count($products) > 0) : ?>
    <div class="pb-32">
        <?php if ($_SESSION["user"]["user_role"] == "admin") : ?>
            <div class="grid grid-cols-7 place-items-center mb-4 text-gray">
                <p>Auction</p>
                <p>Date</p>
                <p>Seller</p>
                <p>Title</p>
                <p>Current Price</p>
                <p>Status</p>
                <p>Action</p>
            </div>
        <?php endif; ?>

        <?php foreach ($products as $product) : ?>
            <?php if ($filter == $product["status"] || $filter == "all" || ($filter === "live" && $product["isLive"])) : ?>

                <?php if ($_SESSION["user"]["user_role"] == "admin") : ?>
                    <?php require "../app/views/components/dashboard/cards/adminAuctionRow.php"; ?>
                <?php else: ?>
                    <?php require "../app/views/components/dashboard/cards/auction.php"; ?>
                <?php endif; ?>

                <?php $noAuctions = false; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if ($noAuctions || count($products) <= 0): ?>
    <div class="h-fit text-center">
        <p class="text-gray text-xl">No auctions to display!</p>
    </div>
<?php endif; ?>

<div class="h-dvh w-dvw backdrop-blur absolute top-0 left-0 z-10 hidden justify-center items-center manageAuctionFormContainer">
    <?php if ($_SESSION["user"]["user_role"] == "admin") : ?>
        <?php require_once "../app/views/components/dashboard/forms/adminManageAuction.php"; ?>
    <?php else: ?>
        <?php require_once "../app/views/components/dashboard/forms/userDeleteAuction.php"; ?>
    <?php endif; ?>
</div>

<script>
    let manageAuctionForm;
    let manageAuctionFormContainer;
    let manageAuctionFormCloseBtn;
    let manageAuctionFromCancelBtn;
    let auctionId;

    function manageAuction() {
        openAuctionManageForm();
        auctionId = event.currentTarget.value;
        manageAuctionForm.action += auctionId;

        if (manageAuctionForm.id !== "deleteAuctionForm") {
            document.getElementById('manage-auction-view').href = "<?=BASE_URL?>product?id=" + auctionId;
        }
    }

    function closeAuctionManageForm() {
        manageAuctionForm.reset();
        manageAuctionForm.action = manageAuctionForm.id === "deleteAuctionForm" ? "/bidgrab/public/auction/delete?id=" : "/bidgrab/public/auction-manage?id=";
        manageAuctionFormContainer.classList.remove('flex');
        manageAuctionFormContainer.classList.add('hidden');
    }

    function openAuctionManageForm() {
        manageAuctionFormContainer.classList.remove('hidden');
        manageAuctionFormContainer.classList.add('flex');
    }

    document.addEventListener("DOMContentLoaded", () => {
        manageAuctionForm = document.querySelector(".manageAuctionForm");
        manageAuctionFormContainer = document.querySelector(".manageAuctionFormContainer");
        manageAuctionFormCloseBtn = document.querySelector(".manage-auction-form-close");
        manageAuctionFromCancelBtn = document.querySelector(".manageAuctionFormClose");

        manageAuctionFormCloseBtn.addEventListener("click", closeAuctionManageForm);
        manageAuctionFromCancelBtn.addEventListener("click", closeAuctionManageForm);
    });
</script>