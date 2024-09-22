<section class="categories-section">
    <h1>Trending Product categories</h1>
    <div class="category-boxes-container">
        <?php foreach ($categories as $category) :  ?>
            <?php require "categoryBox.php"; ?>
        <?php endforeach; ?>
    </div>
</section>