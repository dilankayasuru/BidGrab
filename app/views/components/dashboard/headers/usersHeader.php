<div class="flex justify-between mb-4">
    <div>
        <h1 class="text-2xl font-medium">Users</h1>
        <p class="text-gray">Total registered users: <?= count($users) ?? 0 ?></p>
    </div>
    <?php require_once "../app/views/components/dashboard/signOut.php"; ?>
</div>
<div class="flex justify-between items-center mb-4">
    <div class="search">
        <input type="text" placeholder="Search users">
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
    <div class="sort-container">
        <div class="relative">
            <div class="inline-flex items-center cursor-pointer" id="sort-btn">
                <div class="rounded-full shadow-lg p-2 hover:-translate-y-0.5 hover:shadow-xl transition-all duration-300 active:translate-y-0 active:shadow-lg">
                    <img src="https://img.icons8.com/ios-filled/50/sorting-arrows.png" alt="sorting-arrows"
                         class="w-6 h-6"/>
                </div>
                <p class="px-2 py-2">
                    Sort By: <?=ucfirst($sort)?>
                </p>
            </div>

            <div id="sort-menu" class="hidden absolute end-0 z-10 mt-2 w-56 rounded-md shadow-lg bg-white"
                 role="menu">
                <div class="p-2">
                    <a href="?filter=<?= $filter ?>&sort=default"
                       class="block sort-menu-item rounded-lg px-4 py-2 text-sm text-gray hover:bg-fadeWhite hover:text-black cursor-pointer">
                        Default
                    </a>

                    <a href="?filter=<?= $filter ?>&sort=latest"
                       class="block sort-menu-item rounded-lg px-4 py-2 text-sm text-gray hover:bg-fadeWhite hover:text-black cursor-pointer">
                        Latest
                    </a>

                    <a href="?filter=<?= $filter ?>&sort=old"
                       class="block sort-menu-item rounded-lg px-4 py-2 text-sm text-gray hover:bg-fadeWhite hover:text-black cursor-pointer">
                        Old
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex justify-between items-center mb-4">
    <div class="flex gap-2">
        <a href="?filter=all"
           class="dashboard-filter-button <?= $filter == 'all' ? 'bg-blue text-white' : 'bg-fadeWhite text-gray' ?>">
            All</a>
        <a href="?filter=user"
           class="dashboard-filter-button <?= $filter == 'user' ? 'bg-blue text-white' : 'bg-fadeWhite text-gray' ?>">
            Users</a>
        <a href="?filter=admin"
           class="dashboard-filter-button <?= $filter == 'admin' ? 'bg-blue text-white' : 'bg-fadeWhite text-gray' ?>">
            Admins</a>
        <a href="?filter=active"
           class="dashboard-filter-button <?= $filter == 'active' ? 'bg-blue text-white' : 'bg-fadeWhite text-gray' ?>">
            Active</a>
        <a href="?filter=deactivate"
           class="dashboard-filter-button <?= $filter == 'deactivate' ? 'bg-blue text-white' : 'bg-fadeWhite text-gray' ?>">
            Deactivate</a>
    </div>
</div>

