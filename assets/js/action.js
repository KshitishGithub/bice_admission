$(document).ready(function() {
    //! Sign Out Function....
    $("#logout").click(function(e) {
        e.preventDefault();
        swal({
                title: "Are you sure want to sign out ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "php_files/logout.php",
                        beforeSend: function() {
                            $('#overlayer').show();
                        },
                        success: function(data) {
                            if (data == "success") {
                                swal("Good job!", "Log Out Succssfully .", "success")
                                    .then((value) => {
                                        if (value = true) {
                                            window.location.href = "index.php";
                                        }
                                    });
                            } else {
                                swal("Oops!", "Log Out Failed .", "error");
                            }
                        }
                    })
                }
            });
    });

    //! Personal Details......
    $('#personal_details').on('submit', function(e) {
        e.preventDefault();

        if ($("#gander").find(":selected").val() == "") {
            toastr.error('Gander is required.');
        } else if ($("#category").find(":selected").val() == "") {
            toastr.error('Category is required.');
        } else if ($("#religion").find(":selected").val() == "") {
            toastr.error('Religion is required.');
        } else if ($("#course").find(":selected").val() == "") {
            toastr.error('Course is required.');
        } else if ($("#batch").find(":selected").val() == "") {
            toastr.error('Batch is required.');
        } else if ($("#last_qualification").val() == "") {
            toastr.error('Last qualification is required.');
        } else if ($("#passing_year").val() == "") {
            toastr.error('Passing year is required.');
        } else if ($("#aadhar").val() == "") {
            toastr.error('Aadhar is required.');
        } else {
            var data = new FormData(this);
            $.ajax({
                url: "php_files/personal_details.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#overlayer').show();
                },
                success: function(data) {
                    $('#overlayer').hide();
                    // console.log(data);
                    var result = jQuery.parseJSON(data);
                    if (result.status == 'error') {
                        var msg = result.msg;
                        toastr.error(msg);
                    } else {
                        window.location.href = "address_details.php";
                    }
                }
            });
        }
    })


    //! Comunication Functions.....
    $("#comunication_form").on('submit', function(e) {
            e.preventDefault();
            if ($("#vill").val() == "") {
                toastr.error('Village is required.');
            } else if ($("#po").val() == "") {
                toastr.error('Post Office is required.');
            } else if ($("#ps").val() == "") {
                toastr.error('Police Station is required.');
            } else if ($("#pin").val() == "") {
                toastr.error('PIN is required.');
            } else if ($("#dist").val() == "") {
                toastr.error('District is required.');
            } else if ($("#state").val() == "") {
                toastr.error('State is required.');
            } else if ($("#country").val() == "") {
                toastr.error('Country is required.');
            } else {
                var data = new FormData(this);
                $.ajax({
                    url: "php_files/comunication_details.php",
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
                            toastr.error(msg);
                        } else {
                            window.location.href = "photo_signature.php";
                        }
                    }
                });
            }
        })
        //! Photo and signature ......
    $("#PhotoSignature").on("submit", function(e) {
            e.preventDefault();
            if ($("#photo").val() == "") {
                toastr.error('Photo is required.');
            } else if ($("#sig").val() == "") {
                toastr.error('Signature is required.');
            } else {
                var data = new FormData(this);
                $.ajax({
                    url: "php_files/photo_signature.php",
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
                            toastr.error(msg);
                        } else {
                            $("#PhotoSignature").trigger('reset');
                            window.location.href = "preview.php";
                        }
                    }
                });
            }
        })
        //! Update Photo And Signature.......
    $("#UpdatePhotoSignature").on("submit", function(e) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: "php_files/update_photo_signature.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#overlayer').show();
                },
                success: function(data) {
                    // console.log(data);
                    $('#overlayer').hide();
                    var result = jQuery.parseJSON(data);
                    if (result.status == 'error') {
                        var msg = result.msg;
                        toastr.error(msg);
                    } else {
                        $("#PhotoSignature").trigger('reset');
                        window.location.href = "preview.php";
                    }
                }
            });
        })
        //! Save Preview 
    $('#SavePreview').on('click', function() {

        if ($(".myCheckBox").prop('checked')) {
            var data = 'submit_preview';
            $.ajax({
                url: "php_files/save_preview.php",
                type: "POST",
                data: { data: data },
                beforeSend: function() {
                    $('#overlayer').show();
                },
                success: function(data) {
                    $('#overlayer').hide();
                    var result = jQuery.parseJSON(data);
                    if (result.status == 'error') {
                        var msg = result.msg;
                        toastr.error(msg);
                    } else {
                        var code = result.code;
                        if (code == '5') {
                            window.location.href = "payment.php";
                        } else if (code == '6') {
                            window.location.href = "print.php";
                        }
                    }
                }
            });
        } else {
            toastr.error("Please check the checkbox");
        }
    });

    //! Change Password
    $("#changepass").submit(function(e) {
        e.preventDefault();
        var oldpass = $("#oldpass").val();
        var newpass = $("#newpass").val();
        var cnewpass = $("#cnewpass").val();
        if (oldpass !== "" && newpass !== "" && cnewpass !== "") {
            if (newpass == cnewpass) {
                if (oldpass !== cnewpass) {
                    $.ajax({
                        url: "php_files/changepass.php",
                        type: "POST",
                        data: $('#changepass').serialize(),
                        beforeSend: function() {
                            $('#overlayer').show();
                        },
                        success: function(data) {
                            // console.log(data);
                            $('#overlayer').hide();
                            var result = jQuery.parseJSON(data);
                            if (result.status == 'error') {
                                var msg = result.msg;
                                toastr.error(msg);
                            } else {
                                $("#changepass").trigger('reset');
                                var msg = result.msg;
                                alert(msg);
                                $.ajax({
                                    url: "php_files/logout.php",
                                    beforeSend: function() {
                                        $('#overlayer').show();
                                    },
                                    success: function(data) {
                                        if (data == "success") {
                                            toastr.error('You are loged out.');
                                            window.location.href = "index.php";
                                        }
                                    }
                                })
                            }
                        }
                    })
                } else {
                    toastr.error("Old password and new password must have changed.");
                }
            } else {
                toastr.error("Confirm Password does not matched.");
            }
        } else {
            toastr.error("All Fields are required.");
        }

    });

    //! Print Form

    jQuery(function($) {
        'use strict';
        $(document).on('click', '#printBtn', function() {
            //Print printSec with custom options
            $("#printSec").print({
                //Use Global styles
                globalStyles: true,
                //Add link with attrbute media=print
                mediaPrint: true,
                //Custom stylesheet
                stylesheet: "http://fonts.googleapis.com/css?family=Inconsolata",
                //Print in a hidden iframe
                iframe: false,
                //Don't print this
                noPrintSelector: '#printBtn',
            });
        });
    });


});