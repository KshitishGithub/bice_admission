$(document).ready(function() {
    //!! Log in function ...........
    $('#signin').submit(function(e) {
        e.preventDefault();
        var userid = $("#userid").val();
        var password = $("#password").val();
        if (userid !== "" && password !== "") {
            $.ajax({
                url: "php_files/login.php",
                type: "POST",
                data: $('#signin').serialize(),
                beforeSend: function() {
                    $('#overlayer').show();
                },
                success: function(data) {
                    console.log(data);
                    var result = jQuery.parseJSON(data);
                    if (result.status == 'error') {
                        var msg = result.msg;
                        alert(msg);
                    } else {
                        $("#signin").trigger('reset');
                        var msg = result.msg;
                        alert(msg);
                        window.location = 'index.php';
                    }
                    $('#overlayer').hide();
                }
            })
        } else {
            alert("All fields are required.")
        }
    })



})