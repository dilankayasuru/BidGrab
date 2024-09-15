<?php

function dashboardMenuItem($menuText, $menuIcon, $tab, $param = "")
{
    if (empty($param)) {
        $href = "/bidgrab/public/dashboard/$tab";
    }
    else {
        $href = "/bidgrab/public/dashboard/$tab?$param";
    }

    return
        "<a id='$tab' href='$href' class='flex gap-4 items-center py-3 px-6 rounded-full w-60 hover:bg-white-15 hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 active:shadow-md transition-all duration-300 dashboardMenuItem'>
            <div class='w-7'>
                <i class='$menuIcon text-lg text-white'></i>
            </div>
            <p class='text-white'>$menuText</p>
        </a>";
}

?>
