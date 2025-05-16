<?php
include('header.php');


if (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 6) {
    include('sidebar.php');
?>
    <div class="card">
        <?php
        $id = $_SESSION['admission_s_id'];
        $currentYear = date('Y');

        // Fetch student details
        $Addobj->rawsql("SELECT * FROM registration r 
    INNER JOIN fresh_students f ON r.s_id = f.s_id 
    INNER JOIN payment p ON r.s_id = p.stu_id 
    WHERE f.s_id = $id");
        $result = $Addobj->getResult();

        // Get all paid months from fees_collection table
        $obj->rawsql("SELECT months FROM fees_collection WHERE student_id = $id AND year = $currentYear");
        $FeesPaidMonths = $obj->getResult();

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
            'jan' => 'January',
            'feb' => 'February',
            'mar' => 'March',
            'apr' => 'April',
            'may' => 'May',
            'jun' => 'June',
            'jul' => 'July',
            'aug' => 'August',
            'sep' => 'September',
            'oct' => 'October',
            'nov' => 'November',
            'dec' => 'December'
        ];
        ?>
        <div class="modal-header bg-light">
            <h5 class="modal-title" id="staticBackdropLabel">Collect Fees</h5>
        </div>
        <form id="Pay_Now">
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-group">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td width="50%">Name:</td>
                                    <td><?= htmlspecialchars($result[0]['fname']) . ' ' . htmlspecialchars($result[0]['lname']) ?></td>
                                </tr>
                                <tr>
                                    <td>Mobile:</td>
                                    <td>+91-<?= htmlspecialchars($result[0]['mobile']) ?></td>
                                </tr>
                                <tr>
                                    <td>Joining Date:</td>
                                    <td><?= htmlspecialchars($result[0]['added_on']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="hidden" name="student_id" id="student_id" value="<?= htmlspecialchars($result[0]['s_id']) ?>">

                        <div class="year-selector">
                            <label for="year">Select Year:</label>
                            <select id="year" name="year" class="form-control">
                                <?php
                                for ($i = date('Y'); $i <= date('Y'); $i++) {
                                    $selected = ($currentYear == $i) ? 'selected' : '';
                                    echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                        <div class="month-checkboxes">
                            <?php
                            foreach ($months as $key => $month) {
                                $paidClass = in_array($key, $paidMonths) ? 'paid disabled' : '';
                                echo '<span class="month ' . $paidClass . '" data-value="' . $key . '">' . $month . '</span>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" id="collectFeeBtn" class="btn btn-secondary"><i class="bi bi-currency-rupee mr-1"></i>Pay Now</button>
            </div>
        </form>
    </div>
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
    <!-- Image Create CDN Link -->
    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        document.querySelectorAll('.month').forEach(month => {
            month.addEventListener('click', function() {
                if (!this.classList.contains('paid')) {
                    this.classList.toggle('selected');
                }
            });
        });
    </script>



    <script type="text/javascript">
        $(document).ready(function() {
            // ! when changeing year
            $(document).change("#year", function() {
                let year = $("#year").val();
                var id = $("#student_id").val();

                $.ajax({
                    url: "php_files/StudentsCollect.php",
                    type: "POST",
                    data: {
                        id: id,
                        year: year
                    },
                    beforeSend: function() {
                        $("#overlayer").show();
                    },
                    success: function(data) {
                        $("#overlayer").hide();
                        $("#LoadCollectStudents").html(data);
                        $("#StudentsFees").modal("show");
                    },
                });
            });

            // Handle form submission
            $(document).on("submit", "#Pay_Now", function(e) {
                e.preventDefault();

                // Get selected months
                var selectedMonths = [];
                $(".month.selected").each(function() {
                    selectedMonths.push($(this).data("value"));
                });

                // Validation: Ensure at least one month is selected
                if (selectedMonths.length === 0) {
                    toastr.error("Please select at least one month.");
                    return;
                }

                // Get form data
                var studentId = $("#student_id").val();
                var year = $("#year").val();
                var amount = selectedMonths.length * 500 * 100; // Converting to paisa

                // Razorpay payment options
                var options = {
                    key: "rzp_test_LzIrcpJhdUiUpR", // Replace with your actual Razorpay Key
                    amount: amount, // Amount in paisa
                    currency: "INR",
                    name: "BiCE Institute",
                    description: "Fee Payment",
                    image: "https://biceindia.in/assets/img/logo1.png",
                    handler: function(response) {
                        // Create form data for AJAX submission
                        var paymentFormData = new FormData();
                        paymentFormData.append("student_id", studentId);
                        paymentFormData.append("year", year);
                        paymentFormData.append("selected_months", selectedMonths.join(","));
                        paymentFormData.append("payment_id", response.razorpay_payment_id);
                        paymentFormData.append("payment_method", "online");

                        // Send payment data to the server
                        $.ajax({
                            type: "POST",
                            url: "php_files/monthly_payment_process.php",
                            data: paymentFormData,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                $("#overlayer").show();
                            },
                            success: function(data) {
                                $("#overlayer").hide();
                                try {
                                    var result = JSON.parse(data);
                                    if (result.status === "error") {
                                        toastr.error(result.msg);
                                    } else {
                                        Swal.fire(
                                            "Payment Received Successfully!",
                                            "Your payment was successful.",
                                            "success"
                                        ).then(() => {
                                            location.reload(); // Refresh UI after success
                                        });
                                    }
                                } catch (e) {
                                    toastr.error("Unexpected response from server.");
                                    console.error("Parsing error:", e);
                                }
                            },
                            error: function(xhr, status, error) {
                                $("#overlayer").hide();
                                toastr.error("Payment processing failed.");
                                console.error("AJAX Error:", error);
                            },
                        });
                    },
                    theme: {
                        color: "#3399cc"
                    },
                };

                var rzp = new Razorpay(options);
                rzp.open();
            });
        });
    </script>
<?php
}
include('footer.php');
?>