<div class="pb-32">
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
