<div class="container">
    <h1>My Deals</h1>
    <hr>
    <div class="block">
        <a href="<?php echo $this->webroot . 'deals/create' ?>" class="btn btn-primary">
            <i class="fa fa-plus"></i>
            Create New
        </a>
    </div>

    <div class="panel panel-default panel-fade">
        <div class="panel-heading">
            <span class="panel-title">
                <div class="pull-left">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#iseller"><i class="fa fa-send"></i> I seller</a></li>
                        <li><a data-toggle="tab" href="#ibuyer"><i class="fa fa-user"></i> I buyer</a></li>
                    </ul>
                </div>
                <div class="btn-group pull-right">
                    <div class="btn-group">
                        <a href="#" class="btn dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </a>
				        <ul class="dropdown-menu pull-right">
                            <li><a href="#">Action 1</a></li>
                            <li><a href="#">Action 2</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Another Action</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </span>
        </div>
        <div class="panel-body">
            <div class="tab-content">
                <div id="iseller" class="tab-pane fade in active">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Partner</th>
                            <th>Statement</th>
                            <th>Date Create</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($deals as $deal): ?>
                            <?php if ($deal['Deal']['sellerId'] == $Auth->user('id')): ?>
                                <tr>
                                    <td class="col-md-1"><?php echo $deal['Deal']['id']; ?></td>
                                    <td class="col-md-2"><?php echo $deal['Deal']['name']; ?></td>
                                    <td class="col-md-2"><?php echo $deal['User']['username']; ?></td>
                                    <td class="col-md-3"><?php echo $this->Deal->getHtmlStatus($deal['Deal']['statement']); ?></td>
                                    <td class="col-md-2"><?php echo date('Y-m-d h:i:s', $deal['Deal']['dateCreate']); ?></td>
                                    <td class="col-md-1">
                                        <a href="<?php echo $this->webroot; ?>deals/view/<?php echo base64_encode($deal['Deal']['id']); ?>" class="btn btn-padding">
                                            <i class="fa fa-eye"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div id="ibuyer" class="tab-pane fade">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Partner</th>
                            <th>Statement</th>
                            <th>Date Create</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($deals as $deal): ?>
                            <?php if ($deal['Deal']['customerId'] == $Auth->user('id')): ?>
                                <tr>
                                    <td class="col-md-1"><?php echo $deal['Deal']['id']; ?></td>
                                    <td class="col-md-2"><?php echo $deal['Deal']['name']; ?></td>
                                    <td class="col-md-2"><?php echo $deal['User']['username']; ?></td>
                                    <td class="col-md-3"><?php echo $this->Deal->getHtmlStatus($deal['Deal']['statement']); ?></td>
                                    <td class="col-md-2"><?php echo date('Y-m-d h:i:s', $deal['Deal']['dateCreate']); ?></td>
                                    <td class="col-md-1">
                                        <a href="<?php echo $this->webroot; ?>deals/view/<?php echo base64_encode($deal['Deal']['id']); ?>" class="btn">
                                            <i class="fa fa-eye"></i>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
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