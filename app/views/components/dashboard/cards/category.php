<div class="h-44 w-full p-4 border border-blue-500 rounded-xl grid gap-4 grid-cols-5 mb-4">
    <div class="text-center">
        <p class="text-gray mb-2">Category ID</p>
        <p><?= $category["category_id"] ?></p>
    </div>
    <div>
        <p class="text-gray mb-2">Category name</p>
        <p><?= $category["name"] ?></p>
    </div>
    <div>
        <p class="text-gray mb-2">Description</p>
        <p><?= $category["description"] ?></p>
    </div>
    <div>
        <p class="text-gray mb-2">Image</p>
        <div class="border border-blue-500 rounded-lg h-28 w-44 overflow-hidden mb-2">
            <img src="<?= FileHandler::getCategoryImage($category["picture"] ?? '') ?>"
                 class="object-cover w-full h-full object-center" alt="category image">
        </div>
    </div>

    <div class="justify-self-center">
        <p class="text-gray mb-2">Actions</p>
        <div class="flex justify-centercenter items-center gap-2">
            <a href="edit-category?id=<?= $category['category_id'] ?>"
               class="cursor-pointer bg-blue py-1 px-1 w-9 h-9 rounded-full flex justify-center items-center">
                <i class="fa-solid fa-pen-to-square text-white"></i>
            </a>
            <a href="delete-category?id=<?= $category['category_id'] ?>"
               class="cursor-pointer bg-red py-1 px-1 w-9 h-9 rounded-full flex justify-center items-center">
                <i class="fa-solid fa-trash-can text-white"></i>
            </a>
        </div>
    </div>
</div>

