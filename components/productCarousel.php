<section class="product-carousel m-auto my-8 max-w-7xl w-full overflow-hidden">
    <h1 class="text-2xl font-medium mb-2">Recently Added Auctions</h1>
    <div class="product-carousel-container flex gap-4 py-8 w-fit m-auto my-0">
        <?php for ($i = 0; $i < 4; $i++) : ?>   
            <?php require "productCard.php"; ?>
        <?php endfor; ?>
    </div>
</section>