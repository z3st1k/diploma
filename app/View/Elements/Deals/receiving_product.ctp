<div class="alert alert-info">
    <strong>Info!</strong> After confirmation of receipt the product, deal will be closed and will be considered successful.
</div>
<div class="buttons">
    <div class="col-md-12 text-center">
        <button class="btn btn-success status-change" data-role="accept">Confirm</button>
    </div>
</div>

<script>
    $(function () {
        $('.status-change').click(function () {
            var status = 4;
            var url = "<?php echo $this->webroot;?>";
            var dealId = "<?php echo $deal['Deal']['id'] ?>";

            changeDealStatus(url, dealId, status);
        });
    });
</script>