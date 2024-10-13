<?php if (count($categories) > 0) : ?>
    <div class="pb-44">
        <?php foreach ($categories as $category) : ?>
            <?php require "../app/views/components/dashboard/cards/category.php"; ?>
            <?php $noAuctions = false; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (count($categories) <= 0): ?>
    <div class="h-fit text-center">
        <p class="text-gray text-xl">No categories to display!</p>
    </div>
<?php endif; ?>

<?php if (!empty($error)) : ?>
    <div class="h-1 w-full bg-red absolute top-0 left-0 animate-close"></div>
    <div class="z-20 animate-revealIn absolute top-8 left-1/2 bg-white rounded-lg px-8 py-4 flex justify-between items-center gap-4 w-fit shadow-lg">
        <i class="fa-solid fa-circle-exclamation text-red"></i>
        <p class="text-red ">Can not delete the Other category!</p>
    </div>
    <script>
        setTimeout(() => {
            location.href = "/bidgrab/public/dashboard/categories"
        }, 5000)
    </script>
<?php endif; ?>
