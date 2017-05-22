<div class="container">
    <h1>Creating New Arbiter</h1>
    <hr>

    <form action="" method="POST" id="form">
        <div class="row form-group">
            <label class="col-lg-3 control-label">Username:</label>
            <div class="col-lg-8">
                <input name="username" class="form-control" type="text">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
                <input name="email" class="form-control" type="text">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-lg-3 control-label">Password:</label>
            <div class="col-lg-8">
                <input name="password" id="password" class="form-control" type="password">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-lg-3 control-label">Confirm Password:</label>
            <div class="col-lg-8">
                <input name="confirmPassword" class="form-control" type="password">
            </div>
        </div>
        <div class="row form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
        </div>
    </form>
</div>

<script>
    $("#form").validate({
        rules: {
            username: {
                required: true,
                alphanumeric: true,
                minlength: 4,
                maxlength: 20,
                remote: {
                    url: "<?php echo $this->webroot; ?>homes/checkUser/0",
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
                equalTo: "#password"
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "<?php echo $this->webroot; ?>homes/checkUser/0",
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
        }
    });
</script>