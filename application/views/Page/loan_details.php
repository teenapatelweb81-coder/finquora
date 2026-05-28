
<style>
.alert {
    z-index: 10;
}
</style>
<?php if (!empty($loans)): ?>
        <div class="card mb-4" style="max-width: 800px; margin: 0 auto;">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <p><strong>Bank Name:</strong> <span class="ml-2"><?= $loans['bank_name'] ?></span></p>
                        <p><strong>Amount:</strong> <span class="ml-2"><?= $loans['amount'] ?></span></p>
                        <p><strong>EMI:</strong> <span class="ml-2"><?= $loans['emi'] ?></span></p>
                        <p><strong>Interest:</strong> <span class="ml-2"><?= $loans['interest'] ?></span></p>
                    </div>
                    <div class="col-6">
                        <p><strong>Tenure:</strong> <span class="ml-2"><?= $loans['tenure'] ?></span></p>
                        <p><strong>Disbursement:</strong> <span class="ml-2"><?= $loans['disbusment'] ?></span></p>
                        <p><strong>Remark:</strong> <span class="ml-2"><?= $loans['remark'] ?></span></p>
                    </div>
                </div>
            </div>
        </div>
<?php else: ?>
    <div class="alert alert-warning text-center">No loan details found.</div>
<?php endif; ?>
