<section class="w-full lg:mb-16">
    <div class="border-b border-gray grid grid-flow-row gap-4 pb-4 mb-4 lg:mb-8">
        <div>
            <p class="text-2xl font-bold"><?= $product["title"] ?></p>
            <p class="text-gray"><?= $product["category"] ?></p>
        </div>
        <div>
            <p class="text-gray"> <?= $isStarted ? "Current Bid:" : "Starting Price:" ?>
                <span class="text-2xl text-black font-bold"><?= $product["current_price"] ?></span>
            </p>
        </div>
        <?php if ($isStarted && !$isExpired) : ?>
            <div class="flex gap-4">
                <div class="border border-blue-500 px-4 py-1 rounded-lg">
                    <p class="text-gray">50 Bids</p>
                </div>
                <div class="border border-blue-500 px-4 py-1 rounded-lg">
                    <p class="text-gray">Ends in: <span id="time-remaining"></span></p>
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
                               value="<?= $product["current_price"] + 500 ?>" id="bidAmount">
                    </div>

                </div>
                <div class="plus-btn bg-white w-11 h-11 grid items-center justify-center rounded-lg shadow-md border border-blue-500 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:shadow-md duration-300 transition-all cursor-pointer">
                    <i class="fa-solid fa-plus"></i>
                </div>
            </div>
            <button class=" w-full grid items-center justify-center py-4 bg-blue text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 active:shadow-md active:translate-y-0 transition-all duration-300 font-medium">
                Place Bid
            </button>
        <?php elseif ($isExpired): ?>
            <div class="text-gray text-center text-xl font-bold">
                <p>Auction is Expired!</p>
            </div>
        <?php elseif (!$isStarted): ?>
            <div class="text-gray text-center text-xl font-bold">
                <p>Auction starts at: <?=$product["start_date"]." ".$product["start_time"]?></p>
            </div>
        <?php endif; ?>


    </div>
    <div class="grid grid-flow-row gap-2">
        <p class="font-bold text-lg">Description</p>
        <div class="flex gap-4 items-center">
            <p class="text-gray">Seller:</p>
            <?php require "../app/views/components/sellerBadge.php" ?>
        </div>
        <p class="text-gray">Condition: <span class="text-black"><?= $product["product_condition"] ?></span></p>
        <p><?= $product["description"] ?></p>
    </div>
</section>

<?php
$endTime = new DateTime($product["end_date"] . " " . $product["end_time"]);
$endTimeTimeStamp = $endTime->getTimestamp();
?>

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
            if (btn.classList.contains('minus-btn') && bidAmount > currentBid) {
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

    function showRemainingTime() {
        let endTimeTimeStamp = <?=$endTimeTimeStamp * 1000?>;
        let differance = endTimeTimeStamp - new Date().getTime();

        let days = Math.floor(differance / (1000 * 60 * 60 * 24));
        let hours = Math.floor((differance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let mins = Math.floor((differance % (1000 * 60 * 60)) / (1000 * 60))
        let secs = Math.floor((differance % (1000 * 60)) / 1000);

        document.getElementById("time-remaining").innerHTML = `${days > 0 ? days + "d" : ''} ${hours > 0 ? hours + "h" : ''} ${mins > 0 ? mins + "m" : ''} ${secs > 0 ? secs + "s" : ''} left`;

        // If the countdown is over, display an expiration message
        if (differance < 0) {
            clearInterval(remainingTimeInterval);
            document.getElementById("time-remaining").innerHTML = "Expired!";
        }
    }

    const remainingTimeInterval = setInterval(showRemainingTime, 1000);

</script>