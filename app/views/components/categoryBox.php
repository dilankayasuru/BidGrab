<div class="text-center flex items-center justify-center flex-col">
    <?php $imageSrc = FileHandler::getCategoryImage($category["picture"]) ?>
    <div class="categoryBox" style="background-image: linear-gradient(0deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.1) 80%), url('http://localhost<?=$imageSrc?>');">
        <p class="sm:hidden"><?= $category["name"] ?></p>
    </div>
    <p class="hidden sm:block leading-4 mt-2"><?= $category["name"] ?></p>
</div>
