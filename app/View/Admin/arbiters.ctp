<div class="container">
    <h1>Manage Arbiters</h1>
    <hr>
    <div class="block">
        <a href="<?php echo $this->webroot . 'admin/create_arbiter' ?>" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            Create New
        </a>
    </div>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $item): ?>
            <tr>
                <td><?php echo $item['User']['username']; ?></td>
                <td><?php echo $item['User']['active'] ? 'true' : 'false'; ?></td>
                <td>
                    <?php if ($item['User']['active']): ?>
                        <a title="Deactivate" href="<?php echo $this->webroot;?>admin/active_arbiter/<?php echo base64_encode($item['User']['id']) ?>/0">
                            <i class="fa fa-check-circle"></i>
                        </a>
                    <?php else: ?>
                        <a title="Activate" href="<?php echo $this->webroot;?>admin/active_arbiter/<?php echo base64_encode($item['User']['id']) ?>/1">
                            <i class="fa fa-check-circle-o"></i>
                        </a>
                    <?php endif; ?>
                    <a title="Delete" href="<?php echo $this->webroot;?>admin/remove_arbiter/<?php echo base64_encode($item['User']['id']) ?>">
                        <i class="fa fa-close"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>