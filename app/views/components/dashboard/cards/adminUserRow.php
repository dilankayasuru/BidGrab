<div class="grid grid-cols-6 place-items-center mb-4">
    <p><?= $user["user_id"] ?></p>
    <p><?= $user["first_name"] . " " . $user["last_name"] ?></p>
    <p><?= $user["date_joined"] ?></p>
    <p><?= $user["user_role"] ?></p>
    <p class="<?= $user["status"] == "active" ? 'bg-green' : 'bg-red' ?> px-4 py-1.5 text-white w-fit rounded-2xl"><?= $user["status"] ?></p>
    <div>
        <a href="" class="px-2" target="_blank">
            <i class="fa-solid fa-eye"></i>
        </a>
        <button type="button" value="" class="px-2">
            <i class="fa-solid fa-pen-to-square"></i>
        </button>
    </div>
</div>