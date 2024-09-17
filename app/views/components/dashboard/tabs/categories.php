<?php $noCategories = true; ?>
<?php if (count($categories) > 0) : ?>
    <div class="pb-44">
        <?php foreach ($categories as $category) : ?>
            <?php require "../app/views/components/dashboard/cards/category.php"; ?>
            <?php $noAuctions = false; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if ($noCategories || count($categories) <= 0): ?>
    <div class="h-fit text-center">
        <p class="text-gray text-xl">No categories to display!</p>
    </div>
<?php endif; ?>