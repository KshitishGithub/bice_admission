<?php
include('database.php');
$obj = new Admission();
$admin = new Database();

$id = $obj->escapeString($_POST['id']);
$currentYear = $obj->escapeString($_POST['year']) ?? date('Y');

// Fetch student details
$obj->rawsql("SELECT * FROM registration r 
    INNER JOIN fresh_students f ON r.s_id = f.s_id 
    INNER JOIN payment p ON r.s_id = p.stu_id 
    WHERE f.s_id = $id");
$result = $obj->getResult();

// Get all paid months from fees_collection table
$admin->rawsql("SELECT months FROM fees_collection WHERE student_id = $id AND year = $currentYear");
$FeesPaidMonths = $admin->getResult();

// Merge all paid months from multiple payments
$paidMonths = [];
foreach ($FeesPaidMonths as $row) {
    if (!empty($row['months'])) {
        $decodedMonths = json_decode($row['months'], true) ?? [];
        $paidMonths = array_merge($paidMonths, $decodedMonths);
    }
}
$paidMonths = array_unique($paidMonths); // Remove duplicate months

$months = [
    'jan' => 'January', 'feb' => 'February', 'mar' => 'March', 'apr' => 'April',
    'may' => 'May', 'jun' => 'June', 'jul' => 'July', 'aug' => 'August',
    'sep' => 'September', 'oct' => 'October', 'nov' => 'November', 'dec' => 'December'
];

echo '<div class="modal-header bg-light">
        <h5 class="modal-title" id="staticBackdropLabel">Collect Fees</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card-body">
            <div class="form-group">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td width="50%">Name:</td>
                            <td>' . htmlspecialchars($result[0]['fname']) . ' ' . htmlspecialchars($result[0]['lname']) . '</td>
                        </tr>
                        <tr>
                            <td>Mobile:</td>
                            <td>+91-' . htmlspecialchars($result[0]['mobile']) . '</td>
                        </tr>
                        <tr>
                            <td>Joining Date:</td>
                            <td>' . htmlspecialchars($result[0]['added_on']) . '</td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="student_id" id="student_id" value="' . htmlspecialchars($result[0]['s_id']) . '">
                <div class="year-selector">
                    <label for="year">Select Year:</label>
                    <select id="year" name="year" class="form-control">';
                    
                    for ($i = 2023; $i <= date('Y'); $i++) {
                        $selected = ($currentYear == $i) ? 'selected' : '';
                        echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                    }
                    echo '</select>
                </div>
                <div class="month-checkboxes">';

// Display months with disabled style if already paid
foreach ($months as $key => $month) {
    $paidClass = in_array($key, $paidMonths) ? 'paid disabled' : '';
    echo '<span class="month ' . $paidClass . '" data-value="' . $key . '">' . $month . '</span>';
}

echo '</div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary modal_close" data-bs-dismiss="modal"><i class="bi bi-x-lg mr-1"></i>Close</button>
        <button type="submit" id="collectFeeBtn" class="btn btn-primary"><i class="bi bi-currency-rupee mr-1"></i>Collect</button>
    </div>';
?>

<style>
    .year-selector {
        margin-bottom: 10px;
    }
    .month-checkboxes {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    .month {
        padding: 5px 10px;
        border: 1px solid #ccc;
        cursor: pointer;
        border-radius: 5px;
    }
    .month.selected {
        background-color: green;
        color: white;
    }
    .month.paid {
        background-color: yellow;
        color: black;
        cursor: not-allowed;
        pointer-events: not-allowed;
    }
</style>

<script>
    document.querySelectorAll('.month').forEach(month => {
        month.addEventListener('click', function() {
            if (!this.classList.contains('paid')) {
                this.classList.toggle('selected');
            }
        });
    });

</script>
