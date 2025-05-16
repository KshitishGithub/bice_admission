<div class="container-fluid page-body-wrapper">
     <!-- Right side bar -->
     <div class="theme-setting-wrapper">
          <div id="settings-trigger"><i class="ti-settings"></i></div>
          <div id="theme-settings" class="settings-panel">
               <i class="settings-close ti-close"></i>
               <p class="settings-heading">SIDEBAR SKINS</p>
               <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                    <div class="img-ss rounded-circle bg-light border me-3"></div>Light
               </div>
               <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
               </div>
               <p class="settings-heading mt-2">HEADER SKINS</p>
               <div class="color-tiles mx-0 px-4">
                    <div class="tiles success"></div>
                    <div class="tiles warning"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles info"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles default"></div>
               </div>
          </div>
     </div>

     <!-- partial -->
     <!-- partial:partials/_sidebar.html -->
     <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
               <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['admission_status'] !== '1') {
                                             echo "disabled";
                                        } ?>" href="personal_details.php">
                         <i class="menu-icon mdi mdi-human-child"></i>
                         <span class="menu-title">Personal Details</span>
                         <i class="menu-arrow"></i>
                    </a>
               </li>
               <!-- <li class="nav-item nav-category">Forms and Datas</li> -->
               <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['admission_status'] !== '2') {
                                             echo "disabled";
                                        } ?>" href="address_details.php">
                         <i class="menu-icon mdi mdi-home-variant"></i>
                         <span class="menu-title">Communication Details</span>
                         <i class="menu-arrow"></i>
                    </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['admission_status'] !== '3') {
                                             echo "disabled";
                                        } ?>" href="photo_signature.php">
                         <i class="menu-icon mdi mdi-emoticon-neutral"></i>
                         <span class="menu-title">Photo and Signature</span>
                         <i class="menu-arrow"></i>
                    </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['admission_status'] !== '4') {
                                             echo "disabled";
                                        } ?>" href="preview.php">
                         <i class="menu-icon mdi mdi-eye"></i>
                         <span class="menu-title">Preview</span>
                         <i class="menu-arrow"></i>
                    </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['admission_status'] !== '5') {
                                             echo "disabled";
                                        } ?>" href="payment.php">
                         <i class="menu-icon mdi mdi-cash-multiple"></i>
                         <span class="menu-title">Payment</span>
                         <i class="menu-arrow"></i>
                    </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['admission_status'] !== '6') {
                                             echo "disabled";
                                        } ?>" href="print.php">
                         <i class="menu-icon mdi mdi-printer"></i>
                         <span class="menu-title">Print</span>
                         <i class="menu-arrow"></i>
                    </a>
               </li>
               <li class="nav-item">
                    <a class="nav-link <?php if ($_SESSION['admission_status'] !== '6') {
                                             echo "disabled";
                                        } ?>" href="monthly_payment.php">
                         <i class="menu-icon mdi  mdi-numeric-5-box-outline"></i>
                         <span class="menu-title">Monthly Payment</span>
                         <i class="menu-arrow"></i>
                    </a>
               </li>
          </ul>
     </nav>
     <!-- partial -->
     <div class="main-panel">
          <div class="content-wrapper">
               <div class="row">
                    <div class="col-sm-12">
                         <div class="home-tab">
                              <div class="tab-content tab-content-basic">
                                   <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                                        <div class="row">
                                             <div class="col-sm-12">
                                                  <div class="grid-margin">