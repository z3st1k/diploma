<div class="alert alert-info">
    <strong>Info!</strong> Do you want to accept deal from <strong><?php echo $Deal['User']['username']; ?></strong>  ?
</div>
<div class="buttons">
    <div class="col-md-6 text-right">
        <button class="btn btn-success status-change" data-role="accept">Accept</button>
    </div>
    <div class="col-md-6 text-left">
        <button class="btn btn-danger status-change" data-role="cancel">Cancel</button>
    </div>
</div>

<script>
    $(function () {
        $('.status-change').click(function () {
            var status = $(this).data('role') == 'accept' ? 1 : 5;
            var url = "<?php echo $this->webroot;?>";
            var dealId = "<?php echo $deal['Deal']['id'] ?>";

            changeDealStatus(url, dealId, status);
        });
    });
</script>