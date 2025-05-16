<?php
     session_start();
     include("../../admin/php_files/database.php");
     $obj = new Admission();

     $stu_id = $_SESSION['admission_s_id'];
     $photo = $obj->escapeString($_FILES['photo']['name']);
     $sig = $obj->escapeString($_FILES['sig']['name']);
     if($photo == ''){
          echo json_encode(array('status' => 'error', 'msg' => 'Photo is required.'));
          exit;
     } else if ($sig == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'Signature is required.'));
          exit;
     } else{

          $file_name_photo = $_FILES['photo']['name'];
          $file_size_photo = $_FILES['photo']['size'];
          $file_tmp_photo = $_FILES['photo']['tmp_name'];
          $file_ext_photo = pathinfo($file_name_photo, PATHINFO_EXTENSION);
          $extentions = array("jpeg", "jpg", "JPG", "JPEG");
         
          $file_name_sig = $_FILES['sig']['name'];
          $file_size_sig = $_FILES['sig']['size'];
          $file_tmp_sig = $_FILES['sig']['tmp_name'];
          $file_ext_sig = pathinfo($file_name_sig, PATHINFO_EXTENSION);

          if(!in_array($file_ext_photo, $extentions)){
               echo json_encode(['status' => 'error', 'msg' => 'Image must have been jpg and jpeg format.']);
               exit;
          }elseif ($file_size_photo > 204800) {
               echo json_encode(['status' => 'error', 'msg' => 'Image must have less than 200kb or lower.']);
               exit;
          }elseif (!in_array($file_ext_sig, $extentions)) {
               echo json_encode(['status' => 'error', 'msg' => 'Singature must have been jpg and jpeg format.']);
               exit;
          }elseif ($file_size_sig > 51200) {
               echo json_encode(['status' => 'error', 'msg' => 'Signature must have less than 50kb or lower.']);
               exit;
          }else{
               $new_name_photo = mt_rand(111111, 999999) . "." . $file_ext_photo;
               $new_name_sig = mt_rand(111111, 999999) . "." . $file_ext_sig;

               $path_photo = "../photos/images/" . $new_name_photo;
               $path_sig = "../photos/signatures/" . $new_name_sig;

               if (!move_uploaded_file($file_tmp_photo, $path_photo)) {
                    echo json_encode(['status' => 'error', 'msg' => 'Image Can not be upload.']);
                    exit;
               } elseif(!move_uploaded_file($file_tmp_sig, $path_sig)) {
                    echo json_encode(['status' => 'error', 'msg' => 'Signature Can not be upload.']);
                    exit;
               }else{
                    $obj->insert('photo_signature', ['photo' => $new_name_photo, 'sig' => $new_name_sig, 's_id' => $stu_id]);
                    $result = $obj->getResult();
                    if ($result[0] == "success") {
                         $obj->update('registration', ['status' => '4'], "s_id = '{$_SESSION['admission_s_id']}'");
                         $Update_result = $obj->getResult();
                         if ($Update_result[0] == "success") {
                              $_SESSION['admission_status'] = '4';
                              echo json_encode(array('status' => 'success'));
                         } else {
                              echo json_encode(array('status' => 'error', 'msg' => 'Status updated failed.'));
                              exit;
                         }
                    } else {
                         echo json_encode(array('status' => 'error', 'msg' => 'Personal data saved failed.'));
                         exit;
                    }
               }
          }

     }
