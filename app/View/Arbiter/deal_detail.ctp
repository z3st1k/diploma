<div class="container">
    <div class="row">
        <h2><?php echo $deal['Deal']['name']; ?> (#<?php echo $deal['Deal']['id'] ?>)</h2>
    </div>
    <div class="row center-boxes">
        <div class="col-md-3">
            <strong><i class="fa fa-user"></i> Customer</strong> <br>
            <label><?php echo $deal['CustomerUser']['username']; ?></label>
        </div>
        <div class="col-md-3">
            <strong><i class="fa fa-send"></i> Seller</strong> <br>
            <label><?php echo $deal['SellerUser']['username']; ?></label>
        </div>
        <div class="col-md-2">
            <strong><i class="fa fa-money"></i> Amount</strong> <br>
            <label><?php echo number_format($deal['Deal']['amount'], 2); ?> UAH</label>
        </div>
        <div class="col-md-4">
            <strong><i class="fa fa-file-text"></i> Description</strong> <br>
            <div id="deal-description">
                <?php echo $deal['Deal']['description']; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="board">
            <div class="board-inner">
                <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                    <?php echo $this->Deal->getHtmlStatusBar($deal['Deal']['statement']); ?>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="home">
                <?php if ($deal['Deal']['statement'] != 6) { ?>
                    <?php echo $this->Deal->getHtmlAction($deal, $Auth->user('id')); ?>
                <?php } elseif (!$deal['Deal']['arbiterId']){ ?>
                    <div class="alert alert-info">
                        <strong>Info!</strong> After entering to deal you will decide the outcome of that deal.
                    </div>
                    <div class="buttons">
                        <div class="col-md-12 text-center">
                            <a class="btn btn-success" href="<?php echo $this->webroot;?>arbiter/enter_to_deal/<?php echo base64_encode($deal['Deal']['id']) ?>">
                                <i class="fa fa-check"></i>
                                Accept
                            </a>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-info">
                        <strong>Info!</strong> Choose in whose favor to resolve the deal.
                    </div>
                    <div class="buttons">
                        <div class="col-md-6 text-right">
                            <button class="btn btn-warning status-change" data-value="1">
                                <i class="fa fa-user"></i>
                                Customer
                            </button>
                        </div>
                        <div class="col-md-6 text-left">
                            <button class="btn btn-warning status-change" data-value="2">
                                <i class="fa fa-send"></i>
                                Seller
                            </button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="messages">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" id="accordion">
                            <span class="glyphicon glyphicon-comment"></span> Messages
                        </div>
                        <div class="panel-body">
                            <ul class="chat">
                                <?php foreach ($messages as $message): ?>
                                    <li class="<?php echo $message['DealMessages']['senderId'] == $Auth->user('id') ? 'left' : 'right'; ?> clearfix">
                                        <span class="chat-img <?php echo $message['DealMessages']['senderId'] == $Auth->user('id') ? 'pull-left' : 'pull-right'; ?>">
                                            <img src="<?php echo $message['User']['avatar'] ? $this->webroot . $message['User']['avatar'] : "//placehold.it/200"; ?>" alt="User Avatar" class="img-circle"/>
                                        </span>
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                <strong class="<?php echo $message['DealMessages']['senderId'] == $Auth->user('id') ? '' : 'pull-right'; ?> primary-font"><?php echo $message['User']['surname'] . ' ' . $message['User']['name'] ?></strong>
                                                <small class="<?php echo $message['DealMessages']['senderId'] == $Auth->user('id') ? 'pull-right' : 'pull-left'; ?> text-muted">
                                                    <span class="glyphicon glyphicon-time"></span><?php echo date('Y-m-d H:i:s', $message['DealMessages']['date']); ?>
                                                </small>
                                            </div>
                                            <p>
                                                <?php echo $message['DealMessages']['message']; ?>
                                            </p>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-sm"
                                       placeholder="Type your message here..."/>
                                <span class="input-group-btn">
                            <button class="btn btn-warning btn-sm" id="btn-chat">
                                Send</button>
                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('.status-change').click(function () {
            var status = $(this).data('value') == 1 ? 7 : 8;
            var url = "<?php echo $this->webroot;?>";
            var dealId = "<?php echo $deal['Deal']['id'] ?>";

            changeDealStatus(url, dealId, status);
        });

        $('#myTab li a').click(function () {
            return false;
        });

        $("#btn-chat").click(function () {
            var message = $("#btn-input").val();

            $.ajax({
                url: "<?php echo $this->webroot;?>deals/ajaxMessage",
                data: {
                    dealId: <?php echo $deal['Deal']['id'] ?>,
                    message: message
                },
                type: "POST",
                success: function (response) {
                    var data = $.parseJSON(response);

                    if (data.code == 201) {
                        $.notify(data.msg, {
                            align: "left",
                            verticalAlign: "top",
                            type: "success",
                            icon: "check"
                        });

                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else if (data.code == 101) {
                        $.notify(data.msg, {
                            align: "left",
                            verticalAlign: "top",
                            type: "danger",
                            icon: "close"
                        });
                    }
                }
            });
        });
    });
</script>