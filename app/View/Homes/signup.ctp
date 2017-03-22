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
    <h1>Create Your Account</h1><br>
    <form id="signup-form">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" id="sign-password" placeholder="Password">
        <input type="password" name="confirmPassword" placeholder="Confirm Password">
        <input type="text" name="email" placeholder="Email">
        <input type="submit" name="register" class="login loginmodal-submit" value="Create Account">
    </form>
</div>

<script>
    $("#signup-form").submit(function(e) {
        e.preventDefault();
    }).validate({
        rules: {
            username: {
                required: true,
                alphanumeric: true,
                minlength: 4,
                maxlength: 20,
                remote: {
                    url: "<?php echo $this->webroot; ?>homes/checkUser",
                    type: "post"
                }
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 50
            },
            confirmPassword: {
                required: true,
                minlength: 6,
                maxlength: 50,
                equalTo: "#sign-password"
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "<?php echo $this->webroot; ?>homes/checkUser",
                    type: "post"
                }
            }
        },
        messages: {
            username: {
                alphanumeric: "Alphabets, numbers and underlines allowed",
                remote: "This name already registered"
            },
            confirmPassword: {
                equalTo: "Passwords don't match"
            },
            email: {
                remote: "This email already registered"
            }
        },
        submitHandler: function(form) {
            $.post(
                "<?php echo $this->webroot; ?>homes/signupAjaxSave",
                $(form).serializeObject(),
                function (response) {
                    if(response) {
                        $('.loginmodal-container').html("<h1 class='green'>Registration successfully!</h1>" +
                            "<p>Please check your email and confirm your account</p>");
                    }
                }
            );
        }
    });
</script>