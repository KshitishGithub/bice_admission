<?php
include('header.php');

if (isset($_SESSION['admission_name'])) {
     include('sidebar.php');

?>
     <div class="row mx-auto">
          <div class="offset-md-2 mt-3">
               <div class="col-md-6">
                    <div class="card card-outline card-primary">
                         <div class="card-header text-center">
                              <span><b>Password Change</b></span>
                         </div>
                         <div class="card-body">
                              <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
                              <form id="changepass">
                                   <div class="input-group mb-3">
                                        <input type="password" id="oldpass" name="oldpass" class="form-control" placeholder="Old Password">
                                   </div>
                                   <div class="input-group mb-3">
                                        <input type="password" id="newpass" name="newpass" class="form-control" placeholder="New Password">
                                   </div>
                                   <div class="input-group mb-3">
                                        <input type="password" id="cnewpass" name="cnewpass" class="form-control" placeholder="Confirm New Password">
                                   </div>
                                   <div class="row mb-4 ">
                                        <div class="col-12 mt-4">
                                             <button type="submit" class="btn btn-success"><i class="bi bi-key mr-1"></i>Change Password</button>
                                        </div>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>

<?php
}
include('footer.php');
?>