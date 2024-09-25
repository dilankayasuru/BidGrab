<div class="w-fit min-w-80 border border-blue-500 rounded-xl p-4 bg-fadeWhite">
    <p>Profile</p>
    <div class="grid place-items-center">
        <div class="w-28 h-28 mb-4 shadow-lg rounded-full overflow-hidden">
            <img  src="<?=FileHandler::getProfilePic()?>" alt="profile picture" class="h-full w-full object-cover">
        </div>
        <p class="mb-1">Name: <?=$_SESSION["user"]["first_name"]." ".$_SESSION["user"]["last_name"]?></p>
        <p class="mb-1">Email: <?=$_SESSION["user"]["email"]?></p>
        <p class="mb-1">Balance: Rs.1500</p>
    </div>
</div>