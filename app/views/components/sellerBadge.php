<div class="flex gap-4 justify-between items-center">
    <div class="flex gap-2 justify-between items-center">
        <div class="w-14 h-14 object-cover overflow-hidden border-blue-500 border shadow-md rounded-full">
            <img src="<?=FileHandler::getProfilePic($seller['profile_pic'], $seller['first_name'].' '.$seller['last_name'])?>" alt="seller pic" class="w-full h-full">
        </div>
        <div>
            <p class="text-gray"><?= $seller["first_name"] . ' ' . $seller["last_name"] ?></p>
            <div>
                <?php for ($i = 0; $i < $seller["rating"] ; $i++) : ?>
                    <i class="fa-solid fa-star text-star"></i>
                <?php endfor; ?>
                <?php for ($i = 0; $i < (5 - $seller["rating"]) ; $i++) : ?>
                    <i class="fa-regular fa-star text-black"></i>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <div>
        <a href="/bidgrab/public/reviews" class="text-blue">View Reviews</a>
    </div>
</div>