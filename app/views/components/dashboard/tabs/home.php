<?php require_once "../app/views/components/dashboard/displayCards.php"; ?>
<div class="flex justify-start items-center gap-4 mb-4">
    <?= displayCard("Total Users", 150, 'fa-solid fa-users'); ?>
    <?= displayCard("Total Auctions", 150, 'fa-solid fa-boxes-packing'); ?>
    <?= displayCard("Sold Items", 150, 'fa-solid fa-cart-flatbed'); ?>
    <?= displayCard("Total Revenue", 150, 'fa-solid fa-chart-column'); ?>
</div>

<?php require_once "../app/views/components/dashboard/dataGrid.php"; ?>
<div class="flex gap-4">
    <?= dataGrid("Sample Table 1") ?>
    <?= dataGrid("Sample Table 2") ?>
</div>
