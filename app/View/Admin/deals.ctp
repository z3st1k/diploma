<div class="container">
    <h1>Deals List</h1>
    <hr>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Amount</th>
            <th>Statement</th>
            <th>Date Create</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $deal): ?>
            <tr>
                <td class="col-md-1"><?php echo $deal['Deal']['id']; ?></td>
                <td class="col-md-2"><?php echo $deal['Deal']['name']; ?></td>
                <td class="col-md-2"><?php echo $deal['Deal']['amount']; ?></td>
                <td class="col-md-3"><?php echo $this->Deal->getHtmlStatus($deal['Deal']['statement']); ?></td>
                <td class="col-md-2"><?php echo date('Y-m-d h:i:s', $deal['Deal']['dateCreate']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>