<?php
session_start();
include("../../admin/php_files/database.php");
$obj = new Admission();

$stu_id = $_SESSION['admission_s_id'];
$old_photo = $obj->escapeString($_POST['old_photo']);
$old_sig = $obj->escapeString($_POST['old_sig']);

$photo = $obj->escapeString($_FILES['photo']['name']);
$sig = $obj->escapeString($_FILES['sig']['name']);
// If set the session mode ...
if (isset($_SESSION['Edit_Mode'])) {
     // update photo
     if (!empty($photo)) { // checking photo
          // if photo is set 
          $file_name_photo = $_FILES['photo']['name'];
          $file_size_photo = $_FILES['photo']['size'];
          $file_tmp_photo = $_FILES['photo']['tmp_name'];
          $file_ext_photo = pathinfo($file_name_photo, PATHINFO_EXTENSION);
          $extentions = array("jpeg", "jpg", "JPG", "JPEG");

          if (!in_array($file_ext_photo, $extentions)) {
               echo json_encode(['status' => 'error', 'msg' => 'Image must have been jpg and jpeg format.']);
               exit;
          } elseif ($file_size_photo > 204800) {
               echo json_encode(['status' => 'error', 'msg' => 'Image must have less than 200kb or lower.']);
               exit;
          } else {
               $new_name_photo = mt_rand(111111, 999999) . "." . $file_ext_photo;
               $path_photo = "../photos/images/" . $new_name_photo;

               if (file_exists("../photos/images/" . $old_photo)) {
                    unlink("../photos/images/" . $old_photo);
               }

               if (!move_uploaded_file($file_tmp_photo, $path_photo)) {
                    echo json_encode(['status' => 'error', 'msg' => 'Image Can not be upload.']);
                    exit;
               }
          }
     }

     if (!empty($sig)) {  // Checking Signature 
          // if signature is set 
          $file_name_sig = $_FILES['sig']['name'];
          $file_size_sig = $_FILES['sig']['size'];
          $file_tmp_sig = $_FILES['sig']['tmp_name'];
          $file_ext_sig = pathinfo($file_name_sig, PATHINFO_EXTENSION);
          $extentions = array("jpeg", "jpg", "JPG", "JPEG");

          if (!in_array($file_ext_sig, $extentions)) {
               echo json_encode(['status' => 'error', 'msg' => 'Singature must have been jpg and jpeg format.']);
               exit;
          } elseif ($file_size_sig > 51200) {
               echo json_encode(['status' => 'error', 'msg' => 'Signature must have less than 50kb or lower.']);
               exit;
          } else {

               $new_name_sig = mt_rand(111111, 999999) . "." . $file_ext_sig;
               $path_sig = "../photos/signatures/" . $new_name_sig;

               if (file_exists("../photos/signatures/" . $old_sig)) {
                    unlink("../photos/signatures/" . $old_sig);
               }
               
               if (!move_uploaded_file($file_tmp_sig, $path_sig)) {
                    echo json_encode(['status' => 'error', 'msg' => 'Signature Can not be upload.']);
                    exit;
               }
          }
     }

     // Image and signatures are not set
     if (empty($photo)) {
          $new_name_photo = $old_photo;
     }
     if (empty($sig)) {
          $new_name_sig = $old_sig;
     }

     $obj->update("photo_signature", ["photo" => "{$new_name_photo}", "sig" => "{$new_name_sig}"], "s_id = '{$stu_id}'");

     $result = $obj->getResult();
     if ($result[0] == "success") {
          $_SESSION['admission_status'] = '4';
          echo json_encode(array('status' => 'success'));
     } else {
          echo json_encode(array('status' => 'error', 'msg' => 'Photo and Signature updated failed.'));
          exit;
     }
} // session check
