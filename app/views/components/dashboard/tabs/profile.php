<div class="grid place-items-center">
    <form action="/bidgrab/public/change-profile" enctype="multipart/form-data" method="POST"
          class="grid place-items-center py-4 w-fit">
        <div class="relative w-fit mb-4">
            <div class="w-32 h-32 rounded-full overflow-hidden border border-blue-500 shadow-xl">
                <img src="<?= FileHandler::getProfilePic() ?>" alt="upload image" class="w-full h-full object-cover"
                     id="profile-image-preview">
            </div>
            <input type="file" accept=".jpg, .jpeg, .png, .webp" name="profile-pic" id="profile-image-input"
                   class="hidden">
            <label for="profile-image-input"
                   class="cursor-pointer bg-blue py-1 px-1 w-9 h-9 rounded-full flex justify-center items-center absolute bottom-0 right-0">
                <i class="fa-solid fa-pen-to-square text-white"></i>
            </label>
        </div>

        <div class="mb-4">
            <p class="text-gray mb-4">Basic Information</p>
            <div class="flex gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="first-name">
                        First name
                    </label>
                    <input
                            id="first-name"
                            type="text"
                            placeholder="Enter you first name"
                            name="first-name"
                            value="<?= $_SESSION["user"]["first_name"] ?>"
                            class="appearance-none rounded-full border-blue-500 border w-fit py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="last-name">
                        Last name
                    </label>
                    <input
                            id="last-name"
                            type="text"
                            placeholder="Enter you last name"
                            name="last-name"
                            value="<?= $_SESSION["user"]["last_name"] ?>"
                            class="appearance-none rounded-full border-blue-500 border w-fit py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="email">
                        Email address
                    </label>
                    <input
                            id="email"
                            type="email"
                            placeholder="Enter you email address"
                            name="email"
                            value="<?= $_SESSION["user"]["email"] ?>"
                            class="appearance-none rounded-full border-blue-500 border w-fit py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="phone-number">
                        Phone number
                    </label>
                    <input
                            id="phone-number"
                            type="tel"
                            placeholder="Enter you phone number"
                            name="phone-number"
                            value="<?= $_SESSION["user"]["phone"] ?>"
                            class="appearance-none rounded-full border-blue-500 border w-fit py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
        </div>

        <div class="mb-4">
            <p class="text-gray mb-4">Address Details</p>
            <div class="flex gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="address">
                        Address
                    </label>
                    <input
                            id="address"
                            type="text"
                            placeholder="Address line 1"
                            name="address"
                            value="<?= $_SESSION["user"]["address"] ?>"
                            class="appearance-none rounded-full border-blue-500 border w-fit py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="street">
                        Street
                    </label>
                    <input
                            id="street"
                            type="text"
                            placeholder="Enter your street"
                            name="street"
                            value="<?= $_SESSION["user"]["street"] ?>"
                            class="appearance-none rounded-full border-blue-500 border w-fit py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
            <div class="flex gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="city">
                        City
                    </label>
                    <input
                            id="city"
                            type="text"
                            placeholder="Enter you city"
                            name="city"
                            value="<?= $_SESSION["user"]["city"] ?>"
                            class="appearance-none rounded-full border-blue-500 border w-fit py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="district">
                        District
                    </label>
                    <input
                            id="district"
                            type="text"
                            placeholder="Enter you district"
                            name="district"
                            value="<?= $_SESSION["user"]["district"] ?>"
                            class="appearance-none rounded-full border-blue-500 border w-fit py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="province">
                    Province
                </label>
                <input
                        id="province"
                        type="text"
                        placeholder="Enter you postal province"
                        name="province"
                        value="<?= $_SESSION["user"]["province"] ?>"
                        class="appearance-none rounded-full border-blue-500 border w-fit py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        </div>

        <div class="flex items-center justify-between w-full mb-8">
            <div>
                <button type="button" id="changePasswordBtn"
                        class="block px-4 py-1 rounded border-blue text-blue border bg-fadeWhite shadow-md hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 active:shadow-md transition-all duration-300">
                    Change password
                </button>
            </div>
            <div class="flex gap-2">
                <button type="reset"
                        class="px-4 py-1 rounded border-blue text-blue border bg-fadeWhite shadow-md hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 active:shadow-md transition-all duration-300">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-1 rounded border-blue text-white border bg-blue shadow-md hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 active:shadow-md transition-all duration-300">
                    Save changes
                </button>
            </div>
        </div>
    </form>
    <?php if (!empty($error)) : ?>
        <div class="h-1 w-full bg-red absolute top-0 left-0 animate-close"></div>
        <div class="z-20 animate-revealIn fixed top-16 bg-white rounded-lg px-8 py-4 flex justify-between items-center gap-4 w-fit mx-auto my-0 shadow-lg">
            <i class="fa-solid fa-circle-exclamation text-red"></i>
            <p class="text-red ">
                <?= $error == 'empty' ? 'Please enter valid inputs!' : ($error == "notmatched" ? 'Password does not match!' : 'Incorrect password please try again!') ?>
            </p>
        </div>
        <script>
            setTimeout(() => {
                location.href = "/bidgrab/public/dashboard/profile"
            }, 5000)
        </script>
    <?php endif; ?>
</div>

<?php require_once "../app/views/components/dashboard/changePassword.php"; ?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const profilePicInput = document.getElementById('profile-image-input');
        const changePasswordBtn = document.getElementById('changePasswordBtn');
        const changePasswordCloseBtn = document.getElementById('changePasswordClose');
        const changePasswordForm = document.getElementById('changePasswordForm');
        const resetBtn = document.getElementById("passwordCloseBtn");

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

        const closePopUp = () => {
            changePasswordForm.classList.remove("block");
            changePasswordForm.classList.add("hidden");
        }

        profilePicInput.addEventListener("change", loadProfilePic);

        changePasswordBtn.addEventListener("click", () => {
            changePasswordForm.classList.add("block");
            changePasswordForm.classList.remove("hidden");
        })

        changePasswordCloseBtn.addEventListener("click", closePopUp);

        resetBtn.addEventListener("click", closePopUp);

    })
</script>