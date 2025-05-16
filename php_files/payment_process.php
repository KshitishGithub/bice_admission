<?php
session_start();
include("../../admin/php_files/database.php");
$obj = new Admission();
$DataObj = new Database();

//! Pending...........
$stu_id = $_SESSION['admission_s_id'];

if (isset($_POST['amt']) && isset($_POST['name'])) {
     $amt = $obj->escapeString($_POST['amt']);
     $name = $obj->escapeString($_POST['name']);
     $payment_status = "Pending";
     $stu_id = $_SESSION['admission_s_id'];
     // Culcutta time zone
     $dt = new DateTime("now", new DateTimeZone('Asia/Calcutta'));
     $added_on = $dt->format('d-m-Y, H:i:s');
     $obj->select('payment', 'stu_id', "stu_id = '$stu_id'");
     $result2 = $obj->getResult();
     if (count($result2) > 0) {
          $obj->update("payment", ['added_on' => $added_on], "stu_id = '$stu_id'");
     } else {
          $obj->insert("payment", ['stu_id' => $stu_id, 'name' => $name, 'amount' => '00', 'payment_status' => $payment_status, 'added_on' => $added_on]);
     }
}

//! Success Payment ......

if (isset($_POST['payment_id'])) {
     $stu_id = $_SESSION['admission_s_id'];
     $payment_id = $_POST['payment_id'];
     // Update in payment table
     $obj->update('payment', ['amount' => '3000', 'payment_status' => 'Complete', "payment_id" => "{$payment_id}"], "stu_id = '$stu_id'");
     // Fetch last registration number  
     $obj->rawsql('SELECT `registration` FROM `fresh_students` ORDER BY registration DESC LIMIT 1');
     $Registration = $obj->getResult();
     if (count($Registration) > 0) {
          $nextRegistration = $Registration[0]['registration'] + 1;
     } else {
          $nextRegistration = 120232516;
     }
     // Next Registration Number
     $obj->insert('fresh_students', ['s_id' => "$stu_id", 'registration' => $nextRegistration, 'active_status' => "1"]);
     // Set id in fees and month table
     $DataObj->insert('fees_2022', ['s_id' => $stu_id]);
     $DataObj->insert('months_2022', ['s_id' => $stu_id]);

     $result = $obj->getResult();
     if ($result[0] == "success") {
          //! Sms sending 
          $value = [$nextRegistration];
          $mobile = [$_SESSION['admission_mobile']];
          $obj->sendsms('EdBiCE', '153153', $value, $mobile);
          $smsRes = $obj->getResult();
          //Update Status 
          if ($smsRes[0] == 'success') {
               $obj->update('registration', ['status' => '6'], "s_id = '$stu_id'");
               $Update_result = $obj->getResult();
               if ($Update_result[0] == "success") {
                    $_SESSION['admission_status'] = '6';
                    echo json_encode(array('status' => 'success'));
               } else {
                    echo json_encode(array('status' => 'error', 'msg' => 'Status updated failed.'));
               }
          } else {
               echo json_encode(array('status' => 'error', 'msg' => 'SMS sending faild.'));
          }
     } else {
          echo json_encode(array('status' => 'error', 'msg' => 'Application no updated failed.'));
     }
}


//! Offline ..........
if (isset($_POST['next'])) {
     $stu_id = $_SESSION['admission_s_id'];
     $obj->select('payment', '*', "stu_id = $stu_id", null, null, null);
     $result = $obj->getResult();

     $name = $obj->escapeString($_POST['name']);
     $stu_id = $_SESSION['admission_s_id'];
     // Culcutta time zone
     $dt = new DateTime("now", new DateTimeZone('Asia/Calcutta'));
     $added_on = $dt->format('d-m-Y, H:i:s');

     if (count($result) > 0) {
          // Not Empty
          $obj->update("payment", ['added_on' => $added_on, 'name' => $name, 'payment_status' => 'Pending', 'payment_id' => 'Offline'], "stu_id = '$stu_id'");
     } else {
          $obj->insert("payment", ['stu_id' => $stu_id, 'name' => $name, 'amount' => '00', 'payment_status' => 'Pending', 'payment_id' => 'Offline', 'added_on' => $added_on]);
     }
     $GetRes = $obj->getResult();
     if ($GetRes[0] == 'success') {
          $obj->update('registration', ['status' => '6'], "s_id = '$stu_id'");
          $Update_result = $obj->getResult();
          if ($Update_result[0] == "success") {
               $_SESSION['admission_status'] = '6';
               echo json_encode(array('status' => 'success'));
          } else {
               echo json_encode(array('status' => 'error', 'msg' => 'Status updated failed.'));
          }
     } else {
          echo json_encode(array('status' => 'error', 'msg' => 'Cant update offline mode.'));
     }
}
