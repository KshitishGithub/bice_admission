// $(function() {
//     var Toast = Swal.mixin({
//         toast: true,
//         position: 'top',
//         showConfirmButton: false,
//         timer: 3000
//     });

$(document).ready(function() {
    $("#reg_form").on("submit", function(e) {
        e.preventDefault();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        var father_name = $("#father_name").val();
        var spouse_name = $("#spouse_name").val();
        var mother_name = $("#mother_name").val();
        var mobile = $("#mobile").val();
        var gurdain_mobile = $("#gurdain_mobile").val();
        var email = $("#email").val();
        var dob = $("#dob").val();
        var newpass = $("#newpass").val();
        var cnewpass = $("#cnewpass").val();

        if (fname == "") {
            $(".alert").css('display', 'block').addClass('show').text('First name is required.');
        } else if (lname == "") {
            $(".alert").css('display', 'block').addClass('show').text('Last name is required.');
        // } else if (father_name == "") {
        //     $(".alert").css('display', 'block').addClass('show').text('Fathers name is required.');
        } else if (mother_name == "") {
            $(".alert").css('display', 'block').addClass('show').text('Mother name is required.');
        } else if (mobile == "") {
            $(".alert").css('display', 'block').addClass('show').text('Mobile number is required.');
        } else if (gurdain_mobile == "") {
            $(".alert").css('display', 'block').addClass('show').text('Gurdain Mobile number is required.');
        } else if (email == "") {
            $(".alert").css('display', 'block').addClass('show').text('Email id is required.');
        } else if (dob == "") {
            $(".alert").css('display', 'block').addClass('show').text('Date of birth is required.');
        } else if (newpass == "") {
            $(".alert").css('display', 'block').addClass('show').text('Password is required.');
        } else if (cnewpass == "") {
            $(".alert").css('display', 'block').addClass('show').text('Confirm password is required.');
        } else {
            if (newpass == cnewpass) {
                var data = new FormData(this);

                //! Modal Prevew .....

                $("#modal1").modal('show');
                $('#name').html(" " + fname + ' ' + lname);
                $('#f_name').html(" " + father_name);
                $('#s_name').html(" " + spouse_name);
                $('#m_name').html(" " + mother_name);
                $('#m_number').html(" " + mobile);
                $('#g_mobile').html(" " + gurdain_mobile);
                $('#e_mail').html(" " + email);
                $('#d_o_b').html(" " + dob);

                $("#save-btn").click(function() {
                    $("#modal1").modal('hide');

                    //! Send AJAX data....
                    $.ajax({
                        url: "php_files/registration.php",
                        type: "POST",
                        data: data,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('#overlayer').show();
                        },
                        success: function(data) {
                            var result = jQuery.parseJSON(data);
                            if (result.status == 'error') {
                                var msg = result.msg;
                                $(".alert").css('display', 'block').addClass('show').text(msg);
                            } else {
                                $("#reg_form").trigger('reset');
                                var msg = result.msg;
                                alert(msg);
                                window.location = 'index.php';
                            }
                            $('#overlayer').hide();
                        }
                    });
                });
            } else {
                $(".alert").css('display', 'block').addClass('show').text('Confirm password is not matched.');
            }
        }
    });
});







// });