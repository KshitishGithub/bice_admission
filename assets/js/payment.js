 $(document).ready(function() {

     //! Online or offline Check
     $(document).on('change', '#payment_option', function(e) {
         var data = $(this).val();
         if (data == 'offline') {
             $('#pay_now').text('Next').removeClass('pay_button').addClass('NextBtn');
         } else {
             $('#pay_now').text('Pay Now').addClass('pay_button').removeClass('NextBtn');
         }
     });


     //! offline......
     $(document).on('click', '.NextBtn', function(e) {
         e.preventDefault();
         var name = jQuery('#name').text();
         var amt = '3000';
         data = {98
             name: name,
             amt: amt,
             next: 'next'
         }
         $.ajax({
             url: 'php_files/payment_process.php',
             type: "POST",
             data: data,
             beforeSend: function() {
                 $('#overlayer').show();
             },
             success: function(data) {
                 //  console.log(data);
                 $('#overlayer').hide();
                 var result = jQuery.parseJSON(data);
                 if (result.status == 'error') {
                     var msg = result.msg;
                     toastr.error(msg);
                 } else {
                     window.location.href = "print.php";
                 }
             }
         });
     })


     //! Pay Now.......
     $(document).on('click', '.pay_button', function(e) {
         e.preventDefault();
         var name = jQuery('#name').text();
         var amt = '3000';
         data = {
             name: name,
             amt: amt
         }
         jQuery.ajax({
             type: 'post',
             url: 'php_files/payment_process.php',
             data: data,
             success: function(result) {
                 var options = {
                     // "key": "rzp_live_zhkPtR4XiN0a20",
                     "key": "rzp_test_LzIrcpJhdUiUpR",
                     "amount": amt * 100,
                     "currency": "INR",
                     "name": "BiCE Institute",
                     "description": "Monthly Fees",
                     "image": "https://biceindia.in/assets/img/logo1.png",
                     "handler": function(response) {
                         //  console.log(JSON.stringify(response));
                         jQuery.ajax({
                             type: 'POST',
                             url: "php_files/payment_process.php",
                             data: "payment_id=" + response.razorpay_payment_id,
                             success: function(data) {
                                 //  console.log(data);
                                 $('#overlayer').hide();
                                 var result = jQuery.parseJSON(data);
                                 if (result.status == 'error') {
                                     var msg = result.msg;
                                     toastr.error(msg);
                                 } else {
                                     alert("Payment successful.");
                                     window.location.href = "print.php";
                                 }
                             }
                         });
                     }
                 };
                 var rzp1 = new Razorpay(options);
                 rzp1.open();
             }
         });
     })

















 })