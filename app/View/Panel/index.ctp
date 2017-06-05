<style>
    div.media {
        cursor: pointer;
    }
</style>

<div class="container">
    <h1 class="text-center">Deals Summary</h1>
    <div id="completed-chart" class="donut-size col-md-3">
        <div class="pie-wrapper">
        <span class="label">
          <span class="num"><?php echo $data['completed']; ?></span><span class="smaller">%</span>
        </span>
            <div class="pie">
                <div class="left-side half-circle completed"></div>
                <div class="right-side half-circle"></div>
            </div>
            <div class="shadow"></div>
        </div>
        <h3 class="text-center">Completed</h3>
    </div>

    <div id="progress-chart" class="donut-size col-md-3">
        <div class="pie-wrapper">
        <span class="label">
          <span class="num"><?php echo $data['progress']; ?></span><span class="smaller">%</span>
        </span>
            <div class="pie">
                <div class="left-side half-circle inprogress"></div>
                <div class="right-side half-circle"></div>
            </div>
            <div class="shadow"></div>
        </div>
        <h3 class="text-center">In progress</h3>
    </div>

    <div id="failed-chart" class="donut-size col-md-3">
        <div class="pie-wrapper">
        <span class="label">
          <span class="num"><?php echo $data['failed']; ?></span><span class="smaller">%</span>
        </span>
            <div class="pie">
                <div class="left-side half-circle failed"></div>
                <div class="right-side half-circle"></div>
            </div>
            <div class="shadow"></div>
        </div>
        <h3 class="text-center">Failed</h3>
    </div>

    <div id="arbitration-chart" class="donut-size col-md-3">
        <div class="pie-wrapper">
        <span class="label">
          <span class="num"><?php echo $data['arbitration']; ?></span><span class="smaller">%</span>
        </span>
            <div class="pie">
                <div class="left-side half-circle arbitration"></div>
                <div class="right-side half-circle"></div>
            </div>
            <div class="shadow"></div>
        </div>
        <h3 class="text-center">In arbitration</h3>
    </div>

    <h1 class="text-center">Last Messages</h1>

    <?php if (empty($messages)): ?>
        <h3 class="text-warning">No Data Found</h3>
    <?php else: ?>
        <div class="messages">
            <ul class="media-list">
            <?php foreach ($messages as $message): ?>
                <li class="media">

                    <div class="media-body">

                        <div class="media" data-href="<?php echo $this->webroot ?>deals/view/<?php echo base64_encode($message['DealMessages']['dealId']) ?>">
                            <a class="pull-left chat-img" href="javascript:void(0)">
                                <img class="media-object img-circle " src="<?php echo $message['User']['avatar'] ? $this->webroot . $message['User']['avatar'] : "//placehold.it/200"; ?>" />
                            </a>
                            <div class="media-body" >
                                <?php echo $message['DealMessages']['message'] ?>
                                <br />
                                <small class="text-muted"><?php echo $message['User']['name'] . ' ' . $message['User']['surname'] ?> | <?php echo date('Y-m-d H:i:s', $message['DealMessages']['date']); ?></small>
                                <hr />
                            </div>
                        </div>

                    </div>
                </li>
            <?php endforeach;?>
            </ul>
        </div>
    <?php endif; ?>
</div>

<script>
    updateDonutChart('#completed-chart', <?php echo $data['total'] > 0 ? round($data['completed'] / $data['total'], 2) * 100 : 0; ?>, true);
    updateDonutChart('#progress-chart', <?php echo $data['total'] > 0 ? round($data['progress'] / $data['total'], 2) * 100 : 0; ?>, true);
    updateDonutChart('#failed-chart', <?php echo $data['total'] > 0 ? round($data['failed'] / $data['total'], 2) * 100 : 0; ?>, true);
    updateDonutChart('#arbitration-chart', <?php echo $data['total'] > 0 ? round($data['arbitration'] / $data['total'], 2) * 100 : 0; ?>, true);

    $(function () {
        $("div.media").click(function () {
            window.open($(this).data('href'), '_blank');
        });
    });
</script>