<?php
if(isset($_POST['data']) && $_POST['data']= "submit_preview"){
     session_start();
     include("../../admin/php_files/database.php");
     $obj = new Admission();

     $obj->select('payment', '*', "stu_id='{$_SESSION['admission_s_id']}'");
     $fetch_res = $obj->getResult();

     if (count($fetch_res) > 0) {

          $obj->update('registration', ['status' => '6'], "s_id = '{$_SESSION['admission_s_id']}'");
          $Update_result = $obj->getResult();
          if ($Update_result[0] == "success") {
               $_SESSION['admission_status'] = '6';
               echo json_encode(array('status' => 'success','code'=>'6'));
          } else {
               echo json_encode(array('status' => 'error', 'msg' => 'Status updated failed.'));
          }
     }else{

          $obj->update('registration', ['status' => '5'], "s_id = '{$_SESSION['admission_s_id']}'");
          $Update_result = $obj->getResult();
          if ($Update_result[0] == "success") {
               $_SESSION['admission_status'] = '5';
               echo json_encode(array('status' => 'success', 'code' => '5'));
               exit;
          } else {
               echo json_encode(array('status' => 'error', 'msg' => 'Status updated failed.'));
               exit;
          }
     }

     
     
}
?>