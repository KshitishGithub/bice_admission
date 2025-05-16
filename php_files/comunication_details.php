<?php
     session_start();
     include("../../admin/php_files/database.php");
     $obj = new Admission();

     $stu_id = $_SESSION['admission_s_id'];
     $vill = $obj->escapeString($_POST['vill']);
     $locality = $obj->escapeString($_POST['locality']);
     $po = $obj->escapeString($_POST['po']);
     $ps = $obj->escapeString($_POST['ps']);
     $dist = $obj->escapeString($_POST['dist']);
     $pin = $obj->escapeString($_POST['pin']);
     $state = $obj->escapeString($_POST['state']);
     $country = $obj->escapeString($_POST['country']);
     if($vill == ''){
          echo json_encode(array('status' => 'error', 'msg' => 'Village is required.'));
     } else if ($po == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'Post Ofiice is required.'));
     } else if ($ps == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'Police Station is required.'));
     } else if ($dist == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'District is required.'));
     } else if ($pin == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'PIN is required.'));
     } else if ($state == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'state is required.'));
     } else if ($country == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'Country is required.'));
     } else {
          if (isset($_SESSION['Edit_Mode'])) {
               // Update Data
               $stu_id = $_SESSION['admission_s_id'];
               $obj->update("comunication",["vill"=> $vill, "locality" => $locality, "po"=>$po, "ps"=>$ps, "dist"=>$dist, "pin"=>$pin, "state"=>$state, "country" => $country],"s_id = '{$stu_id}'");
               $_SESSION["admission_status"] = '3';
               echo json_encode(array('status' => 'success'));

          }else{
               // Save Data
               $obj->insert('comunication',['vill'=> $vill, 'locality' => $locality, 'po'=>$po, 'ps'=>$ps, 'dist'=>$dist, 'pin'=>$pin, 'state'=>$state, 'country' => $country, 's_id'=>$stu_id]);
               $result = $obj->getResult();
               if ($result[0] == "success") {
                    $obj->update('registration',['status'=>'3'],"s_id = '{$_SESSION['admission_s_id']}'");
                    $Update_result = $obj->getResult();
                    if ($Update_result[0] == "success") {
                         $_SESSION['admission_status'] = '3';
                         echo json_encode(array('status' => 'success'));
                    } else {
                         echo json_encode(array('status' => 'error', 'msg' => 'Status updated failed.'));
                    }
               } else {
                    echo json_encode(array('status' =>'error', 'msg' => 'Cominication failed.'));
               }
          }
     }
