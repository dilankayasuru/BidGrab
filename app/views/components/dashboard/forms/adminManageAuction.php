<form id="manageAuctionForm" method="POST" action="/bidgrab/public/auction-manage?id=" class="bg-white p-8 shadow-lg rounded-xl text-center relative manageAuctionForm">
    <div class="flex gap-4 items-center justify-center">
        <button type="submit" value="reject" name="reject"
            class="py-2 px-4 rounded-lg border border-red text-red hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md transition-all duration-300">
            Reject
        </button>

        <a href="" id="manage-auction-view" target="_blank"
           class="py-2 px-4 rounded-lg border border-blue text-blue hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md transition-all duration-300">
            View
        </a>

        <button type="submit" value="approve" name="approve"
            class="py-2 px-4 rounded-lg bg-blue text-white hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md transition-all duration-300">
            Approve
        </button>
    </div>
    <i class="fa-solid fa-xmark cursor-pointer absolute right-0 top-0 m-4 text-xl manage-auction-form-close"></i>
</form>
