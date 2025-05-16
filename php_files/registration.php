<?php
include('../../admin/php_files/database.php');
$obj = new Admission();

//  Current Date ....
$dt = new DateTime("now", new DateTimeZone('Asia/Calcutta'));
$date = $dt->format('d/m/Y');
$time = $dt->format('H:i:s');

$fname = $obj->escapeString($_POST['fname']);
$lname = $obj->escapeString($_POST['lname']);
$FatherName = $obj->escapeString($_POST['FatherName']);
$SpouseName = $obj->escapeString($_POST['SpouseName']);
$MotherName = $obj->escapeString($_POST['MotherName']);
$mobile = $obj->escapeString($_POST['mobile']);
$gurdain_mobile = $obj->escapeString($_POST['gurdain_mobile']);
$email = $obj->escapeString($_POST['email']);
$dob = $obj->escapeString($_POST['dob']);
$newpassword = $obj->escapeString($_POST['newpassword']);
$registration_date = $date;
$hashpass = password_hash($newpassword, PASSWORD_BCRYPT);

$obj->select('registration','mobile'," mobile = '$mobile'");
$Res_mobile = $obj->getResult();

$obj->select('registration', 'email', " email = '$email'");
$Res_email = $obj->getResult();

if(count($Res_mobile) > 0){
     echo json_encode(array('status' => 'error', 'msg' => 'Mobile number already registered.'));
}else if(count($Res_email) > 0){
     echo json_encode(array('status' => 'error', 'msg' => 'Email id already registered.'));
}else{
     
     $obj->insert('registration', ["fname"=> $fname, "lname" => $lname, "father_name"=>$FatherName,"spouse_name"=>$SpouseName, "mother_name"=>$MotherName,"mobile"=>$mobile, "gurdain_mobile" => $gurdain_mobile, "email"=>$email,"dob"=>$dob,"pass"=>$hashpass, 'registration_date' =>$date,"status"=>'1']);
     
     $result = $obj->getResult();
     if ($result[0] == "success") {
          echo json_encode(array('status' => 'success', 'msg' => 'Registration successfully, Please login.'));
     } else {
          echo json_encode(array('status' => 'error', 'msg' => 'Registration failed.'));
     }
}

?>