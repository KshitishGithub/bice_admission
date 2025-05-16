<?php
// session.user_strict_mode =1
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['admission_name'])) {
?>
     <script>
          location.href = "index.php";
     </script>
<?php
}

include("../admin/php_files/database.php");
$obj = new Database();
$Addobj = new Admission();
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>Bice Admission Panel</title>
     <!-- plugins:css -->
     <link rel="stylesheet" href="vendors/feather/feather.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.min.css" />
     <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
     <link rel="stylesheet" href="vendors/typicons/typicons.css">
     <!-- endinject -->
     <!-- Plugin css for this page -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.0/css/select.bootstrap.css">
     <!-- End plugin css for this page -->
     <!-- Custom css -->
     <link rel="stylesheet" href="assets/css/style.css">
     <!-- inject:css -->
     <link rel="stylesheet" href="vendors/vertical-layout-light/style.css">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@5.0.12/bootstrap-4.min.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <!-- endinject -->
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

     
     <div class="container-scroller">
          <!-- partial:partials/_navbar.html -->
          <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
               <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                    <div class="me-3">
                         <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                              <span class="icon-menu"></span>
                         </button>
                    </div>
                    <div>
                         <a class="navbar-brand brand-logo" href="index.php">
                              <img src="images/logo.png" alt="logo" />
                         </a>
                         <a class="navbar-brand brand-logo-mini" href="index.php">
                              <img src="images/logo.png" alt="logo" />
                         </a>
                    </div>
               </div>
               <div class="navbar-menu-wrapper d-flex align-items-top">
                    <ul class="navbar-nav">
                         <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                              <!-- <h1 class="welcome-text">Welcome, <span class="text-black fw-bold"><?php echo $_SESSION['admission_name'] ?></span></h1> -->
                         </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                         <li class="nav-item dropdown user-dropdown">
                              <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                   <img class="img-xs rounded-circle" src="images/user.png" alt="Profile image"> </a>
                              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                                   <div class="dropdown-header text-center">
                                        <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['admission_name'] ?></p>
                                        <p class="fw-light text-muted mb-0"><?php echo $_SESSION['admission_email'] ?></p>
                                   </div>
                                   <a href="change_password.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-key-variant text-primary me-2"></i>Change Password</a>
                                   <a class="dropdown-item" id="logout"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                              </div>
                         </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
                         <span class="mdi mdi-menu"></span>
                    </button>
               </div>
          </nav>

          <?php
          // }
          ?>