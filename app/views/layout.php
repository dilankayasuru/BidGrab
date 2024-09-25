<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/BidGrab/public/js/carousel.js" defer></script>
    <script src="/BidGrab/public/js/dashboard.js" defer></script>
    <script src="/BidGrab/public/js/sortMenu.js" defer></script>
    <link rel="stylesheet" href="/BidGrab/public/css/output.css">
    <script src="/BidGrab/public/js/script.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
          rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="/BidGrab/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/BidGrab/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/BidGrab/favicon-16x16.png">
    <link rel="manifest" href="/BidGrab/site.webmanifest.json">
    <title><?= $title; ?></title>
</head>
<body>

<?php

// Split the server request URI into an array using "/" as the delimiter
$serverUri = explode("/", str_replace("?", "/", $_SERVER["REQUEST_URI"]));

// Check if the URI contains "login", "register", or "dashboard"
if (in_array("login", $serverUri) || in_array("register", $serverUri) || in_array("dashboard", $serverUri)) {
    // Include the specified view file
    require_once '../app/views/' . $viewPath . '.php';

} else {
    // Include the navbar component
    require_once "../app/views/components/navbar.php";

    // Include the specified view file
    require_once '../app/views/' . $viewPath . '.php';

    // Include the footer component
    require_once "../app/views/components/footer.php";
}
?>
</body>
</html>