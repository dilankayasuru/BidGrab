<section class="categories-section">
    <h1>Trending Product categories</h1>
    <div class="category-boxes-container">
        <?php for ($i = 0; $i < 12; $i++) :  ?>
            <?php require "categoryBox.php"; ?>
        <?php endfor; ?>
    </div>
</section>