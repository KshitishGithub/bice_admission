<?php
     session_start();
     include("../../admin/php_files/database.php");

     $obj = new Admission();

     $stu_id = $_SESSION['admission_s_id'];
     $gander = $obj->escapeString($_POST['gander']);
     $category = $obj->escapeString($_POST['category']);
     $religion = $obj->escapeString($_POST['religion']);
     $course = $obj->escapeString($_POST['course']);
     $batch = $obj->escapeString($_POST['batch']);
     $last_qualification = $obj->escapeString($_POST['last_qualification']);
     $passing_year = $obj->escapeString($_POST['passing_year']);
     $ex_course = $obj->escapeString($_POST['ex_course']);
     $aadhar = $obj->escapeString($_POST['aadhar']);
     $height = $obj->escapeString($_POST['height']);
     $weight = $obj->escapeString($_POST['weight']);
     $chest = $obj->escapeString($_POST['chest']);
     if(isset($_POST['computer_knowledge'])){
          $computer_knowledge = $obj->escapeString($_POST['computer_knowledge']);
     }else{
          $computer_knowledge = "";
     }

     
      if ($gander == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'Gander is required.'));
     } else if ($category == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'Category is required.'));
     } else if ($religion == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'Religion is required.'));
     } else if ($course == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'Course is required.'));
     } else if ($last_qualification == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'Last qualification is required.'));
     } else if ($passing_year == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'Year of passing is required.'));
     } if ($aadhar == '') {
          echo json_encode(array('status' => 'error', 'msg' => 'Aadhar is required.'));
     } else {
          if (isset($_SESSION['Edit_Mode'])) {
               // Update Data
               $stu_id = $_SESSION['admission_s_id'];

               $obj->update('personal_details', ['gander' => $gander, 'category' => $category, 'religion' => $religion, 'course' => $course, 'batch' => $batch, 'last_qualification' => $last_qualification, 'passing_year' => $passing_year, 'ex_course' => $ex_course, 'aadhar' => $aadhar, 'height' => $height, 'weight' => $weight, 'chest' => $chest, 'com_know' => $computer_knowledge], "s_id = '{$stu_id}'");
               $result = $obj->getResult();
               if ($result[0] == 'success') {
                    $_SESSION['admission_status'] = '2';
                    echo json_encode(array('status' => 'success'));
               }else{
                    echo json_encode(array('status' => 'error', 'msg' => 'Personal data updated failed.'));
               }
          }else{
               $obj->insert('personal_details',['gander' => $gander,'category' => $category,'religion' => $religion, 'course' => $course, 'batch' => $batch, 'last_qualification' => $last_qualification, 'passing_year' => $passing_year, 'ex_course' => $ex_course, 'aadhar' => $aadhar, 'height'=> $height, 'weight'=>$weight, 'chest'=>$chest, 'com_know' => $computer_knowledge,  's_id'=>$stu_id]);
               $result = $obj->getResult();
               if ($result[0] == "success") {
                    $obj->update('registration',['status'=>'2'],"s_id = '{$_SESSION['admission_s_id']}'");
                    $Update_result = $obj->getResult();
                    if ($Update_result[0] == "success") {
                         $_SESSION['admission_status'] = '2';
                         echo json_encode(array('status' => 'success'));
                    } else {
                         echo json_encode(array('status' => 'error', 'msg' => 'Status updated failed.'));
                    }
               } else {
                    echo json_encode(array('status' =>'error', 'msg' => 'Personal data saved failed.'));
               }
          }
     }
?>