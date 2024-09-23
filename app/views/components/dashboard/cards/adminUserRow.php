<div class="grid grid-cols-6 place-items-center mb-4">
    <p><?= $user["user_id"] ?></p>
    <p><?= $user["first_name"] . " " . $user["last_name"] ?></p>
    <p><?= $user["date_joined"] ?></p>
    <p><?= $user["user_role"] ?></p>
    <p class="<?= $user["status"] == "active" ? 'bg-green' : 'bg-red' ?> px-4 py-1.5 text-white w-fit rounded-2xl"><?= $user["status"] ?></p>
    <div>
        <?php if ($user["status"] == "active") : ?>
            <a href="<?= BASE_URL . "user/deactivate?id=" . $user["user_id"] ?>"
               class="px-2 text-gray hover:text-red transition-all duration-300">
                <i class="fa-solid fa-ban"></i> Deactivate
            </a>
        <?php else: ?>
            <a href="<?= BASE_URL . "user/activate?id=" . $user["user_id"] ?>"
               class="px-2 text-gray hover:text-green transition-all duration-300">
                <i class="fa-solid fa-user-check"></i> Activate
            </a>
        <?php endif; ?>
    </div>
</div>