<div class="container">
    <h1>Edit Profile</h1>
    <hr>
    <div class="row">
        <form class="form-horizontal" role="form" method="post" id="profileForm" enctype="multipart/form-data">
            <!-- left column -->
            <div class="col-md-3">
                <div class="text-center">
                    <div class="avatar">
                        <img src="<?php echo $user['User']['avatar'] ? $this->webroot . $user['User']['avatar'] : "//placehold.it/200" ; ?>" class="avatar" alt="avatar" id="avatar">
                    </div>
                    <h6>Upload a different photo...</h6>
                    <input type="file" name="file" class="form-control" id="profileImage">
                </div>
            </div>

            <!-- edit form column -->
            <div class="col-md-9 personal-info">
                <h3>Personal info</h3>
                <input type="hidden" name="id" value="<?php echo $user['User']['id']; ?>">
                <div class="form-group">
                    <label class="col-lg-3 control-label">First name:</label>
                    <div class="col-lg-8">
                        <input name="name" class="form-control" type="text" value="<?php echo $user['User']['name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Last name:</label>
                    <div class="col-lg-8">
                        <input name="surname"  class="form-control" type="text" value="<?php echo $user['User']['surname']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input name="email"  class="form-control" type="text" value="<?php echo $user['User']['email']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">New password:</label>
                    <div class="col-md-8">
                        <input name="password" id="password" class="form-control" type="password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm password:</label>
                    <div class="col-md-8">
                        <input name="confirmPassword" class="form-control" type="password" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input type="submit" class="btn btn-primary" value="Save Changes">
                        <span></span>
                        <input type="reset" class="btn btn-default" value="Cancel">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<hr>

<script>
    $("#profileForm").validate({
        rules: {
            name: {
                required: true,
                lettersonly: true,
                minlength: 1,
            },
            surname: {
                required: true,
                lettersonly: true,
                minlength: 1,
            },
            password: {
                minlength: 6,
                maxlength: 50
            },
            confirmPassword: {
                minlength: 6,
                maxlength: 50,
                equalTo: "#password"
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
                remote: "This email already used"
            }
        }
    });

    $(function () {
        $("#profileImage").change(function () {
            var file = this.files[0];
            var imagefile = file.type;
            var match = ["image/jpeg", "image/png", "image/jpg"];
            if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                $.notify("Please select a valid image file (jpeg, jpg and png)", {
                    align: "left",
                    verticalAlign: "top",
                    type: "info",
                    icon: "exclamation"
                });
                return false;
            } else {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#avatar').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

    });

</script>