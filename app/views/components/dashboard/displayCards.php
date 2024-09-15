<?php
function displayCard($text, $data, $icon)
{
    return
        "<div class='rounded-xl border border-blue-500 bg-fadeWhite w-60 p-4'>
            <div class='flex justify-between gap-2 items-center w-fit'>
                <div class='bg-blue w-11 h-11 rounded-full flex justify-center items-center'>
                    <i class='$icon text-lg text-white'></i>
                </div>
                <p>$text</p>
            </div>
            <div class='pt-2 flex justify-center items-center'>
                <p class='text-3xl'>$data</p>
            </div>
        </div>";
}
?>