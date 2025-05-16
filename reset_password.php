<!doctype html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
     <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
     <!-- Font Awesome Icons -->
     <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
     <!-- fontAwesome  -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
     <title>Registraion</title>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
     <link rel="shortcut icon" href="images/android-chrome-192x192.png" />
     <link rel="stylesheet" href="assets/css/style.css">
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
     <?php
     session_start();
     // echo "<pre>";
     // print_r($_SESSION);
     ?>
     <div class="container mt-5">
          <div class="row mx-auto">
               <div class="mt-3">
                    <div class="offset-md-3 offset-sm-2 col-md-6 col-sm-8">
                         <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
                              <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                         </div>
                         <div class="card card-outline card-secondary">
                              <div class="card-header text-center">
                                   <span><b>Password Reset</b></span>
                              </div>
                              <div class="card-body">
                                   <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
                                   <?php
                                   // }
                                   if (isset($_SESSION['reset_pass'])) {
                                   ?>
                                        <form id="GetOtp">
                                             <div class="validate row mt-4">
                                                  <div class="input-group mb-3">
                                                       <input type="text" disabled id="name" class="form-control" value="<?php echo $_SESSION['name'] !== "" ? $_SESSION['name'] : "" ?>">
                                                       <input type="hidden" id="user_name" name="user_name" class="form-control" value="<?php echo $_SESSION['name'] !== "" ? $_SESSION['name'] : "" ?>">
                                                  </div>
                                                  <div class="col-6 mb-4">
                                                       <button type="submit" class="btn btn-primary btn-sm">Get OTP</button>
                                                  </div>
                                             </div>
                                        </form>
                                   <?php
                                   } elseif (isset($_SESSION['otp_code'])) {
                                   ?>
                                        <form id="ValidateOtp">
                                             <div class="row OtpForm">
                                                  <div class="col-6">
                                                       <div class="input-group mb-3">
                                                            <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP">
                                                       </div>
                                                  </div>
                                                  <div class="col-6">
                                                       <button type="submit" class="btn btn-success col-12 ">Validate OTP</button>
                                                  </div>
                                             </div>
                                        </form>
                                   <?php
                                   } elseif (isset($_SESSION['change_pass'])) {
                                   ?>
                                        <form id="ChangePassword">
                                             <div class="row ChangePass">
                                                  <label for="">Enter Password:</label>
                                                  <div class="input-group mb-3">
                                                       <input type="password" id="password" name="passWord" class="form-control" placeholder="Password" autocomplete="off">
                                                       <div class="input-group-append">
                                                            <div class="input-group-text">
                                                                 <span><i id="showPass" class="far fa-eye"></i></span>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  <label for="">Confirm Password:</label>
                                                  <div class="input-group">
                                                       <input type="password" id="c_password" name="c_passWord" class="form-control" placeholder="Confirm Password" autocomplete="off">
                                                  </div>
                                                  <small class="text-danger">***Password should be alpha-numeric</small>
                                                  <button type="submit" class="btn btn-primary btn-sm col-12 mt-3">Save Password</button>
                                             </div>
                                        </form>
                                   <?php
                                   } else {
                                   ?>
                                        <form id="ResetPass">
                                             <div class="row">
                                                  <div class="col-6">
                                                       <div class="input-group mb-3">
                                                            <input type="email" id="email" name="email" class="form-control" placeholder="Emial Address">
                                                       </div>
                                                  </div>
                                                  <div class="col-6">
                                                       <div class="input-group mb-3">
                                                            <input type="text" id="mobile" name="mobile_number" class="form-control" placeholder="Registered Mobile Number">
                                                       </div>
                                                  </div>
                                                  <div class="col-12">
                                                       <a href="index.php" class="btn btn-primary mr-auto btn-sm">Back</a>
                                                       <button type="submit" class="btn btn-success float-end btn-sm">Get Details</button>
                                                  </div>
                                             </div>
                                        </form>
                                   <?php
                                   }
                                   ?>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <script src="assets/js/resetpassword.js"></script>
</body>

</html>