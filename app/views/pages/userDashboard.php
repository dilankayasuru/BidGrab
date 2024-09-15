<?php require_once "../app/views/components/dashboardMenuItem.php"; ?>
<div class="bg-blue min-h-dvh p-4 flex justify-between">
    <div class="px-4 py-2 relative">
        <div class="pb-6 border-b border-fadeWhite">
            <a href="/bidgrab/public/" class="font-extrabold text-2xl text-white">BidGrab</a>
        </div>
        <div class="py-4">
            <div class="grid gap-4">
                <?= dashboardMenuItem("Dashboard", "fa-solid fa-house", "home") ?>
                <?= dashboardMenuItem("Orders", "fa-solid fa-cart-flatbed", "orders") ?>
                <?= dashboardMenuItem("Auctions", "fa-solid fa-boxes-packing", "auctions") ?>
                <?= dashboardMenuItem("Profile", "fa-solid fa-user", "profile") ?>
                <?= dashboardMenuItem("Wallet", "fa-solid fa-wallet", "wallet") ?>
            </div>
        </div>
        <div class="justify-items-end absolute bottom-0 mb-8">
            <?php require_once "../app/views/components/dashboardUserPic.php"; ?>
        </div>
    </div>
    <div class="w-full bg-white rounded-xl px-4 py-4 h-[calc(100vh_-_32px)] overflow-hidden">
        <?php require_once "../app/views/components/dashboard/headers/" . $tab . "Header.php" ?>
        <div class="overflow-y-auto h-[calc(100%_-_16px)] pb-10">
            <?php require_once "../app/views/components/dashboard/tabs/$tab.php" ?>
        </div>
    </div>
</div>