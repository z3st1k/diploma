<?php
$fee = 5;
$max = 5000;
$amountFee = $deal['Deal']['amount'] * ($fee / 100);
$amountFee = $amountFee > $max ? $max : $amountFee;
$resultAmount = $deal['Deal']['amount'] + $amountFee;
?>

<div class="alert alert-info">
    <strong>Info!</strong> Service fee: <?php echo $fee; ?>% (max <?php echo $max; ?> UAH)
</div>

<?php if ($userBalance < $resultAmount): ?>
    <div class="alert alert-warning">
        <strong>Warning!</strong> You do not have enough money to make this deal. Please make deposit.
    </div>
<?php endif ?>

<div class="reserve-money">
    <div class="row">
        <div class="col-md-6 text-right"><strong>Fee:</strong></div>
        <div class="col-md-6 text-left"><?php echo number_format($amountFee, 2);?> UAH</div>
    </div>
    <div class="row">
        <div class="col-md-6 text-right"><strong>Total amount:</strong></div>
        <div class="col-md-6 text-left"><?php echo number_format($resultAmount, 2);?> UAH</div>
    </div>
    <div class="buttons">
        <?php if ($userBalance < $resultAmount): ?>
            <div class="col-md-6 text-right">
                <a href="<?php echo $this->webroot; ?>finances/deposit" class="btn btn-success">
                    <i class="fa fa-dollar"></i>
                    Deposit
                </a>
            </div>
        <?php else: ?>
            <div class="col-md-6 text-right">
                <button class="btn btn-success status-change" data-role="accept">Reserve</button>
            </div>
        <?php endif; ?>
        <div class="col-md-6 text-left">
            <button class="btn btn-danger status-change" data-role="cancel">Cancel</button>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.status-change').click(function () {
            var status = $(this).data('role') == 'accept' ? 2 : 5;
            var url = "<?php echo $this->webroot;?>";
            var dealId = "<?php echo $deal['Deal']['id'] ?>";

            changeDealStatus(url, dealId, status);
        });
    });
</script>