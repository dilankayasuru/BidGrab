<div class="grid place-items-center">
    <form action="" method="POST" enctype="multipart/form-data" class="grid place-items-center py-4 w-fit">
        <div class="mb-4">
            <h1 class="text-gray text-center text-xl mb-4">Product Information</h1>
            <div class="mb-4">
                <p class="block text-gray-700 font-medium mb-2">Images</p>
                <div class="flex gap-4 justify-between">
                    <?php for ($i = 0; $i < 5; $i++) : ?>
                        <div class="relative w-fit mb-4">
                            <div class="w-20 h-20 rounded-md overflow-hidden border border-blue-500 shadow-xl">
                                <?php
                                $image = $images[$i]["image"] ?? '';
                                $imageSrc = empty($image) ? "/bidgrab/public/images/placeholder.png" : "/bidgrab/app/server/auctionImages/$image";
                                ?>
                                <img src="<?=$imageSrc?>" alt="upload image"
                                     class="w-full h-full object-cover previewImage"
                                     id="auction-image-preview-<?=$i?>">
                                <i class="<?= empty($image) ? 'invisible' : 'visible' ?> fa-solid fa-circle-xmark cursor-pointer text-red absolute top-0 right-0 text-xl translate-x-1/2 -translate-y-1/2" onclick="removeImage()" id="image-<?=$i?>"></i>
                            </div>
                            <input type="file" accept=".jpg, .jpeg, .png" name="products[]" id="auction-image-input-<?=$i?>"
                                   onchange="loadProductImage()"
                                   class="hidden">
                            <label for="auction-image-input-<?=$i?>"
                                   class="cursor-pointer bg-blue py-1 px-1 w-8 h-8 rounded-full flex justify-center items-center absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2">
                                <i class="fa-solid fa-pen-to-square text-white"></i>
                            </label>
                        </div>
                    <?php endfor; ?>

                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="auction-title">
                    Title
                </label>
                <input
                        id="auction-title"
                        type="text"
                        placeholder="Enter product title"
                        name="auction-title"
                        value="<?= $product['title'] ?? ''; ?>"
                        class="appearance-none rounded-lg border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="description">
                    Description
                </label>
                <textarea rows="8" id="description" name="description" placeholder="Enter your product description"
                          class="appearance-none rounded-lg border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                ><?= $product['description'] ?? ''; ?></textarea>
            </div>


            <div class="flex gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="condition">
                        Condition
                    </label>
                    <div class="min-w-72 rounded-lg border-blue-500 border flex justify-between items-center">
                        <select
                                name="condition"
                                id="condition"
                                class="mr-2 appearance-auto rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <?php $itemCondition = $product['condition'] ?? '' ?>
                            <option value="new" <?= $itemCondition == 'new' ? 'selected' : ''; ?>>Brand new</option>
                            <option value="used" <?= $itemCondition == 'used' ? 'selected' : ''; ?>>Used</option>
                            <option value="reconditioned" <?= $itemCondition == 'reconditioned' ? 'selected' : ''; ?>>
                                Reconditioned
                            </option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="category">
                        Category
                    </label>
                    <div class="min-w-72 rounded-lg border-blue-500 border flex justify-between items-center">
                        <select
                                name="category"
                                id="category"
                                class="mr-2 appearance-auto rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <?php $itemCategoryId = $product['category_id'] ?? '' ?>
                            <?php foreach ($categories as $category) : ?>
                                <option
                                        value="<?= $category["category_id"] ?>"
                                    <?= $itemCategoryId == $category["category_id"] ? 'selected' : ''; ?>>
                                    <?= $category["name"] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h1 class="text-gray text-center text-xl mb-4">Auction Information</h1>
            <div class="flex gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="startDate">
                        Start Date
                    </label>
                    <input
                            value="<?= $product['start_date'] ?? ''; ?>"
                            id="startDate"
                            type="date"
                            name="startDate"
                            class="min-w-72 appearance-none rounded-lg border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="endDate">
                        End Date
                    </label>
                    <input
                            value="<?= $product['end_date'] ?? ''; ?>"
                            id="endDate"
                            type="date"
                            name="endDate"
                            class="min-w-72 appearance-none rounded-lg border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="startTime">
                        Start time
                    </label>
                    <input
                            value="<?= $product['start_time'] ?? ''; ?>"
                            id="startTime"
                            type="time"
                            name="startTime"
                            class="min-w-72 appearance-none rounded-lg border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="endTime">
                        End time
                    </label>
                    <input
                            value="<?= $product['end_time'] ?? ''; ?>"
                            id="endTime"
                            type="time"
                            name="endTime"
                            class="min-w-72 appearance-none rounded-lg border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="basePrice">
                    Base price
                </label>
                <input
                        value="<?= $product['base_price'] ?? ''; ?>"
                        id="basePrice"
                        type="number"
                        name="basePrice"
                        class="appearance-none rounded-xl border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        </div>

        <div class="flex items-center justify-end w-full mb-8">
            <div class="flex gap-2">
                <button id="resetBtn" type="reset"
                        onclick="clearImages()"
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
</div>

<script>
    function removeImage() {
        let idNo = event.target.id.split('-')[1];
        const auctionImage = document.getElementById(`auction-image-preview-${idNo}`);
        auctionImage.src = "/bidgrab/public/images/placeholder.png";
        document.getElementById(`auction-image-input-${idNo}`).value = '';

        event.target.classList.remove('visible');
        event.target.classList.add('invisible');
    }

    function loadProductImage() {
        const file = event.target.files;
        let idNo = event.target.id.split('-')[3];
        const imageRemoveCross = document.getElementById(`image-${idNo}`);

        imageRemoveCross.classList.add('visible');
        imageRemoveCross.classList.remove('invisible');

        if (file) {
            console.log(file)
            const fileReader = new FileReader();
            const auctionImage = document.getElementById(`auction-image-preview-${idNo}`);

            fileReader.onload = function (event) {
                auctionImage.setAttribute('src', event.target.result);
            }
            fileReader.readAsDataURL(file[0]);
        }
    }

    function clearImages() {
        window.location.replace("/bidgrab/public/dashboard/auction-edit?id=<?=$product['auction_id']?>");
    }
</script>