<div class="container">
    <h1>Manage Arbiters</h1>
    <hr>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $item): ?>
            <tr>
                <td><?php echo $item['Deal']['name']; ?></td>
                <td><?php echo $item['Deal']['amount']; ?></td>
                <td>
                    <a title="View Detail" href="<?php echo $this->webroot;?>arbiter/deal_detail/<?php echo base64_encode($item['Deal']['id']) ?>">
                        <i class="fa fa-eye-slash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>