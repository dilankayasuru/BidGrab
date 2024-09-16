<?php $noAuctions = true; ?>
<?php if (count($products) > 0) : ?>
    <div class="pb-44">
        <?php foreach ($products as $product) : ?>
            <?php if ($filter == $product["status"] || $filter == "all") : ?>
                <?php require "../app/views/components/dashboard/cards/auction.php"; ?>
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

<div class="h-dvh w-dvw backdrop-blur absolute top-0 left-0 z-10 hidden justify-center items-center"
     id="deleteAuctionFormContainer">
    <form id="deleteAuctionForm" method="POST" action="/bidgrab/public/auction/delete?id="
          class="bg-white p-8 shadow-lg rounded-xl text-center relative">
        <div class="mb-8">
            <i class="fa-regular fa-circle-xmark text-red text-5xl"></i>
        </div>
        <div class="mb-8">
            <p class="text-gray text-xl">Are you sure you want to delete this auction!</p>
        </div>
        <div class="flex gap-4 items-center justify-center">
            <button
                    type="button"
                    id="deleteAuctionFormClose"
                    class="py-2 px-4 rounded-lg bg-gray text-white">
                Cancel
            </button>
            <button
                    type="submit"
                    class="py-2 px-4 rounded-lg bg-red text-white">
                Delete
            </button>
        </div>
        <i class="fa-solid fa-xmark cursor-pointer absolute right-0 top-0 m-4 text-xl"
           id="delete-auction-form-close"></i>
    </form>
</div>

<script>
    let deleteAuctionForm;
    let deleteAuctionFormContainer;
    let deleteAuctionFormCloseBtn;
    let deleteAuctionFromCancelBtn;

    function deleteAuction() {
        openAuctionDeleteForm();
        let auctionId = event.target.value;
        deleteAuctionForm.action += auctionId;
    }

    function closeAuctionDeleteForm() {
        deleteAuctionForm.reset();
        deleteAuctionForm.action = "/bidgrab/public/auction/delete?id=";
        deleteAuctionFormContainer.classList.remove('flex');
        deleteAuctionFormContainer.classList.add('hidden');
    }

    function openAuctionDeleteForm() {
        deleteAuctionFormContainer.classList.remove('hidden');
        deleteAuctionFormContainer.classList.add('flex');
    }

    document.addEventListener("DOMContentLoaded", () => {
        deleteAuctionForm = document.getElementById("deleteAuctionForm");
        deleteAuctionFormContainer = document.getElementById("deleteAuctionFormContainer");
        deleteAuctionFormCloseBtn = document.getElementById("delete-auction-form-close");
        deleteAuctionFromCancelBtn = document.getElementById("deleteAuctionFormClose");

        deleteAuctionFormCloseBtn.addEventListener("click", closeAuctionDeleteForm);
        deleteAuctionFromCancelBtn.addEventListener("click", closeAuctionDeleteForm);
    });
</script>