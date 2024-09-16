<section class="max-w-7xl m-auto">
    <div class="promotion-section">
        <div class="promo-left">
            <div class="promo-left-title">
                <?= isset($_SESSION["user"]) ? 'Ready to explore?' : 'Join Today' ?>
            </div>
            <div class="promo-left-text">
                <p>
                    <?= isset($_SESSION["user"]) ?
                        'Browse ongoing auctions or create a new listing and start selling your unique items!' :
                        'Sign up now and start listing or bidding on unique items!' ?>
                </p>
            </div>
            <div class="promo-left-buttons-container">
                <?php if (!isset($_SESSION["user"])) : ?>
                    <?php require "signInBtn.php"; ?>
                <?php else: ?>
                    <a href="dashboard/add-new-auction" class="primary-btn">
                        New auction
                    </a>
                <?php endif; ?>
                <a href="products" class="secondary-btn">
                    Browse Auctions
                </a>
            </div>
        </div>
        <div class="promo-right">
        </div>
    </div>
</section>
