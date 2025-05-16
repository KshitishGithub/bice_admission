$(document).ready(function() {

    //! Reset Password 
    $("#ResetPass").on("submit", function(e) {
        e.preventDefault();
        $(".alert").hide();
        var email = $("#email").val();
        var mobile = $("#mobile").val();

        if (email == "") {
            $(".alert").css('display', 'block').addClass('show').text('Email is required.');
        } else if (mobile == "") {
            $(".alert").css('display', 'block').addClass('show').text('Mobile number is required.');
        } else {
            var data = new FormData(this)
            $.ajax({
                url: "php_files/ResetPassword.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#overlayer').show();
                },
                success: function(data) {
                    $('#overlayer').hide();
                    var result = jQuery.parseJSON(data);
                    if (result.status == 'error') {
                        var msg = result.msg;
                        $(".alert").css('display', 'block').addClass('show').text(msg);
                    } else {
                        window.location.href = "reset_password.php";
                    }
                }
            });
        }
    });

    //! Sens OTP
    $("#GetOtp").on("submit", function(e) {
        e.preventDefault();
        $(".alert").hide();

        var data = new FormData(this)
        $.ajax({
            url: "php_files/ResetPassword.php",
            type: "POST",
            data: data,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#overlayer').show();
            },
            success: function(data) {
                $('#overlayer').hide();
                var result = jQuery.parseJSON(data);
                if (result.status == 'error') {
                    var msg = result.msg;
                    $(".alert").css('display', 'block').addClass('show').text(msg);
                } else {
                    window.location.href = "reset_password.php";
                }
            }
        });
    });


    //!! Show Hide Password ..........
    var is_show = true;
    $("#showPass").on("click", function() {
        if (is_show) {
            $("#showPass").removeClass("far fa-eye").addClass("far fa-eye-slash");
            $("#password").attr("type", "text");
            is_show = false;
        } else {
            $("#showPass").removeClass("far fa-eye-slash").addClass("far fa-eye");
            $("#password").attr("type", "password");
            is_show = true;
        }
    })

    //! Validate OTP
    $("#ValidateOtp").on("submit", function(e) {
        e.preventDefault();
        $(".alert").hide();

        var data = new FormData(this)
        $.ajax({
            url: "php_files/ResetPassword.php",
            type: "POST",
            data: data,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#overlayer').show();
            },
            success: function(data) {
                $('#overlayer').hide();
                var result = jQuery.parseJSON(data);
                if (result.status == 'error') {
                    var msg = result.msg;
                    $(".alert").css('display', 'block').addClass('show').text(msg);
                } else {
                    window.location.href = "reset_password.php";
                }
            }
        });
    });

    //! Change Password....

    $("#ChangePassword").on("submit", function(e) {
        e.preventDefault();
        $(".alert").hide();
        var password = $("#password").val();
        var c_password = $("#c_password").val();
        if (password || c_password !== "") {
            if (password == c_password) {
                var data = new FormData(this)
                $.ajax({
                    url: "php_files/ResetPassword.php",
                    type: "POST",
                    data: data,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#overlayer').show();
                    },
                    success: function(data) {
                        $('#overlayer').hide();
                        var result = jQuery.parseJSON(data);
                        if (result.status == 'error') {
                            var msg = result.msg;
                            $(".alert").css('display', 'block').addClass('show').text(msg);
                        } else {
                            var msg = result.msg;
                            alert(msg);
                            window.location.href = "reset_password.php";
                        }
                    }
                });
            } else {
                $(".alert").css('display', 'block').addClass('show').text("Confirm password does not matched.");
            }
        } else {
            $(".alert").css('display', 'block').addClass('show').text("All fields are required.");
        }
    });




});