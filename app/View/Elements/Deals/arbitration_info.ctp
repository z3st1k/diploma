<div class="alert alert-warning alert-buttons">
    <div>
        <span>
            <strong>Info!</strong> If you are having problems, be sure to apply to arbitration.
        </span>
        <button class="right btn btn-warning" id="arbitration">Call arbitration</button>
    </div>
</div>

<script>
    $(function () {
        $('#arbitration').click(function () {

            bootbox.confirm({
                message: "Are you sure do that?",
                buttons: {
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    },
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    }
                },
                callback: function (result) {
                    if (result == true) {
                        var status = 6;
                        var url = "<?php echo $this->webroot;?>";
                        var dealId = "<?php echo $deal['Deal']['id'] ?>";

                        changeDealStatus(url, dealId, status);
                    }
                }
            });
        });
    });
</script>