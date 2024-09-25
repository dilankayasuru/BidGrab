<div class="md:pt-8 products-hero w-full bg-blue flex flex-col items-center justify-center gap-8 text-center px-4 pt-16 pb-4 shadow-blue-500 shadow-lg">
    <div class="text">
        <p class="hero-title">BidGrab</p>
        <p class="hero-text-sm">Bid, Win, and Save Big on Unique Items!</p>
    </div>
    <?php require "../app/views/components/search.php"; ?>
</div>
<div class="products-wrapper py-12 max-w-7xl m-auto ps-[4vw] pe-[4vw]">
    <div class="top-header flex justify-between">
        <p class="text-2xl font-medium">All Categories</p>
    </div>
    <div class="grid grid-cols-4 gap-8 pt-8 xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
        <?php foreach ($categories as $category) : ?>
            <?php require "../app/views/components/categoryBox.php"; ?>
        <?php endforeach; ?>
    </div>
</div>
