<?php require "../app/views/components/mobileHeader.php"; ?>
<div class="mt-8 ps-[8vw] pe-[8vw] flex gap-12 lg:ps-[2vw] lg:pe-[2vw] lg:gap-8 lg:block md:pt-2">
    <?php require "../app/views/components/productImages.php"; ?>
    <?php require "../app/views/components/productInfo.php"; ?>
</div>
<?php if (count($recentItems) > 0 ) : ?>
<div class="ps-[8vw] pe-[8vw] lg:pe-[2ve] lg:ps-[2vw]">
    <?php $carouselTitle = "Recently Added Auctions" ?>
    <?php require "../app/views/components/productCarousel.php"; ?>
</div>
<?php endif; ?>
<?php if ($product["status"] === "pending") : ?>
    <div class="fixed animate-pulse top-0 right-0 z-50 mt-24 mr-11">
        <div class="w-24 h-24 rounded-full bg-orange flex justify-center items-center shadow-xl">
            <p class="text-center text-white font-bold">Pending Auction</p>
        </div>
    </div>
<?php endif; ?>
