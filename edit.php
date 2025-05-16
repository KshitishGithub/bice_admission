<?php  
session_start();

if ($_SESSION['admission_status'] == 4) {
     $_SESSION['Edit_Mode'] = true;
     $_SESSION['admission_status'] = 1;
     header('location:index.php');
}

?>