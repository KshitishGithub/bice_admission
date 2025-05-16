<?php
include('header.php');

if (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 4) {
     include('sidebar.php');

?>
     <style>
          .form-check .form-check-input {
               margin-left: 0;
          }
     </style>

     <div class="card">
          <div class="card-body">
               <div class="row">
                    <div class="col-12 d-flex">
                         <img src="images/logo.png" width="140px" height="70px" alt="logo" />
                         <div class="text-center">
                              <span class="fs-1 p-5 fw-bolder pb-0">Bice Institute Of Competitive Exams Pvt Ltd
                              </span>
                              <h4><b>Registered by : Ministry of Corporate Affairs Government of India.</b></h4>
                              <h4><b>Lakshania More ,Raiganj , Uttar Dinajpur , 733156</b></h4>
                              <h4><b><u>Admission Form - <?php echo date('Y') ?></u></b></h4>
                              <p><u>
                                   </u></p>
                         </div>
                    </div>
                    <hr class="border-success opacity-50">
                    <div class="col-md-6">
                         <?php
                         $Addobj->select("registration", "*", "s_id = '{$_SESSION['admission_s_id']}'");
                         $result = $Addobj->getResult();
                         $Addobj->select("personal_details", "*", "s_id = '{$_SESSION['admission_s_id']}'",);
                         $result2 = $Addobj->getResult();
                         $Addobj->select("photo_signature", "*", "s_id = '{$_SESSION['admission_s_id']}'");
                         $result3 = $Addobj->getResult();
                         $Addobj->select("comunication", "*", "s_id = '{$_SESSION['admission_s_id']}'");
                         $result4 = $Addobj->getResult();
                         ?>
                         <span class="fw-bolder fs-5"><u>Personal Details:</u></span>
                         <table class="table table-bordered border-primary fw-bolder">
                              <tbody>
                                   <tr>
                                        <td scope="row" width="50%">Applicant Name:</td>
                                        <td><?php echo $result[0]['fname'] . ' ' . $result[0]['lname']  ?></td>
                                   </tr>
                                   <?php
                                        if ($result[0]['father_name'] != null) {
                                   ?>
                                        <tr>
                                             <td scope="row">Fathers' Name:</td>
                                             <td><?php echo $result[0]['father_name'] ?></td>
                                        </tr>
                                   <?php
                                        }
                                   ?>
                                   <?php
                                        if ($result[0]['spouse_name'] != null) {
                                   ?>
                                        <tr>
                                        <td scope="row">Spouse Name:</td>
                                        <td><?php echo $result[0]['spouse_name'] ?></td>
                                   </tr>
                                   <?php
                                        }
                                   ?>
                                   <tr>
                                        <td scope="row">Mothers' Name:</td>
                                        <td><?php echo $result[0]['mother_name'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Gander:</td>
                                        <td><?php echo $result2[0]['gander'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Category:</td>
                                        <td><?php echo $result2[0]['category'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Religion:</td>
                                        <td><?php echo $result2[0]['religion'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Aadhar:</td>
                                        <td><?php echo $result2[0]['aadhar'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Date of birth:</td>
                                        <td><?php echo $result[0]['dob'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Course:</td>
                                        <td><?php echo $result2[0]['course'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Batch:</td>
                                        <td><?php echo $result2[0]['batch'] ?></td>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
                    <div class="col-md-6">
                         <div class="row mt-md-5">
                              <div class="offset-md-5 col-md-7">
                                   <tr>
                                        <td>
                                             <label class="py-2">Applicant's Photo</label><br>
                                             <img src="<?php echo 'photos/images/' . $result3[0]['photo'] ?>" height="200" width="120" alt="photo" class="img-fluid">
                                        </td>
                                        <br>
                                        <td>
                                             <label class="py-2">Applicant's Signature</label><br>
                                             <img src="<?php echo 'photos/signatures/' . $result3[0]['sig'] ?>" height="50" width="120" alt="photo" class="img-fluid">
                                        </td>
                                   </tr>
                              </div>
                         </div>
                    </div>
                    <hr class="border-success opacity-50 my-3">
                    <div class="col-md-6">
                         <span class="fw-bolder fs-5"><u>Address Details:</u></span>
                         <table class="table table-bordered border-primary fw-bolder">
                              <tbody>
                                   <tr>
                                        <td scope="row" width="50%">Village:</td>
                                        <td><?php echo $result4[0]['vill'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Locality:</td>
                                        <td><?php echo $result4[0]['locality'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Post Office:</td>
                                        <td><?php echo $result4[0]['po'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Police Station:</td>
                                        <td><?php echo $result4[0]['ps'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">District:</td>
                                        <td><?php echo $result4[0]['dist'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Pin:</td>
                                        <td><?php echo $result4[0]['pin'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">State:</td>
                                        <td><?php echo $result4[0]['state'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Country:</td>
                                        <td><?php echo $result4[0]['country'] ?></td>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
                    <div class="col-md-6">
                         <span class="fw-bolder fs-5"><u>Communination Details:</u></span>
                         <table class="table table-bordered border-primary fw-bolder">
                              <tbody>
                                   <tr>
                                        <td scope="row" width="50%">Mobile:</td>
                                        <td><?php echo $result[0]['mobile'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Gurdain Mobile:</td>
                                        <td><?php echo $result[0]['gurdain_mobile'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Email:</td>
                                        <td><?php echo $result[0]['email'] ?></td>
                                   </tr>
                              </tbody>
                         </table>
                         <span class="fw-bolder fs-5"><u>Physical Details:</u></span>
                         <table class="table table-bordered border-primary fw-bolder">
                              <tbody>
                                   <tr>
                                        <td scope="row" width="50%">Height:</td>
                                        <td><?php echo $result2[0]['height'] ?> cm.</td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Weight:</td>
                                        <td><?php echo $result2[0]['weight'] ?> kg.</td>
                                   </tr>
                                   <td scope="row">Cheast:</td>
                                   <td><?php echo $result2[0]['chest'] ?> cm.</td>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
                    <hr class="border-success opacity-50 my-3">
                    <div class="col-12  mt-2">
                         <span class="fw-bolder fs-5">Qualification Details:</span>
                         <div class="">
                              <table class="table fw-bolder table-bordered border-primary mt-3">
                                   <tbody>
                                        <tr>
                                             <td>Last Qualification</td>
                                             <td>Year of passing</td>
                                             <td>Extra course</td>
                                        </tr>
                                        <tr>
                                             <td><?php echo $result2[0]['last_qualification'] ?></td>
                                             <td><?php echo $result2[0]['passing_year'] ?></td>
                                             <td><?php echo $result2[0]['ex_course'] ?></td>
                                        </tr>
                                   </tbody>
                              </table>
                         </div>
                    </div>
                    <span class="mt-2"><b>Computer Knowledge :</b> <?php echo $result2[0]['com_know'] == 'on' ? "Yes" : "No" ?></span>
                    <hr class="border-success opacity-50 my-3">
                    <div class="col-12">
                         <span class="fw-bolder fs-5"><u>Notes To Students:</u></span>
                         <ol>
                              <li>Please note down your Application No and Password for future reference.</li>
                              <li>You are adviced to take a photocopy of this Application and retain it for your record.</li>
                         </ol>
                    </div>
                    <div class="col-md-12 ">
                         <div class="form-check ml-0">
                              <input class="form-check-input myCheckBox" type="checkbox" id="checkboxBox">
                              <label class="form-check-label" for="checkboxBox">
                                   I hereby declare that the infomation given above true and fulfill the eligiblety conditions for admission at <strong>BiCE Institute of Competitive Exams</strong>.I further declare that in case of my declaration and statements are found to be false or any ineligibility being detacted before or after the admission , my candidature for <strong>BiCE Institute of Competitive Exams</strong> is liable to be cancelled.
                              </label>
                         </div>
                         <small class="text-danger">Please check the checkbox</small>
                    </div>
                    <a href="edit.php" class="btn btn-info col-md-1 mx-auto">Edit</a>
                    <input type="submit" name="submit" value="Submit" id="SavePreview" class="btn btn-success col-md-1 mx-auto">
               </div>
          </div>
     </div>

<?php
}
include('footer.php');
?>