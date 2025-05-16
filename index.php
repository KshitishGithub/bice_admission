<?php
session_start();
if (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 1) {
     header('location:personal_details.php');
} elseif (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 2) {
     header('location:address_details.php');
} elseif (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 3) {
     header('location:photo_signature.php');
} elseif (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 4) {
     header('location:preview.php');
} elseif (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 5) {
     header('location:payment.php');
} elseif (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 6) {
     header('location:print.php');
} else {
?>
     <!doctype html>
     <html lang="en">

     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
          <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
          <link rel="stylesheet" href="assets/css/style.css">
          <title>Admission System</title>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
          <link rel="shortcut icon" href="images/android-chrome-192x192.png" />

     </head>

     <body>
          <!-- Loading Spinner -->
          <div id="overlayer" class="container-fluid" style="display: none;">
               <div class="row">
                    <div id="loading">
                         <img src="assets/img/hug.gif">
                         <span>Loading....</span>
                    </div>
               </div>
          </div>

          <nav class="navbar navbar-expand-lg bg-light">
               <div class="container-fluid">
                    <a class="navbar-brand mr-auto" href="#">
                         <img src="assets/img/logo.png" alt="Bootstrap" width="80" height="40">
                    </a>
                    <ul class="navbar-nav mb-lg-0">
                         <li class="nav-item">
                              <a class="nav-link" href="#">
                                   Welcome <span class="fw-bold">Student</span>
                              </a>
                         </li>
                    </ul>
               </div>
          </nav>

          <section class="admission-sec">
               <div class="container mt-5">
                    <div class="row">
                         <div class="col-8 d-none d-md-block">
                              <img src="assets/img/bice.jpeg" class="img-fluid" alt="">
                         </div>
                         <div class="col-md-4">
                              <div class="card">

                                   <div class="card-header text-center">
                                        <h5>Applicant Login</h5>
                                   </div>

                                   <div class="card-body">
                                        <form id="signin">
                                             <div class="form-group">
                                                  <label for="">Email Address<span class="text-danger">*</span></label>
                                                  <input type="text" class="form-control" id="userid" name="email" placeholder="Email Address">
                                                  <small class="form-text text-danger"></small>
                                             </div>
                                             <div class="form-group mt-4">
                                                  <label for="">Password<span class="text-danger">*</span></label>
                                                  <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                                  <small class="form-text text-danger"></small>
                                             </div>
                                             <input type="submit" name="submit" id="submitBtn" value="Login" class="btn btn-primary mt-3 btn-sm">

                                        </form>
                                   </div>
                              </div>
                              <div class="card mt-2">
                                   <div class="cad-body text-center py-3">
                                        <!-- <p>Forgot Password? <a href="#">Click Here</a></p> -->
                                        <!-- <br> -->
                                        <p>New student ?</p>
                                        <a href="registration.php" class="btn btn-sm btn-primary">Registration</a>
                                        <br>
                                        <br>
                                        <p>Forget Password ?</p>
                                        <a href="reset_password.php" class="btn btn-sm btn-warning">Reset Password</a>
                                        <br>
                                        <!-- <br> -->
                                        <!-- <a href="account_activation.php" class="btn btn-sm btn-warning">Activate Your Account</a> -->
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </section>




          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
          <script src="assets/js/login.js"></script>
     </body>

     </html>

<?php } ?>