<?php

include('../../admin/php_files/database.php');
$obj = new Admission();
session_start();
if (isset($_POST['email']) && isset($_POST['mobile_number'])) {

     $email = $obj->escapeString($_POST['email']);
     $mobile_number = $obj->escapeString($_POST['mobile_number']);

     $obj->rawsql("SELECT * FROM registration WHERE email = '$email' AND mobile = '$mobile_number'");

     $result = $obj->getResult();
     if (count($result) > 0) {

          $_SESSION['reset_pass'] = true;
          $_SESSION['reset_id'] = $result[0]['s_id'];
          $_SESSION['reset_mobile'] = $result[0]['mobile'];
          $_SESSION['name'] = $result[0]['fname'] . ' ' . $result[0]['lname'];

          echo json_encode(array('status' => 'success', 'msg' => 'Right Credencial.'));
     } else {
          echo json_encode(array('status' => 'error', 'msg' => 'Invalid Information.'));
     }
}

// SEND OTP ....
if (isset($_POST['user_name'])) {
     if (isset($_SESSION['reset_pass'])) {
          //! Sms sending 
          $value = [mt_rand(111111, 999999)];
          $_SESSION['otp_code'] = $value;
          $mobile = [$_SESSION['reset_mobile']];
          $obj->sendsms('EdBiCE', '153477', $value, $mobile);
          $smsRes = $obj->getResult();
          if ($smsRes[0] == 'success') {
               unset($_SESSION['reset_pass']);
               echo json_encode(array('status' => 'success', 'msg' => 'OTP send to register mobile number.'));
          } else {
               echo json_encode(array('status' => 'error', 'msg' => 'OTP sending faild.'));
          }
     } else {
          echo json_encode(array('status' => 'error', 'msg' => 'OTP session is not set.'));
     }
}

//! Validate OTP
if (isset($_POST['otp'])) {
     $otp = $obj->escapeString($_POST['otp']);
     if ($otp == $_SESSION['otp_code'][0]) {
          $_SESSION['change_pass'] = true;
          unset($_SESSION['otp_code']);
          echo json_encode(array('status' => 'success', 'msg' => 'OTP Matched.'));
     } else {
          echo json_encode(array('status' => 'error', 'msg' => 'Invalid OTP.'));
     }
}

//! Change Password.......
if (isset($_POST['passWord']) && isset($_POST['c_passWord'])) {
     $pass = $obj->escapeString($_POST['passWord']);
     $c_pass = $obj->escapeString($_POST['c_passWord']);

     $id = $_SESSION['reset_id'];
     if ($pass == $c_pass) {
          $hashpass = password_hash($c_pass, PASSWORD_BCRYPT);
          $obj->update("registration", ["pass" => "{$hashpass}"], "s_id = '{$id}'");
          $result = $obj->getResult();
          if (count($result) > 0) {
               session_unset();
               session_destroy();
               echo json_encode(array('status' => 'success', 'msg' => 'Password updated successfully.'));
          } else {
               echo json_encode(array('status' => 'success', 'msg' => 'Password updated failed.'));
          }
     } else {
          echo json_encode(array('status' => 'error', 'msg' => 'Confirm password not matched.'));
     }
}
?>