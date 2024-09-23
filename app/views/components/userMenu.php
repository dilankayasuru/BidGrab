<div>
    <div class="relative">
        <div class="inline-flex items-center cursor-pointer" id="profile-menu-icon">
            <div class="w-8 h-8 rounded-full shadow-lg overflow-hidden">
                <img src="<?= FileHandler::getProfilePic() ?>" alt="profile pic"
                     class="w-full h-full object-cover"/>
            </div>
            <p class="px-2 py-2">
                <i class="fa-solid fa-chevron-down"></i>
            </p>
        </div>

        <div id="profile-menu"
             class="hidden absolute end-0 z-10 mt-2 w-56 rounded-md shadow-lg bg-white border border-blue-500"
             role="menu">
            <div class="p-2">
                <div class="px-4 pb-2 flex justify-between items-center">
                    <p>Hello <?= $_SESSION["user"]["first_name"] ?>!</p>
                    <div class="bg-green w-2 h-2 rounded-full shadow-sm shadow-green"></div>
                </div>
                <?php if ($_SESSION["user"]["user_role"] == "user") : ?>
                    <div>
                        <a href="/bidgrab/public/dashboard/add-new-auction"
                           class="block profile-menu-item rounded-lg px-4 py-2 text-gray hover:bg-fadeWhite hover:text-black cursor-pointer">
                            <i class="fa-solid fa-square-plus text-md"></i>
                            <span class="pl-2 text-sm">Create new auction</span>
                        </a>
                    </div>
                <?php endif; ?>
                <div>
                    <a href="/bidgrab/public/dashboard"
                       class="block profile-menu-item rounded-lg px-4 py-2 text-gray hover:bg-fadeWhite hover:text-black cursor-pointer">
                        <i class="fa-solid fa-gauge-high text-md"></i>
                        <span class="pl-2 text-sm">Dashboard</span>
                    </a>
                </div>


                <div>
                    <a href="/bidgrab/public/sign-out"
                       class="block profile-menu-item rounded-lg px-4 py-2 text-gray hover:bg-fadeWhite hover:text-black cursor-pointer">
                        <i class="fa-solid fa-right-from-bracket text-md"></i>
                        <span class="pl-2 text-sm">Sign out</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    const menuBtn = document.getElementById("profile-menu-icon");
    const profileMenu = document.getElementById("profile-menu");
    const profileMenuItems = document.querySelectorAll('.profile-menu-item');
    let MenuOpened = false;

    menuBtn.addEventListener('click', () => {
        if (MenuOpened) {
            profileMenu.classList.add('hidden');
            MenuOpened = false;
        } else {
            profileMenu.classList.remove('hidden');
            MenuOpened = true;
        }
    });

    profileMenuItems.forEach(item => {
        item.addEventListener('click', () => {
            profileMenu.classList.add('hidden');
            MenuOpened = false;
        });
    });
</script>