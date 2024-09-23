<div class="pb-44">
    <div class="grid grid-cols-6 place-items-center mb-4 text-gray">
        <p>User ID</p>
        <p>Name</p>
        <p>Date Joined</p>
        <p>Role</p>
        <p>Status</p>
        <p>Action</p>
    </div>

    <?php foreach ($users as $user) : ?>
        <?php require "../app/views/components/dashboard/cards/adminUserRow.php"; ?>
    <?php endforeach; ?>
</div>

<div class="absolute bottom-0 right-0 z-10 px-8 py-8 flex justify-between gap-2">
    <a href="<?=BASE_URL?>register/user" class="text-white bg-blue rounded-md px-4 py-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 active:shadow-lg transition-all duration-300">
        <i class="fa-solid fa-user-plus"></i> Add new user
    </a>
</div>