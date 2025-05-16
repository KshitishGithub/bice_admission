<?php
include("database.php");
$obj = new Database();

$oldpass = $obj->escapeString($_POST['oldpass']);
$newpass = $obj->escapeString($_POST['newpass']);
$cnewpass = $obj->escapeString($_POST['cnewpass']);

if ($newpass == $cnewpass) {
    session_start();
    $email = $_SESSION['admission_email'];
    $obj->rawsql("SELECT pass FROM registration WHERE email = '$email'");
    $result = $obj->getResult();
    if (count($result) > 0) {
        $fetchPass = $result[0]['pass'];
        $veryfyPass = password_verify($oldpass, $fetchPass);
        if ($veryfyPass) {
            $hashpass = password_hash($cnewpass, PASSWORD_BCRYPT);
            $obj->update("registration", ["pass" => "$hashpass"], "email = '$email'");
            $result1 = $obj->getResult();
            if (count($result1) > 0) {
                echo json_encode(array('status' => 'success', 'msg' => 'Password Updated Succssfully .'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'Current Password does not matched.'));
        }
    }
} else {
    echo json_encode(array('status' => 'error', 'msg' => 'Confirm Password does not matched.'));
}
