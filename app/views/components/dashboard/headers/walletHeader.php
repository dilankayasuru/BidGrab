<div class="flex justify-between mb-4">
    <div>
        <h1 class="text-2xl font-medium">Wallet</h1>
        <p class="text-gray">Inventory details</p>
    </div>
    <?php require_once "../app/views/components/dashboard/signOut.php"; ?>
</div>
<?php require_once "../app/views/components/dashboard/displayCards.php"; ?>
<div class="flex justify-start items-center gap-4 mb-4">
    <?= displayCard("Balance", $wallet["balance"], 'fa-solid fa-sack-dollar'); ?>
    <?= displayCard("Received", 150, 'fa-solid fa-hand-holding-dollar'); ?>
    <?= displayCard("Spend", 150, 'fa-solid fa-money-bill-transfer'); ?>
    <?= displayCard("On hold", 150, 'fa-solid fa-coins'); ?>
</div>
<div class="flex justify-between items-center mb-4">
    <div class="flex gap-2">
        <a href="?filter=all"
           class="dashboard-filter-button <?= $filter == 'all' ? 'bg-blue text-white' : 'bg-fadeWhite text-gray' ?>">
            All Transactions</a>
        <a href="?filter=incoming"
           class="dashboard-filter-button <?= $filter == 'incoming' ? 'bg-blue text-white' : 'bg-fadeWhite text-gray' ?>">
            Incoming</a>
        <a href="?filter=outgoing"
           class="dashboard-filter-button <?= $filter == 'outgoing' ? 'bg-blue text-white' : 'bg-fadeWhite text-gray' ?>">
            Outgoing</a>
    </div>
    <div class="flex gap-2 items-center">
        <a href="#prev"
           class="shadow-md w-9 h-9 flex justify-center items-center rounded-full hover:shadow-lg active:shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
            <i class="fa-solid fa-chevron-left text-xl"></i>
        </a>
        <div>
            <p>1 -3 of 3</p>
        </div>
        <a href="#next"
           class="shadow-md w-9 h-9 flex justify-center items-center rounded-full hover:shadow-lg active:shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
            <i class="fa-solid fa-chevron-right text-xl"></i>
        </a>
    </div>
</div>


<div class="z-10 absolute bottom-0 mb-8 mr-8 right-0">
    <button type="button" id="deposit-btn" onclick="openDeposit()"
            class="text-white px-4 py-2 bg-blue rounded-md shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 active:shadow-lg transition-all duration-300">
        <span class="pl-2">Deposit</span>
        <i class="fa-solid fa-turn-up text-xl"></i>
    </button>
    <button type="button" id="withdraw-btn" onclick="openWithdraw()"
       class="text-white px-4 py-2 bg-blue rounded-md shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 active:shadow-lg transition-all duration-300">
        <span class="pl-2">Withdraw</span>
        <i class="fa-solid fa-turn-down text-xl"></i>
    </button>
</div>

<script>
    function openDeposit() {
        const form = document.getElementById("depositForm");
        form.classList.remove("hidden");
    }
    function openWithdraw() {
        const form = document.getElementById("withdrawForm");
        form.classList.remove("hidden");
    }
</script>
