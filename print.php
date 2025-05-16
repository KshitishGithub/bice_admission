<?php
include('header.php');

if (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 6) {
     include('sidebar.php');
?>
     <div class="card">
          <div class="card-body bg-light" id="printSec">
               <img class="printSec-watermark1" src="images/logo.png" alt="logo" />
               <img class="printSec-watermark2" src="images/logo.png" alt="logo" />

               <div class="row">
                    <div class="col-12 d-flex">
                         <img src="images/logo.png" width="140px" height="70px" alt="logo" />
                         <div class="text-center">
                              <span class="fs-1 p-5 fw-bolder pb-0">BiCE Institute Of Competitive Exams Pvt Ltd
                              </span>
                              <h4><b>Registered by : Ministry of Corporate Affairs Government of India.</b></h4>
                              <h4><b>Lakshania More ,Raiganj , Uttar Dinajpur , 733156</b></h4>
                              <h4><b><u>Admission Form - <?php echo date('Y') ?></u></b></h4>

                         </div>
                    </div>
                    <hr class="border-success opacity-80">
                    <?php
                    $Addobj->select("registration", "*", "s_id = '{$_SESSION['admission_s_id']}'");
                    $result = $Addobj->getResult();
                    $Addobj->select("personal_details", "*", "s_id = '{$_SESSION['admission_s_id']}'");
                    $result2 = $Addobj->getResult();
                    $Addobj->select("photo_signature", "*", "s_id = '{$_SESSION['admission_s_id']}'");
                    $result3 = $Addobj->getResult();
                    $Addobj->select("comunication", "*", "s_id = '{$_SESSION['admission_s_id']}'");
                    $result4 = $Addobj->getResult();
                    $Addobj->select("payment", "*", "stu_id = '{$_SESSION['admission_s_id']}'");
                    $result5 = $Addobj->getResult();
                    $Addobj->select("fresh_students", "registration", "s_id = '{$_SESSION['admission_s_id']}'");
                    $result6 = $Addobj->getResult();
                    // print_r($result6);
                    if (count($result6) === 0) {
                         $result6[0]['registration'] = "";
                    }
                    $qr_data = 'Name:' . $result[0]['fname'] . ' ' . $result[0]['lname'] . ',Father Name:' . $result[0]['father_name'] . ',Apllication ID:' . $result6[0]['registration'] . ',Batch:' . $result2[0]['batch'] . ',Admission Date:' . $result5[0]['added_on'];
                    ?>
                    <div class="col-6">
                         <span class="fw-bolder fs-5">Personal Details:</span>
                         <table class="table table-bordered border-primary fw-bolder">
                              <tbody>
                                   <tr>
                                        <td width='50%' scope="row" >Applicant Name:</td>
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
                                        <td scope="row">Aadhar:</td>
                                        <td><?php echo $result2[0]['aadhar'] ?></td>
                                   </tr>
                                   <tr>
                                        <td scope="row">Date of birth:</td>
                                        <td><?php echo $result[0]['dob'] ?></td>
                                   </tr>
                              </tbody>
                         </table>
                         <br>
                         <table class="table table-bordered border-primary fw-bolder">
                              <tbody>
                                   <tr>
                                        <td width='50%' scope="row">Application ID:</td>
                                        <td><?php echo $result6[0]['registration'] ?></td>
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
                    <div class="col-6">
                         <div class="row mt-md-3">
                              <div class="offset-5 col-md-7">
                                   <table>
                                        <tr>
                                             <?php
                                             if (!empty($result6[0]['registration'])) {
                                                  echo "<img src='https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl= $qr_data'>";
                                             }
                                             ?>
                                             <td>
                                                  <label class="py-2">Applicant's Photo</label><br>
                                                  <img src="<?php echo 'photos/images/' . $result3[0]['photo'] ?>" height="200" width="120" alt="photo" class="img-thumbnail">
                                             </td>
                                        </tr>
                                        <tr>
                                             <td>
                                                  <label class="py-2">Applicant's Signature</label><br>
                                                  <img src="<?php echo 'photos/signatures/' . $result3[0]['sig'] ?>" height="70" width="150" alt="photo" class="img-thumbnail">
                                             </td>
                                        </tr>
                                   </table>
                              </div>
                         </div>
                         <br>
                    </div>
                    <hr class="border-success opacity-80 my-4">
                    <div class="col-6 mt-2">
                         <span class="fw-bolder fs-5">Address Details:</span>
                         <table class="table table-bordered border-primary fw-bolder">
                              <tbody>
                                   <tr>
                                        <td width='50%' scope="row">Village:</td>
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
                    <div class="col-6 mt-2">
                         <span class="fw-bolder fs-5">Communination Details:</span>
                         <table class="table table-bordered border-primary fw-bolder">
                              <tbody>
                                   <tr>
                                        <td width='50%' scope="row">Mobile:</td>
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
                                   <tr>
                                        <td scope="row">Registration Date:</td>
                                        <td><?php echo $result[0]['registration_date'] ?></td>
                                   </tr>
                              </tbody>
                         </table>
                         <br>
                         <span class="fw-bolder fs-5">Physical Details:</span>
                         <table class="table table-bordered border-primary fw-bolder">
                              <tbody>
                                   <tr>
                                        <td width='50%' scope="row">Height:</td>
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
                    <hr class="border-success opacity-80 my-4">
                    <div class="col-12  mt-2">
                         <span class="fw-bolder fs-5">Qualification Details:</span>
                         <div class="">
                              <table class="table table-bordered border-primary fw-bolder mt-3">
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
                    <hr class="border-success opacity-80 my-4">
                    <div class="col-12  mt-2">
                         <span class="fw-bolder fs-5">Payment Details:</span>
                         <div class="">
                              <table class="table table-bordered border-primary fw-bolder mt-3">
                                   <tbody>
                                        <tr>
                                             <td>Total Fess</td>
                                             <td>Payment Status</td>
                                             <td>Payment Id</td>
                                             <td>Payment Date/Time</td>
                                        </tr>
                                        <tr>
                                             <td><?php echo $result5[0]['amount'] ?>.00/-</td>
                                             <td><?php echo $result5[0]['payment_status'] ?></td>
                                             <td><?php echo $result5[0]['payment_id'] ?></td>
                                             <td><?php echo $result5[0]['added_on'] ?></td>
                                        </tr>
                                   </tbody>
                              </table>
                         </div>
                    </div>
                    <hr class="border-success opacity-50 my-3">
                    <div class="col-12">
                         <span class="fw-bolder fs-5"><u>Notes To Students:</u></span>
                         <ol>
                              <li>Please note down your Application No and Password for future reference.</li>
                              <li>You are adviced to take a photocopy of this Application and retain it for your record.</li>
                         </ol>
                         <label class="form-check-label" for="checkboxBox">
                              I hereby declare that the infomation given above true and fulfill the eligiblety conditions for admission at <strong>BiCE Institute of Competitive Exams</strong>.I further declare that in case of my declaration and statements are found to be false or any ineligibility being detacted before or after the admission , my candidature for <strong>BiCE Institute of Competitive Exams</strong> is liable to be cancelled.
                         </label>
                    </div>
               </div> 
          </div>
          <div class="row">
               <button type="button" class="btn btn-success col-md-2 mx-auto mt-5" id="DownloadBtn">Download</button>
               <button type="button" class="btn btn-info col-md-2 mx-auto mt-5" id="printBtn">Print</button>
          </div>
     </div>


     <!-- Image Create CDN Link -->
     <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>

     <!-- Genarete PDF -->
     <script src="https://cdn.apidelv.com/libs/awesome-functions/awesome-functions.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

     <script type="text/javascript">
          $(document).ready(function($) {
               $(document).on('click', '#DownloadBtn', function(event) {
                    event.preventDefault();

                    //credit : https://ekoopmans.github.io/html2pdf.js

                    var element = document.getElementById('printSec');

                    //easy
                    // html2pdf().from(element).save();

                    //custom file name
                    // html2pdf().set({filename: 'code_with_mark_'+js.AutoCode()+'.pdf'}).from(element).save();


                    //more custom settings
                    var opt = {
                         margin: 0.2,
                         filename: 'pageContent_' + js.AutoCode() + '.pdf',
                         image: {
                              type: 'jpeg',
                              quality: 0.98
                         },
                         html2canvas: {
                              scale: 2
                         },
                         jsPDF: {
                              unit: 'in',
                              format: 'letter',
                              orientation: 'portrait'
                         }
                    };

                    // New Promise-based usage:
                    html2pdf().set(opt).from(element).save();

                    // Image Create Function...
                    // domtoimage.toJpeg(document.getElementById('printSec'), {
                    //           quality: 0.95
                    //      })
                    //      .then(function(dataUrl) {
                    //           var link = document.createElement('a');
                    //           link.download = 'my-image-name.jpeg';
                    //           link.href = dataUrl;
                    //           link.click();
                    //      });
               });
          });
     </script>
<?php
}
include('footer.php');
?>