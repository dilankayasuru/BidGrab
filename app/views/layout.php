<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/BidGrab/public/js/carousel.js" defer></script>
    <script src="/BidGrab/public/js/dashboard.js" defer></script>
    <script src="/BidGrab/public/js/sortMenu.js" defer></script>
    <link rel="stylesheet" href="/BidGrab/public/css/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
          rel="stylesheet">
    <title><?= $title; ?></title>
</head>
<body>

<?php

$serverUri = explode("/", str_replace("?", "/", $_SERVER["REQUEST_URI"]));

if (in_array("login", $serverUri) || in_array("register", $serverUri) || in_array("dashboard", $serverUri)) {
    require_once '../app/views/' . $viewPath . '.php';

} else {
    require_once "../app/views/components/navbar.php";

    require_once '../app/views/' . $viewPath . '.php';

    require_once "../app/views/components/footer.php";
}
?>
</body>
</html>