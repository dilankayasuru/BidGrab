<section class="product-carousel m-auto my-8 max-w-7xl w-full relative">
    <h1 class="text-2xl font-medium mb-2">Recently Added Auctions</h1>
    <div id="prevBtn" class="active:translate-y-1 active:shadow-sm transition-all duration-300 w-11 h-11 absolute top-1/2 -left-8 bg-fadeWhite text-2xl cursor-pointer rounded-full shadow-md z-10 flex justify-center items-center">
        <i class="fa-solid fa-angle-left carousel-btn"></i>
    </div>
    <div class="product-carousel-container w-full overflow-hidden m-auto">
        <div class="carousel transition-all duration-300 grid grid-flow-col auto-cols-[calc(100%_/_4_-_16px)] gap-4 py-4">
            <?php for ($i = 0; $i < 16; $i++) : ?>
                <?php require "productCard.php"; ?>
            <?php endfor; ?>
        </div>
    </div>
    <div id="nextBtn" class="active:translate-y-1 active:shadow-sm transition-all duration-300 w-11 h-11 absolute top-1/2 -right-8 bg-fadeWhite text-2xl cursor-pointer rounded-full shadow-md z-10 flex justify-center items-center">
        <i class="fa-solid fa-angle-right carousel-btn"></i>
    </div>
</section>

<script>
    const carousel = document.querySelector('.carousel');
    const productCards = document.querySelectorAll('.product-card');
    const carouselBtn = document.querySelectorAll(".carousel-btn");
    let pointer = 0;
    let offset = productCards[0].offsetWidth + 16;
    let transformX = 0;

    carouselBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            if (btn.classList.contains('fa-angle-right') && pointer < productCards.length - 4) {
                pointer++;
                transformX = -(pointer * offset);
                carousel.style.transform = `translateX(${transformX}px)`;
            } else if (btn.classList.contains('fa-angle-left') && pointer > 0) {
                pointer--;
                transformX = -(pointer * offset);
                carousel.style.transform = `translateX(${transformX}px)`;
            } else if (pointer === 0) {
                carousel.style.transform = "translateX(0)";
            }
        })
    })

</script>
