<div class="container">
    <div class="row">
        <h2><?php echo $deal['Deal']['name']; ?> (#<?php echo $deal['Deal']['id'] ?>)</h2>
    </div>
    <div class="row center-boxes">
        <div class="col-md-4">
            <strong><i class="fa fa-user"></i> Partner</strong> <br>
            <label><?php echo $deal['User']['username']; ?></label>
        </div>
        <div class="col-md-4">
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
                <?php echo $this->Deal->getHtmlAction($deal, $Auth->user('id')); ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $('#myTab li a').click(function () {
            return false;
        });
    });
</script>