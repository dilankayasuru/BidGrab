<?php
$rowCount = count($tableData["headings"]);
$headings = $tableData["headings"];
$columns = $tableData["columns"];
?>
<div class='w-full border border-blue-500 rounded-xl p-4 bg-fadeWhite'>
    <div class='mb-4'>
        <h1><?= $tableTitle ?></h1>
    </div>
    <div>
        <div class='grid grid-cols-<?= $rowCount ?> place-items-center text-gray pb-2'>
            <?php foreach ($headings as $heading) : ?>
                <p><?= $heading ?></p>
            <?php endforeach; ?>
        </div>
        <?php foreach ($columns as $column) : ?>
            <div class='grid grid-cols-<?= $rowCount ?> place-items-center mb-1'>
                <?php foreach ($column as $data) : ?>
                    <p><?= $data ?></p>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    </div>
</div>