<?php if (count($transactions) > 0) : ?>
    <div class="pb-32">
        <div class="grid grid-cols-6 place-items-center mb-4 text-gray">
            <p>Payment ID</p>
            <p>Date</p>
            <p>Payee</p>
            <p>Payer</p>
            <p>Amount</p>
            <p>Status</p>
        </div>

        <?php foreach ($transactions as $transaction) : ?>
            <?php require "../app/views/components/dashboard/cards/adminTransactionRow.php"; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (count($transactions) <= 0): ?>
    <div class="h-fit text-center">
        <p class="text-gray text-xl">No transactions to display!</p>
    </div>
<?php endif; ?>