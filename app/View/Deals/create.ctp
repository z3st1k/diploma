<div class="container">
    <h1>Creating New Deal</h1>
    <hr>
    <div class="row">
        <div class="alert alert-info">
            <strong>Info!</strong> After creating the deal, you will be the seller.
        </div>

        <form class="form-horizontal" role="form" method="post" id="profileForm" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-lg-3 control-label">Name:</label>
                <div class="col-lg-6">
                    <input name="name" class="form-control" type="text">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Partner:</label>
                <div class="col-lg-6">
                    <select name="partnerId" class="selectpicker" id="" data-live-search="true">
                        <option></option>
                        <?php foreach ($users as $user): ?>
                            <option value="<?php echo $user['User']['id']; ?>"><?php echo $user['User']['username']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Amount:</label>
                <div class="col-lg-6">
                    <input name="amount" class="form-control" type="text" value="0">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Description:</label>
                <div class="col-lg-6">
                    <textarea name="description" class="form-control"></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-9 text-center">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $("#profileForm").validate({
        rules: {
            name: {
                required: true
            },
            partnerId: {
                required: true
            },
            amount: {
                required: true,
                digits: true,
                min: 100
            },
            description: {
                maxlength: 500
            }
        }
    });
</script>