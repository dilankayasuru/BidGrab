<form id="deleteAuctionForm" method="POST" action="/bidgrab/public/auction/delete?id="
      class="bg-white p-8 shadow-lg rounded-xl text-center relative manageAuctionForm">
    <div class="mb-8">
        <i class="fa-regular fa-circle-xmark text-red text-5xl"></i>
    </div>
    <div class="mb-8">
        <p class="text-gray text-xl">Are you sure you want to delete this auction!</p>
    </div>
    <div class="flex gap-4 items-center justify-center">
        <button
            type="button"
            class="py-2 px-4 rounded-lg bg-gray text-white manageAuctionFormClose">
            Cancel
        </button>
        <button
            type="submit"
            class="py-2 px-4 rounded-lg bg-red text-white">
            Delete
        </button>
    </div>
    <i class="fa-solid fa-xmark cursor-pointer absolute right-0 top-0 m-4 text-xl manage-auction-form-close"></i>
</form>
