<?php


session_start();
include('php_files/database.php');
$Addobj = new Database();
$Addobj->rawsql("SELECT * FROM registration r INNER JOIN personal_details p ON r.s_id = p.s_id INNER JOIN photo_signature s ON r.s_id = s.s_id INNER JOIN comunication c ON r.s_id = c.s_id INNER JOIN payment y ON r.s_id = y.stu_id WHERE r.s_id = {$_SESSION['admission_s_id']}");
$result = $Addobj->getResult();


if ($result[0]['com_know'] == 'on') {
     $com = "YES";
} else {
     $com = "NO";
}
// $outPut = "<div class='card'>
//           <div class='card-body' id='printSec'>
//                <img class='printSec-watermark1' src='images/logo.png' alt='logo' />
//                <img class='printSec-watermark2' src='images/logo.png' alt='logo' />
//                <div class='row'>
//                     <div class='col-12 d-flex'>
//                          <img src='images/logo.png' width='140px' height='70px' alt='logo' />
//                          <div class='text-center'>
//                               <span class='fs-1 p-5 fw-bolder pb-0'>Bice Institute Of Competitive Exams Pvt Ltd
//                               </span>
//                               <h4><b>Registered by : Ministry of Corporate Affairs Government of India.</b></h4>
//                               <h4><b>Lakshania More ,Raiganj , Uttar Dinajpur , 733134</b></h4>
//                               <h4><b><u>Admission Form - 2023</u></b></h4>
//                               <p><u>
//                                    </u></p>
//                          </div>
//                     </div>
//                     <hr class='border-success opacity-80'>
//                     <div class='col-6'>
//                          <span class='fw-bolder fs-5'>Personal Details:</span>
//                          <table class='table table-bordered border-primary fw-bolder'>
//                               <tbody>
//                                    <tr>
//                                         <td scope='row'>Applicant Name:</td>
//                                         <td>" . $result[0]['fname'] . ' ' . $result[0]['lname']  . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Fathers' Name:</td>
//                                         <td>" . $result[0]['father_name'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Mothers' Name:</td>
//                                         <td>" . $result[0]['mother_name'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Gander:</td>
//                                         <td>" . $result[0]['gander'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Category:</td>
//                                         <td>" . $result[0]['category'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Aadhar:</td>
//                                         <td>" . $result[0]['aadhar'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Date of birth:</td>
//                                         <td>" . $result[0]['dob'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Course:</td>
//                                         <td>" . $result[0]['course'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row '>Batch:</td>
//                                         <td>" . $result[0]['batch'] . "</td>
//                                    </tr>
//                               </tbody>
//                          </table>
//                     </div>
//                     <div class='col-6'>
//                          <div class='row mt-md-3'>
//                               <div class='offset-5 col-md-7'>
//                                    <tr>
//                                         <td>
//                                              <label class='py-2'>Applicant's Photo</label><br>
//                                              <img src='photos/images/" . $result[0]['photo'] . "' height='200' width='120' alt='photo' class='img-thumbnail'>
//                                         </td>
//                                         <br>
//                                         <br>
//                                         <td>
//                                              <label class='py-2'>Applicant's Signature</label><br>
//                                              <img src='photos/signatures/" . $result[0]['sig'] . "' height='70' width='150' alt='photo' class='img-thumbnail'>
//                                         </td>
//                                    </tr>
//                               </div>
//                          </div>
//                     </div>
//                     <hr class='border-success opacity-80 my-4'>
//                     <div class='col-6 mt-2'>
//                          <span class='fw-bolder fs-5'>Address Details:</span>
//                          <table class='table table-bordered border-primary fw-bolder'>
//                               <tbody>
//                                    <tr>
//                                         <td scope='row'>Village:</td>
//                                         <td> " . $result[0]['vill'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Locality:</td>
//                                         <td> " . $result[0]['locality'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Post Office:</td>
//                                         <td> " . $result[0]['po'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Police Station:</td>
//                                         <td>" . $result[0]['ps'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>District:</td>
//                                         <td>" . $result[0]['dist'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Pin:</td>
//                                         <td>" . $result[0]['pin'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>State:</td>
//                                         <td>" . $result[0]['state'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Country:</td>
//                                         <td>" . $result[0]['country'] . "</td>
//                                    </tr>
//                               </tbody>
//                          </table>
//                     </div>
//                     <div class='col-6 mt-2'>
//                          <span class='fw-bolder fs-5'>Communination Details:</span>
//                          <table class='table table-bordered border-primary fw-bolder'>
//                               <tbody>
//                                    <tr>
//                                         <td scope='row'>Mobile:</td>
//                                         <td>" . $result[0]['mobile'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Gurdain Mobile:</td>
//                                         <td>" . $result[0]['gurdain_mobile'] . "</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Email:</td>
//                                         <td>" . $result[0]['email'] . "</td>
//                                    </tr>
//                               </tbody>
//                          </table>
//                          <br>
//                          <span class='fw-bolder fs-5'>Physical Details:</span>
//                          <table class='table table-bordered border-primary fw-bolder'>
//                               <tbody>
//                                    <tr>
//                                         <td scope='row'>Height:</td>
//                                         <td>" . $result[0]['height'] . " cm.</td>
//                                    </tr>
//                                    <tr>
//                                         <td scope='row'>Weight:</td>
//                                         <td>" . $result[0]['weight'] . " kg.</td>
//                                    </tr>
//                                    <td scope='row'>Cheast:</td>
//                                    <td>" . $result[0]['chest'] . " cm.</td>
//                                    </tr>
//                               </tbody>
//                          </table>
//                     </div>
//                     <hr class='border-success opacity-80 my-4'>
//                     <div class='col-12 mt-2'>
//                          <span class='fw-bolder fs-5'>Qualification Details:</span>
//                          <div class=''>
//                               <table class='table table-bordered border-primary fw-bolder mt-3'>
//                                    <tbody>
//                                         <tr>
//                                              <td>Last Qualification</td>
//                                              <td>Year of passing</td>
//                                              <td>Extra course</td>
//                                         </tr>
//                                         <tr>
//                                              <td>" . $result[0]['last_qualification'] . "</td>
//                                              <td>" . $result[0]['passing_year'] . "</td>
//                                              <td>" . $result[0]['ex_course'] . "</td>
//                                         </tr>
//                                    </tbody>
//                               </table>
//                          </div>
//                     </div>
//                     <span class='mt-2'>Computer Knowledge : " . $com . "</span>
//                     <hr class='border-success opacity-80 my-4'>
//                     <div class='col-12 mt-2'>
//                          <span class='fw-bolder fs-5'>Payment Details:</span>
//                          <div class=''>
//                               <table class='table table-bordered border-primary fw-bolder mt-3'>
//                                    <tbody>
//                                         <tr>
//                                              <td>Total Fess</td>
//                                              <td>Payment Status</td>
//                                              <td>Payment Id</td>
//                                              <td>Payment Date/Time</td>
//                                         </tr>
//                                         <tr>
//                                              <td>" . $result[0]['amount'] . " .00/-</td>
//                                              <td>" . $result[0]['payment_status'] . " </td>
//                                              <td>" . $result[0]['payment_id'] . " </td>
//                                              <td>" . $result[0]['added_on'] . " </td>
//                                         </tr>
//                                    </tbody>
//                               </table>
//                          </div>
//                     </div>
//                     <hr class='border-success opacity-80 my-3'>
//                     <div class='col-12'>
//                          <span class='fw-bolder fs-5'><u>Notes To Students:</u></span>
//                          <ol>
//                               <li>Please note down your Application No and Password for future reference.</li>
//                               <li>You are adviced to take a photocopy of this Application and retain it for your record.</li>
//                          </ol>
//                          <label class='form-check-label' for='checkboxBox'>
//                               I hereby declare that the infomation given above true and fulfill the eligiblety conditions for admission at <strong>BiCE Teaching Institute</strong>.I further declare that in case of my declaration and statements are found to be false or any ineligibility being detacted before or after the admission , my candidature for <strong>BiCE Teaching Institute</strong> is liable to be cancelled.
//                          </label>
//                     </div>
//                </div>
//           </div>
//      </div>";

// $outPut =  "";
// require_once __DIR__ . '/vendor/autoload.php';
// $mpdf = new \Mpdf\Mpdf();
// $mpdf->WriteHTML($outPut);
// $mpdf->Output('demo.pdf' , 'I');