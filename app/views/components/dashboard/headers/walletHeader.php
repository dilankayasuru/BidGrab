<div class="flex justify-between mb-4">
    <div>
        <h1 class="text-2xl font-medium">Wallet</h1>
        <p class="text-gray">Inventory details</p>
    </div>
    <?php require_once "../app/views/components/dashboard/signOut.php"; ?>
</div>
<?php require_once "../app/views/components/dashboard/displayCards.php"; ?>
<div class="flex justify-start items-center gap-4 mb-4">
    <?= displayCard("Balance", 150, 'fa-solid fa-sack-dollar'); ?>
    <?= displayCard("Received", 150, 'fa-solid fa-hand-holding-dollar'); ?>
    <?= displayCard("Spend", 150, 'fa-solid fa-money-bill-transfer'); ?>
    <?= displayCard("On hold", 150, 'fa-solid fa-coins'); ?>
</div>
<div class="flex justify-between items-center mb-4">
    <div class="flex gap-2">
        <a href="#dashboard/auctions?tab=auctions&filter=all"
           class="dashboard-filter-button <?= $_GET["tab"] == "auctions" ? 'bg-blue text-white' : 'bg-fadeWhite text-gray' ?>">
            All transactions</a>
        <a href="#live"
           class="dashboard-filter-button <?= $_GET["tab"] == "live" ? 'bg-blue text-white' : 'bg-fadeWhite text-gray' ?>">
            Incoming</a>
        <a href="#pending"
           class="dashboard-filter-button <?= $_GET["tab"] == "pending" ? 'bg-blue text-white' : 'bg-fadeWhite text-gray' ?>">
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