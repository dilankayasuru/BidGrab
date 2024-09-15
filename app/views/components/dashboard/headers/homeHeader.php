<div class="flex justify-between mb-4">
    <div>
        <h1 class="text-2xl font-medium">Welcome Back, <?= $_SESSION["user"]["first_name"] ?></h1>
        <?php
        $greeting = "";
        $hour = date('G');
        switch ($hour) {
            case $hour < 12:
                $greeting = "Good morning!";
                break;
            case $hour < 15:
                $greeting = "Good afternoon!";
                break;
            case $hour < 18:
                $greeting = "Good evening!";
                break;
            case $hour < 24:
                $greeting = "Good night!";
                break;
        }
        ?>
        <p><?= $greeting ?></p>
    </div>
    <?php require_once "../app/views/components/dashboard/signOut.php"; ?>
</div>