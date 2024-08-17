<?php
function redirectToHome() {
    header("Location: pages/home.php");
    exit();
}

// Call the function to redirect when index.php is loaded
redirectToHome();
?>