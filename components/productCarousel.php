<section class="product-carousel m-auto my-8 max-w-7xl w-full relative">
    <h1 class="text-2xl font-medium mb-2">Recently Added Auctions</h1>
    <div class="carousel-btn prev-btn active:translate-y-1 active:shadow-sm transition-all duration-300 w-11 h-11 absolute top-1/2 -left-8 bg-fadeWhite text-2xl cursor-pointer rounded-full shadow-md z-10 flex justify-center items-center">
        <i class="fa-solid fa-angle-left"></i>
    </div>
    <div class="product-carousel-container w-full overflow-hidden m-auto">
        <div class="carousel transition-all duration-300 grid grid-flow-col auto-cols-[calc(100%_/_4_-_16px)] gap-4 py-4">
            <?php for ($i = 0; $i < 25; $i++) : ?>
                <?php require "productCard.php"; ?>
            <?php endfor; ?>
        </div>
    </div>
    <div class="carousel-btn next-btn active:translate-y-1 active:shadow-sm transition-all duration-300 w-11 h-11 absolute top-1/2 -right-8 bg-fadeWhite text-2xl cursor-pointer rounded-full shadow-md z-10 flex justify-center items-center">
        <i class="fa-solid fa-angle-right"></i>
    </div>
</section>

<script>
    // Select the carousel container element
    const wrapper = document.querySelector(".product-carousel-container");
    // Select the carousel element
    const carousel = document.querySelector('.carousel');
    // Select all product card elements
    const productCards = document.querySelectorAll('.product-card');
    // Select all carousel button elements
    const carouselBtn = document.querySelectorAll(".carousel-btn");

    // Initialize the pointer to track the current position
    let pointer = 0;
    // Calculate the offset width of each product card including the gap
    let offset = productCards[0].offsetWidth + 16;
    // Initialize the transformX value to control the translation
    let transformX = 0;
    // Calculate the number of cards that fit in the visible area
    let cardsPerDiv = Math.round(wrapper.offsetWidth / offset);

    // Add click event listeners to each carousel button
    carouselBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            // If the next button is clicked and there are more cards to show
            if (btn.classList.contains('next-btn') && pointer < productCards.length - cardsPerDiv) {
                pointer++; // Move the pointer to the next card
                transformX = -(pointer * offset); // Update the transformX value
                carousel.style.transform = `translateX(${transformX}px)`; // Apply the translation
            // If the previous button is clicked and the pointer is not at the start
            } else if (btn.classList.contains('prev-btn') && pointer > 0) {
                pointer--; // Move the pointer to the previous card
                transformX = -(pointer * offset); // Update the transformX value
                carousel.style.transform = `translateX(${transformX}px)`; // Apply the translation
            // If the pointer is at the start or end, reset the carousel
            } else if (pointer === 0 || pointer >= productCards.length - cardsPerDiv) {
                carousel.style.transform = "translateX(0)"; // Reset the translation
                pointer = 0; // Reset the pointer
            }
        })
    })
</script>
