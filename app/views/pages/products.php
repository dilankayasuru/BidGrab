<div class="md:pt-8 products-hero w-full bg-blue flex flex-col items-center justify-center gap-8 text-center px-4 pt-16 pb-4 shadow-blue-500 shadow-lg">
    <div class="text">
        <p class="hero-title">BidGrab</p>
        <p class="hero-text-sm">Bid, Win, and Save Big on Unique Items!</p>
    </div>
    <?php require "../app/views/components/search.php"; ?>
</div>
<div class="products-wrapper py-12 max-w-7xl m-auto ps-[4vw] pe-[4vw]">
    <div class="top-header flex justify-between">
        <p class="text-2xl font-medium">All Products</p>
        <div class="sort-container">
            <div class="relative">
                <div class="inline-flex items-center cursor-pointer" id="sort-btn">
                    <div class="rounded-full shadow-lg p-2 hover:-translate-y-0.5 hover:shadow-xl transition-all duration-300 active:translate-y-0 active:shadow-lg">
                        <img src="https://img.icons8.com/ios-filled/50/sorting-arrows.png" alt="sorting-arrows"
                             class="w-6 h-6"/>
                    </div>
                    <p class="px-2 py-2">
                        Sort By: <span id="selected-sort">
                            <?php
                            $sortLabel = "";
                            if ($sort == "default") {
                                $sortLabel = "Default";
                            } elseif ($sort == "lowtohigh") {
                                $sortLabel = "Price low to high";
                            } elseif ($sort == "hightolow") {
                                $sortLabel = "Price high to low";
                            } elseif ($sort == "recent") {
                                $sortLabel = "Recently added";
                            }
                            ?>
                            <?= $sortLabel ?>
                        </span>
                    </p>
                </div>

                <div id="sort-menu" class="hidden absolute end-0 z-10 mt-2 w-56 rounded-md shadow-lg bg-white"
                     role="menu">
                    <div class="p-2">
                        <a href="?sort=default"
                           class="block sort-menu-item rounded-lg px-4 py-2 text-sm text-gray hover:bg-fadeWhite hover:text-black cursor-pointer">
                            Default
                        </a>

                        <a href="?sort=lowtohigh"
                           class="block sort-menu-item rounded-lg px-4 py-2 text-sm text-gray hover:bg-fadeWhite hover:text-black cursor-pointer">
                            Price low to high
                        </a>

                        <a href="?sort=hightolow"
                           class="block sort-menu-item rounded-lg px-4 py-2 text-sm text-gray hover:bg-fadeWhite hover:text-black cursor-pointer">
                            Price high to low
                        </a>

                        <a href="?sort=recent"
                           class="block sort-menu-item rounded-lg px-4 py-2 text-sm text-gray hover:bg-fadeWhite hover:text-black cursor-pointer">
                            Recently added
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-4 gap-8 pt-8 xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
        <?php foreach ($auctions as $product) : ?>
            <?php if (!$product["isExpired"]) : ?>
                <?php require "../app/views/components/productCard.php"; ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="w-full grid place-items-center pt-16">
        <button type="button"
                class="bg-white border border-blue rounded-md py-2 px-24 text-blue font-medium shadow-lg active:shadow-xl active:-translate-y-0 transition-all duration-300 hover:-translate-y-0.5">
            Load more
        </button>
    </div>
</div>
