<div class="alert alert-info">
    <strong>Info!</strong> Confirm that you sent the product.
</div>
<div class="buttons">
    <div class="col-md-12 text-center">
        <button class="btn btn-success status-change" data-role="accept">I sent product</button>
    </div>
</div>

<script>
    $(function () {
        $('.status-change').click(function () {
            var status = 3;
            var url = "<?php echo $this->webroot;?>";
            var dealId = "<?php echo $deal['Deal']['id'] ?>";

            changeDealStatus(url, dealId, status);
        });
    });
</script>