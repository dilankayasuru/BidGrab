<div class="grid place-items-center">
    <form action="" method="POST" enctype="multipart/form-data" class="grid place-items-center py-4 w-full"
          onsubmit="return validateCategoryAdd()">
        <div class="max-w-md w-full">
            <h1 class="text-gray text-center text-xl mb-4">Category Information</h1>
            <div class="mb-4 grid place-items-center">
                <p class="block text-gray-700 font-medium mb-2 justify-self-start">Category Image</p>
                <div class="relative w-fit mb-6">
                    <div class="w-32 h-32 rounded-md overflow-hidden border border-blue-500 shadow-xl">
                        <img src="<?= FileHandler::getCategoryImage($category["picture"] ?? '') ?>" alt="upload image"
                             class="w-full h-full object-cover"
                             id="category-image-preview">
                        <i class="<?= empty($category['image']) ? 'invisible' : 'visible' ?> fa-solid fa-circle-xmark cursor-pointer text-red absolute top-0 right-0 text-xl translate-x-1/2 -translate-y-1/2"
                           onclick="removeImage()" id="category-image-remove"></i>
                        <script type="text/javascript">
                            function removeImage() {
                                const categoryImage = document.getElementById('category-image-preview');
                                categoryImage.src = "/bidgrab/public/images/placeholder.png";
                                document.getElementById('category-image-input').value = '';

                                event.target.classList.remove('visible');
                                event.target.classList.add('invisible');
                            }
                        </script>
                    </div>
                    <input type="file" accept=".jpg, .jpeg, .png, .webp" name="category-pic" id="category-image-input"
                           class="hidden" onchange="loadCategoryImage()">
                    <label for="category-image-input"
                           class="cursor-pointer bg-blue py-1 px-1 w-9 h-9 rounded-full flex justify-center items-center absolute bottom-0 right-0 translate-y-1/2 translate-x-1/2">
                        <i class="fa-solid fa-pen-to-square text-white"></i>
                    </label>
                    <script type="text/javascript">
                        function loadCategoryImage() {
                            const imageFile = event.target.files;
                            const rmCross = document.getElementById('category-image-remove');

                            rmCross.classList.add('visible');
                            rmCross.classList.remove('invisible');

                            if (imageFile) {
                                const fileReader = new FileReader();
                                const categoryImagePrev = document.getElementById('category-image-preview');

                                fileReader.onload = function (event) {
                                    categoryImagePrev.setAttribute('src', event.target.result);
                                }
                                fileReader.readAsDataURL(imageFile[0]);
                            }
                        }
                    </script>
                </div>
                <input type="text" name="saved-category-pic" value="<?= $category["picture"] ?? '' ?>"
                       class="hidden invisible">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="category-name">
                    Category name
                </label>
                <input
                        id="category-name"
                        type="text"
                        placeholder="Enter product title"
                        name="category-name"
                        value="<?= $category['name'] ?? ''; ?>"
                        required
                        class="appearance-none rounded-lg border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-center text-red text-sm"><?= $response ?? '' ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="category-description">
                    Category description
                </label>
                <textarea rows="8" id="category-description" name="description" placeholder="Enter category description"
                          required
                          class="appearance-none rounded-lg border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                ><?= $category['description'] ?? ''; ?></textarea>
            </div>
        </div>

        <div class="max-w-md flex items-center justify-end w-full mb-8">
            <div class="flex gap-2">
                <script>
                    function resetCategoryForm() {
                        window.location.replace("/bidgrab/public/dashboard/categories");
                    }
                </script>
                <button id="categoryForm-resetBtn" type="reset"
                        onclick="resetCategoryForm()"
                        class="px-4 py-1 rounded border-blue text-blue border bg-fadeWhite shadow-md hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 active:shadow-md transition-all duration-300">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-1 rounded border-blue text-white border bg-blue shadow-md hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 active:shadow-md transition-all duration-300">
                    Save
                </button>
            </div>
        </div>
    </form>
    <?php if (!empty($errors)) : ?>
        <?php foreach ($errors as $error) : ?>
            <div class="z-20 animate-revealIn fixed top-16 bg-white rounded-lg px-4 py-2 flex justify-between items-center gap-4 w-fit mx-auto my-0 shadow-lg">
                <i class="fa-solid fa-circle-exclamation text-red"></i>
                <p class="text-red ">
                    <?= $error ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>