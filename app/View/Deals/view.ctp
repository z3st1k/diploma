<div class="container">
    <div class="row">
        <div class="board">
            <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
            <div class="board-inner">
                <ul class="nav nav-tabs" id="myTab">
                    <div class="liner"></div>
                    <?php echo $this->Deal->getHtmlStatusBar($deal['Deal']['statement']); ?>
                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade in active" id="home">
                asdas
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