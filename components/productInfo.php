<section class="w-full lg:mb-16">
    <div class="border-b border-gray grid grid-flow-row gap-4 pb-4 mb-4 lg:mb-8">
        <div>
            <p class="text-2xl font-bold">Vintage 1985 Air Jordan 1 - Red</p>
            <p class="text-gray">Shoes</p>
        </div>
        <div>
            <p class="text-gray">Current Bid: <span class="text-2xl text-black font-bold">Rs. 10900.00</span></p>
        </div>
        <div class="flex gap-4">
            <div class="border border-blue-500 px-4 py-1 rounded-lg">
                <p class="text-gray">50 Bids</p>
            </div>
            <div class="border border-blue-500 px-4 py-1 rounded-lg">
                <p class="text-gray">Ends in: 17/10/2024</p>
            </div>
        </div>
        <div class="flex items-center justify-center gap-6 w-full">
            <div class="minus-btn bg-white w-11 h-11 grid items-center justify-center rounded-lg shadow-md border border-blue-500 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md duration-300 transition-all cursor-pointer">
                <i class="fa-solid fa-minus"></i>
            </div>
            <div>
                <label for="bidAmount" class="sr-only">Bid Amount</label>
                <div class="flex justify-center items-center">
                    <span class="text-2xl">Rs. </span>
                    <input type="number"
                           class="border-b font-bold text-center text-2xl lg:w-44 sm:w-36 bg-fadeWhite focus:outline-none active:outline-none"
                           value="11000.00" id="bidAmount">
                </div>

            </div>
            <div class="plus-btn bg-white w-11 h-11 grid items-center justify-center rounded-lg shadow-md border border-blue-500 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md duration-300 transition-all cursor-pointer">
                <i class="fa-solid fa-plus"></i>
            </div>
        </div>
        <button class=" w-full grid items-center justify-center py-4 bg-blue text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 active:shadow-md active:translate-y-0 transition-all duration-300 font-medium">
            Place Bid
        </button>
    </div>
    <div class="grid grid-flow-row gap-2">
        <p class="font-bold text-lg">Description</p>
        <div class="flex gap-4 items-center">
            <p class="text-gray">Seller:</p>
            <?php require "../components/sellerBadge.php" ?>
        </div>
        <p class="text-gray">Condition: <span class="text-black">Used</span></p>
        <p>DStep back in time with these iconic Vintage 1985 Air Jordan 1 sneakers in a bold red colorway. A true
            collector's item, these sneakers are a piece of basketball history, representing the original release of
            Michael Jordan's first signature shoe. The shoes feature the classic high-top design, premium leather
            construction, and the timeless "Wings" logo on the collar. Whether you're a sneakerhead or a sports
            memorabilia enthusiast, these Jordans offer unmatched style and nostalgia. Please note that due to their
            vintage nature, these sneakers may show signs of wear, adding to their unique character.</p>
    </div>
</section>

<script>

    // Select all buttons with the classes 'minus-btn' and 'plus-btn'
    const buttons = document.querySelectorAll(".minus-btn, .plus-btn");

    // Get the input element for the bid amount
    const input = document.getElementById("bidAmount");

    // Parse the current bid amount from the input value
    const currentBid = parseFloat(input.value);

    // Initialize the bid amount with the current bid value
    let bidAmount = parseFloat(input.value);

    // Add click event listeners to each button
    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            // If the button is a minus button and the bid amount is greater than the current bid + 500
            if (btn.classList.contains('minus-btn') && bidAmount > currentBid + 500) {
                // Decrease the bid amount by 500
                bidAmount -= 500.00;
            }
            // If the button is a plus button
            else if (btn.classList.contains('plus-btn')) {
                // Increase the bid amount by 500
                bidAmount += 500.00;
            }
            // Update the input value with the new bid amount
            input.value = bidAmount;
        });
    });

    // Prevent user from entering lower values
    input.addEventListener('blur', (e) => {
        if (e.target.value < currentBid) {
            e.target.value = currentBid;
        }
    })

</script>