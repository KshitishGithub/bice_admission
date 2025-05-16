<?php
include('database.php');
$obj = new Database();
$Addobj = new Admission();


$student_id = $obj->escapeString($_POST['student_id']);
$year = $obj->escapeString($_POST['year']);

$month = $_POST['selected_months']; // Expecting array from frontend

if (!is_array($month)) {
    $month = explode(',', $month); // Convert to array if comma-separated string
}

$totalMonths = count($month); // Count months
$totalAmount = $totalMonths * 500; // Calculate amount

// Convert months array to JSON format
$monthsJson = json_encode($month);

// Current date
$dt = new DateTime("now", new DateTimeZone('Asia/Calcutta'));
$date = $dt->format('d-m-Y, H:i:s');

// Insert into the database
$obj->insert('fees_collection', [
    "student_id" => $student_id,
    "year" => $year,
    "months" => $monthsJson, // Store JSON format
    "amount" => $totalAmount,
    "created_at" => $date,
    "payment_type" => 'Online',
    "transection_id" => $_POST['payment_id'],
    "payment_by" => 'Studnet',
]);

$result = $obj->getResult();
if ($result[0] == "success") {
    echo json_encode(array('status' => 'success', 'msg' => 'Student fees collected.'));
} else {
    echo json_encode(array('status' => 'error', 'msg' => 'Student fees collection failed due to some reason.'));
}
