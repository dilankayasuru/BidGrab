<section class="product-carousel m-auto mt-8 mb-16 max-w-7xl w-full relative">
    <h1 class="text-2xl font-medium mb-2">Recently Added Auctions</h1>
    <div class="carousel-btn prev-btn active:translate-y-1 active:shadow-sm transition-all duration-300 w-11 h-11 absolute top-1/2 left-0 bg-fadeWhite text-2xl cursor-pointer rounded-full shadow-md z-10 flex justify-center items-center">
        <i class="fa-solid fa-angle-left"></i>
    </div>
    <div class="product-carousel-container w-full overflow-hidden m-auto">
        <div class="carousel transition-all duration-300 ml-4 grid grid-flow-col auto-cols-[calc(100%_/_4_-_16px)] gap-4 py-4 sm:auto-cols-[calc(100%_/_1_-_16px)] lg:auto-cols-[calc(100%_/_3_-_16px)] md:auto-cols-[calc(100%_/_2_-_16px)]">
            <?php for ($i = 0; $i < 25; $i++) : ?>
                <?php require "productCard.php"; ?>
            <?php endfor; ?>
        </div>
    </div>
    <div class="carousel-btn next-btn active:translate-y-1 active:shadow-sm transition-all duration-300 w-11 h-11 absolute top-1/2 right-0 bg-fadeWhite text-2xl cursor-pointer rounded-full shadow-md z-10 flex justify-center items-center">
        <i class="fa-solid fa-angle-right"></i>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        initCarousel(".product-carousel-container", ".carousel", ".product-card", ".carousel-btn");
    })
</script>
