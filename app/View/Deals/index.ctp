<div class="container">
    <h1>My Deals</h1>
    <hr>
    <div class="block">
        <a href="<?php echo $this->webroot . 'deals/create' ?>" class="btn btn-primary">Create New</a>
    </div>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#iseller">I seller</a></li>
        <li><a data-toggle="tab" href="#ibuyer">I buyer</a></li>
    </ul>

    <div class="tab-content">
        <div id="iseller" class="tab-pane fade in active">
            <table class="table .table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Partner</th>
                    <th>Statement</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($deals as $deal): ?>
                    <?php if ($deal['Deal']['sellerId'] == $Auth->user('id')): ?>
                        <tr>
                            <td><?php echo $deal['Deal']['id']; ?></td>
                            <td><?php echo $deal['Deal']['name']; ?></td>
                            <td><?php echo $deal['User']['username']; ?></td>
                            <td><?php echo $deal['Deal']['statement']; ?></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div id="ibuyer" class="tab-pane fade">
            <table class="table .table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Partner</th>
                    <th>Statement</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($deals as $deal): ?>
                    <?php if ($deal['Deal']['customerId'] == $Auth->user('id')): ?>
                        <tr>
                            <td><?php echo $deal['Deal']['id']; ?></td>
                            <td><?php echo $deal['Deal']['name']; ?></td>
                            <td><?php echo $deal['User']['username']; ?></td>
                            <td><?php echo $deal['Deal']['statement']; ?></td>
                            <td></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $(".nav-tabs a").click(function(){
            $(this).tab('show');
        });
    });
</script>