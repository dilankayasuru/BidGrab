<div class="flex justify-between mb-4">
    <div>
        <h1 class="text-2xl font-medium">Wallet</h1>
        <p class="text-gray">Inventory details</p>
    </div>
    <?php require_once "../app/views/components/dashboard/signOut.php"; ?>
</div>
<?php require_once "../app/views/components/dashboard/displayCards.php"; ?>
<div class="flex justify-start items-center gap-4 mb-4">
    <?= displayCard("Balance", $data["balance"]["balance"] ?? 0, 'fa-solid fa-sack-dollar'); ?>
    <?= displayCard("Received", $data["received"]["received"] ?? 0, 'fa-solid fa-hand-holding-dollar'); ?>
    <?= displayCard("Spend", $data["spent"]["spent"] ?? 0, 'fa-solid fa-money-bill-transfer'); ?>
    <?= displayCard("On hold", $data["onHold"]["onHold"] ?? 0, 'fa-solid fa-coins'); ?>
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
