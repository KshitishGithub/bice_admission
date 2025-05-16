<?php
include('header.php');

if (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 3) {
     include('sidebar.php');
     // echo "<pre>";
     // print_r($_SESSION);
     // Edit Mode
     if (isset($_SESSION['Edit_Mode'])) {
          $obj = new Admission();
          $obj->select("photo_signature", "*", "s_id = '{$_SESSION['admission_s_id']}'");
          $res = $obj->getResult();
     }
?>


     <div class="row">
          <div class="card">
               <div class="card-body text-capitalize">
                    <h4><u><?php echo isset($_SESSION['Edit_Mode']) ? "Edit "  : "" ?>Photo and Signature :</u></h4>
                    <p class="text-danger">All fields are required.</p>
                    <ol>
                         <li> Upload resent passport image and signature .</li>
                         <li> Photo and Signature must have 200kb and 50kb or lower.</li>
                         <li> Photo and signature must have extentuion like JPG and JPEG.</li>
                    </ol>
                    <hr class="border border-info border-1 opacity-50">
                    <br>
                    <form id='<?php
                    if (isset($_SESSION['Edit_Mode'])) {
                        echo "UpdatePhotoSignature";
                    }else{
                         echo "PhotoSignature";
                    } ?>'>
                         <div class="row">
                              <?php
                              if (isset($_SESSION['Edit_Mode'])) {
                              ?>
                                   <div class="col-md-6 form-group text-center">
                                   <label class="">Applicant' s Photo</label><br>
                                   <img src="<?php echo 'photos/images/' . $res[0]['photo'] ?>" height="180" width="120" alt="photo" class="img-fluid"><br>
                                   <input type="hidden" name="old_photo" value="<?php echo $res[0]['photo']; ?>">
                              </div>
                              <div class="col-md-6 form-group text-center">
                                   <label class="">Applicant's Signature</label><br>
                                   <img src="<?php echo 'photos/signatures/' . $res[0]['sig'] ?>" height="100" width="200" alt="photo" class="img-fluid mt-5"><br>
                                   <input type="hidden" name="old_sig" value="<?php echo $res[0]['sig']; ?>">
                              </div>
                              <?php
                              }
                              ?>

                    <div class="col-md-6">
                         Photo<span class="text-danger">*</span>
                         <input type="file" class="form-control" name="photo" id="photo">
                    </div>
                    <div class="col-md-6">
                         Signature<span class="text-danger">*</span>
                         <input type="file" class="form-control" name="sig" id="sig">
                    </div>
                    <?php
                    if (isset($_SESSION['Edit_Mode'])) {
                    ?>
                         <input type="submit" name="submit" value="Update" class="btn btn-info mx-auto col-md-1 mt-4">
                    <?php
                    } else {
                    ?>
                         <input type="submit" name="submit" value="Submit" class="btn btn-success mx-auto col-md-1 mt-4">
                    <?php
                    }
                    ?>
                    </div>
                    </form>
     </div>
     </div>
     </div>

<?php
}
include('footer.php');
?>