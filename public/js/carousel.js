function initCarousel(wrapperClass, carouselClass, imageBoxesClass, carouselBtnClass) {

    // Select the carousel container element
    const wrapper = document.querySelector(wrapperClass);
    // Select the carousel element
    const carousel = document.querySelector(carouselClass);
    // Select all product card elements
    const imageBoxes = document.querySelectorAll(imageBoxesClass);
    // Select all carousel button elements
    const carouselBtn = document.querySelectorAll(carouselBtnClass);

    // Initialize the pointer to track the current position
    let pointer = 0;

    // Calculate the offset width of each product card including the gap
    let gap = wrapperClass === ".product-carousel-container" ? 16 : 8;
    let offset = imageBoxes[0].offsetWidth + gap;

    // Initialize the transformX value to control the translation
    let transformX = 0;
    // Calculate the number of cards that fit in the visible area
    let cardsPerDiv = Math.round(wrapper.offsetWidth / offset);

    // Add click event listeners to each carousel button
    carouselBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            // If the next button is clicked and there are more cards to show
            if (btn.classList.contains('next-btn') && pointer < imageBoxes.length - cardsPerDiv) {
                pointer++; // Move the pointer to the next card
                transformX = -(pointer * offset); // Update the transformX value
                carousel.style.transform = `translateX(${transformX}px)`; // Apply the translation
                // If the previous button is clicked and the pointer is not at the start
            } else if (btn.classList.contains('prev-btn') && pointer > 0) {
                pointer--; // Move the pointer to the previous card
                transformX = -(pointer * offset); // Update the transformX value
                carousel.style.transform = `translateX(${transformX}px)`; // Apply the translation
                // If the pointer is at the start or end, reset the carousel
            } else if (pointer === 0 || pointer >= imageBoxes.length - cardsPerDiv) {
                carousel.style.transform = "translateX(0)"; // Reset the translation
                pointer = 0; // Reset the pointer
            }
        })
    })
}