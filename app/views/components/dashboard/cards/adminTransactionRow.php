<div class="grid grid-cols-6 place-items-center mb-4 relative">
    <p><?= $transaction["transaction_id"] ?></p>
    <p><?= date('Y/m/d', strtotime($transaction["date"])) ?></p>
    <p><?= $transaction["payee_id"] ?></p>
    <p><?= $transaction["payer_id"] ?></p>
    <p><?= $transaction["amount"] ?></p>
    <div>
        <p class="rounded-2xl <?= $transaction["status"] == 'payed' ? 'bg-green' : ($order["status"] == 'onHold' ? 'bg-orange' : 'bg-red') ?> px-4 py-1.5 text-white w-fit"><?= $transaction["status"] ?></p>
    </div>
</div>