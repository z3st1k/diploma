<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->fetch('meta');

    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('font-awesome.min');
    echo $this->Html->css('grayscale.min');
    echo $this->Html->css('full');
    echo $this->Html->css('notify');
    ?>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <?php
    echo $this->Html->script('jquery-3.1.1');
    echo $this->Html->script('bootstrap.min');
    echo $this->Html->script('jquery.validate.min');
    echo $this->Html->script('jquery.additional');
    echo $this->Html->script('jquery.additional.validate');
    echo $this->Html->script('notify');
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

</head>
<body>
    <?php echo $this->fetch('content'); ?>
    <?php
    echo $this->Html->script('grayscale');
    ?>

    <!--    Flash messages-->
    <?php
    $flashMessage = $this->Flash->render();
    if (!empty($flashMessage)):
        $flashData = json_decode($flashMessage, true);
        switch ($flashData['code']) {
            case '101':
                $flashData['type'] = 'danger';
                $flashData['icon'] = 'close';
                break;
            case '201':
                $flashData['type'] = 'success';
                $flashData['icon'] = 'check';
                break;
            case '301':
                $flashData['type'] = 'info';
                $flashData['icon'] = 'exclamation';
                break;
        }
    ?>
    <script>
        $(document).ready(function () {
            $.notify("<?php echo $flashData['message']; ?>", {
                align: "left",
                verticalAlign: "top",
                type: "<?php echo $flashData['type']; ?>",
                icon: "<?php echo $flashData['icon']; ?>"
            });
        });
    </script>
    <?php endif; ?>

</body>
</html>
