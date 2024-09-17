<?php require_once "../app/views/components/dashboard/displayCards.php"; ?>
<div class="flex justify-start items-center gap-4 mb-4">
    <?php if ($_SESSION["user"]["user_role"] == "admin") : ?>
        <?= displayCard("Total Users", 150, 'fa-solid fa-users'); ?>
    <?php endif; ?>
    <?php if ($_SESSION["user"]["user_role"] == "user") : ?>
        <?= displayCard("Orders", 150, 'fa-solid fa-truck-fast'); ?>
    <?php endif; ?>
    <?= displayCard("Total Auctions", 150, 'fa-solid fa-boxes-packing'); ?>
    <?= displayCard("Sold Items", 150, 'fa-solid fa-cart-flatbed'); ?>
    <?= displayCard("Total Revenue", 150, 'fa-solid fa-chart-column'); ?>
</div>

<div class="flex gap-4 mb-4">
    <?php
    $tableTitle = "Recently won auctions";

    $tableData["headings"] = ["Item", "Seller", "Status", "Price"];
    $tableData["columns"] = [
        ["IPhone 15 pro...", "Dilanka", "Pending", "Rs. 45000"],
        ["IPhone 15 pro...", "Dilanka", "Pending", "Rs. 45000"],
        ["IPhone 15 pro...", "Dilanka", "Pending", "Rs. 45000"],
        ["IPhone 15 pro...", "Dilanka", "Pending", "Rs. 45000"],
        ["IPhone 15 pro...", "Dilanka", "Pending", "Rs. 45000"],
    ];
    require "../app/views/components/dashboard/dataGrid.php";
    ?>

    <?php if ($_SESSION["user"]["user_role"] == "admin") : ?>
        <?php
        $tableTitle = "Recently won auctions";

        $tableData["headings"] = ["Item", "Seller", "Status", "Price"];
        $tableData["columns"] = [
            ["IPhone 15 pro...", "Yasuru", "Pending", "Rs. 45000"],
            ["IPhone 15 pro...", "Dilanka", "Pending", "Rs. 45000"],
            ["IPhone 15 pro...", "Dilanka", "Pending", "Rs. 45000"],
            ["IPhone 15 pro...", "Dilanka", "Pending", "Rs. 45000"],
            ["IPhone 15 pro...", "Dilanka", "Pending", "Rs. 45000"],
        ];
        require "../app/views/components/dashboard/dataGrid.php";
        ?>
    <?php else: ?>
        <?php require_once "../app/views/components/dashboard/cards/profileCard.php"; ?>
    <?php endif; ?>

</div>
<?php require_once "../app/views/components/dashboard/cards/monthlySale.php"; ?>
