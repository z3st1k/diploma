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
<div class="loginmodal-container container">
    <h1>Login to Your Account</h1><br>
    <?php echo $this->Form->create(array('id' => 'login-form')); ?>
        <?php echo $this->Form->input('username', array('type' => 'text', 'class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Username')); ?>
        <?php echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'div' => false, 'label' => false, 'placeholder' => 'Password')); ?>
        <?php echo $this->Form->submit('Sign In', array('class' => 'form-control loginmodal-submit', 'div' => false, 'label' => false)); ?>
    <?php echo $this->Form->end(); ?>
    <a href="#">Forgot Password</a>
</div>