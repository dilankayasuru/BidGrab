<div class="grid place-items-center">
    <form action="" method="POST" class="grid place-items-center py-4 w-fit">
        <!--        <div class="relative w-fit mb-4">-->
        <!--            <div class="w-32 h-32 rounded-full overflow-hidden border border-blue-500 shadow-xl">-->
        <!--                <img src="../public/images/profile.png" alt="upload image" class="w-full h-full object-cover"-->
        <!--                     id="profile-image-preview">-->
        <!--            </div>-->
        <!--            <input type="file" accept=".jpg, .jpeg, .png" name="profile-pic" id="profile-image-input" class="hidden">-->
        <!--            <label for="profile-image-input"-->
        <!--                   class="cursor-pointer bg-blue py-1 px-1 w-9 h-9 rounded-full flex justify-center items-center absolute bottom-0 right-0">-->
        <!--                <i class="fa-solid fa-pen-to-square text-white"></i>-->
        <!--            </label>-->
        <!--        </div>-->

        <div class="mb-4">
            <h1 class="text-gray text-center text-xl mb-4">Product Information</h1>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="auction-title">
                    Title
                </label>
                <input
                        id="auction-title"
                        type="text"
                        placeholder="Enter product title"
                        name="auction-title"
                        class="appearance-none rounded-lg border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="description">
                    Description
                </label>
                <textarea rows="8" id="description" name="description" placeholder="Enter your product description"
                          class="appearance-none rounded-lg border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
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
                            <option value="new">Brand new</option>
                            <option value="used">Used</option>
                            <option value="reconditioned">Reconditioned</option>
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
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category["category_id"]?>"><?= $category["name"]?></option>
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
                        id="basePrice"
                        type="number"
                        name="basePrice"
                        class="appearance-none rounded-xl border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        </div>

        <div class="flex items-center justify-end w-full mb-8">
            <div class="flex gap-2">
                <button id="resetBtn" type="reset"
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
    document.addEventListener("DOMContentLoaded", () => {
        const profilePicInput = document.getElementById('profile-image-input');

        const loadProfilePic = () => {
            const file = profilePicInput.files;
            if (file) {
                const fileReader = new FileReader();
                const profilePicPreview = document.getElementById('profile-image-preview');
                fileReader.onload = function (event) {
                    profilePicPreview.setAttribute('src', event.target.result);
                }
                fileReader.readAsDataURL(file[0]);
            }
        }

        profilePicInput.addEventListener("change", loadProfilePic);
    })
</script>