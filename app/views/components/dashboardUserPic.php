<div class="flex items-center gap-2">
    <div class="w-14 h-14 object-cover overflow-hidden border-blue-500 border shadow-md rounded-full">
        <img src="/bidgrab/public/images/profile.png" alt="user pic" class="w-full h-full">
    </div>
    <div>
        <p class="text-white"><?= $_SESSION["user"]["first_name"]." ".$_SESSION["user"]["last_name"] ?></p>
        <p class="text-sm text-fadeWhite"><?= ucfirst($_SESSION["user"]["user_role"]) ?></p>
    </div>
</div>