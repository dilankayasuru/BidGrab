<?php
function entryPoint() {
    header("Location: pages/home.php");
    exit();
}

// redirect when index.php is loaded
entryPoint();
?>