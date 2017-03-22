<style>
    .confirm-content .fa-check{
        color: #02ad02;
        font-size: 128px;
    }

    .confirm-content p{
        font-size: 18px;
    }

    .confirm-content {
        text-align: center;
        margin-top: 100px;
    }
</style>
<nav class="navbar navbar-custom-black navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse"><i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="<?php echo $this->webroot; ?>">
                <i class="fa fa-thumbs-up"></i> Gooddeal
            </a>
        </div>
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <li class="hidden">
                    <a href="<?php echo $this->webroot; ?>"></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container confirm-content">
    <p><i class="fa fa-check" aria-hidden="true"></i></p>
    <h1>Your account is confirmed successfully!</h1>
    <p>You will be redirected to login page after few seconds..</p>
</div>

<script>
    (function() {

        function redirect() {
            location.href = "<?php echo $this->webroot; ?>homes/login";
        }

        return setTimeout(redirect, 2000);
    }());
</script>