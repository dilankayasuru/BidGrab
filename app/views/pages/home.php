<?php require_once "../app/views/components/hero.php"; ?>
<div class="ps-[8vw] pe-[8vw]">
    <?php require_once "../app/views/components/categories.php"; ?>
    <?php $carouselTitle = "Recently Added Auctions" ?>
    <?php if ($recentItems) : ?>
        <?php require_once "../app/views/components/productCarousel.php"; ?>
    <?php endif; ?>
    <?php require_once "../app/views/components/promotion.php"; ?>
</div>