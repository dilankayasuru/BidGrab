<section class="w-full">
    <div class="max-w-2xl m-auto my-0">
        <div class="h-96 overflow-hidden shadow-md rounded-lg object-cover">
            <img id="main-image" src="../public/images/iphone.jpeg" alt="iphone main image"
                 class="w-full h-full object-cover">
        </div>
        <div class="relative">
            <div class="product-carousel-btn prev-btn -translate-y-1/2 active:-translate-y-1/3 active:shadow-sm transition-all duration-300 w-11 h-11 absolute top-1/2 left-0 bg-fadeWhite text-2xl cursor-pointer rounded-full shadow-md z-10 flex justify-center items-center">
                <i class="fa-solid fa-angle-left"></i>
            </div>

            <div class="image-wrapper w-full overflow-hidden m-auto">
                <div class="image-carousel transition-all duration-300 ml-2 grid grid-flow-col auto-cols-[calc(100%_/_3_-_8px)] gap-2">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                        <div class="image-box cursor-pointer hover:opacity-70 transition-all duration-300 w-full max-h-48 shadow-md rounded-xl overflow-hidden my-4">
                            <img src="../public/images/shoe.jpg" alt="iphone image"
                                 class="w-full h-full object-cover">
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="product-carousel-btn next-btn -translate-y-1/2 active:-translate-y-1/3 active:shadow-sm transition-all duration-300 w-11 h-11 absolute top-1/2 right-0 bg-fadeWhite text-2xl cursor-pointer rounded-full shadow-md z-10 flex justify-center items-center">
                <i class="fa-solid fa-angle-right"></i>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        initCarousel(".image-wrapper", '.image-carousel', '.image-box', ".product-carousel-btn");

        // Reference to the main image
        const mainImage = document.getElementById("main-image");

        const imageBoxes = document.querySelectorAll('.image-box');

        //  Add hover event listeners to handle main image change
        imageBoxes.forEach(box => {
            box.addEventListener('mouseover', (e) => {
                mainImage.src = e.target.src;
            })
        })
    })
</script>

