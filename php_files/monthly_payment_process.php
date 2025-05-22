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
    // Fetch student name and mobile
    $Addobj->rawsql("SELECT fname, lname, mobile FROM registration WHERE s_id = $student_id");
    $stu_data = $Addobj->getResult();
    $stu_name = $stu_data[0]['fname'] . ' ' . $stu_data[0]['lname'];
    $stu_mobile = $stu_data[0]['mobile'];

    // Month key mapping
    $monthsMap = [
        'jan' => 'JAN', 'feb' => 'FEB', 'mar' => 'MAR', 'apr' => 'APR',
        'may' => 'MAY', 'jun' => 'JUN', 'jul' => 'JUL', 'aug' => 'AUG',
        'sep' => 'SEP', 'oct' => 'OCT', 'nov' => 'NOV', 'dec' => 'DEC'
    ];

    $formattedMonths = [];
    foreach ($month as $m) {
        if (isset($monthsMap[$m])) {
            $formattedMonths[] = $monthsMap[$m];
        }
    }

    $monthString = implode(', ', $formattedMonths);

    // Send SMS
    $stu_details = [$stu_name, "$monthString - $year Rs:$totalAmount"];
    $obj->sendsms('EdBiCE', "148161", $stu_details, [$stu_mobile]);

    echo json_encode(['status' => 'success', 'msg' => 'Student fees collected.']);
} else {
    echo json_encode(['status' => 'error', 'msg' => 'Student fees collection failed due to some reason.']);
}