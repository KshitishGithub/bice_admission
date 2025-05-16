<?php
include("../../admin/php_files/database.php");
$obj = new Admission();
session_start();
$email = $obj->escapeString($_POST['email']);
$password = $obj->escapeString($_POST['password']);

     $obj->rawsql("SELECT * FROM registration WHERE email = '$email'");
     $result = $obj->getResult();
     if (count($result) > 0) {
          $fetchPass = $result[0]['pass'];
          $veryfyPass = password_verify($password, $fetchPass);
          if ($veryfyPass) {
               $_SESSION['admission_email'] = $result[0]['email'];
               $_SESSION['admission_mobile'] = $result[0]['mobile'];
               $_SESSION['admission_name'] = $result[0]['fname'];
               $_SESSION['admission_status'] = $result[0]['status'];
               $_SESSION['admission_s_id'] = $result[0]['s_id'];
               session_regenerate_id(false);  // to stop regenarate id use boolean value false
               echo json_encode(array('status' => 'success', 'msg' => 'Loged In successfully.'));
          } else {
          echo json_encode(array('status' => 'error', 'msg' => 'Invalid Credential.'));
     }
     } else {
          echo json_encode(array('status' => 'error', 'msg' => 'Invalid Credential.'));
     }

