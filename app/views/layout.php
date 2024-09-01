<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/output.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="./js/carousel.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
          rel="stylesheet">
    <title><?= $title; ?></title>
</head>
<body>
<?php require_once "../app/views/components/header.php"; ?>
<?php require_once "../app/views/components/navbar.php"; ?>

<?php require_once '../app/views/' . $viewPath . '.php'; ?>

<?php require_once "../app/views/components/footer.php"; ?>
</body>
</html>