<?php
include('header.php');

if (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 5) {
    include('sidebar.php');
    $Addobj->select("registration", "*", "s_id = '{$_SESSION['admission_s_id']}'");
    $result = $Addobj->getResult();

    $Addobj->select("personal_details", "*", "s_id = '{$_SESSION['admission_s_id']}'");
    $result2 = $Addobj->getResult();

?>

    <div class="card">
        <div class="card-body">
            <span class="fw-bolder fs-5"><u>Payment:</u></span>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-responsive table-borderless fw-bolder">
                        <tbody>
                            <tr>
                                <td scope="row">Name:</td>
                                <td id="name"><?php echo $result[0]['fname'] . ' ' . $result[0]['lname']  ?></td>
                            </tr>
                            <tr>
                                <td scope="row">Mobile:</td>
                                <td><?php echo $result[0]['mobile'] ?></td>
                            </tr>
                            <tr>
                                <td scope="row">Email:</td>
                                <td><?php echo $result[0]['email'] ?></td>
                            </tr>
                            <tr>
                                <td scope="row">Course:</td>
                                <td><?php echo $result2[0]['course'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span>
                        <h6 class="text-danger">
                            *** To process with the payment for admission fee please click on the <strong>'Pay Now'</strong> button below o in case you want to cancel the payment then click the <strong>'Cencel'</strong> button.
                        </h6>
                    </span>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-default">
                                <tr>
                                    <th>Purpose</th>
                                    <th>Fess</th>
                                    <th>Payment Gateway</th>
                                    <th>Payment Methods</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Admission</td>
                                    <td>5000.00</td>
                                    <td>Razorpay</td>
                                    <td>
                                        <select class="form-control" id="payment_option">
                                            <option selected disabled value="">Select Method</option>
                                            <option value="online">Online</option>
                                            <option selected value="offline">Offline</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success NextBtn btn-sm" id="pay_now">Next</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
include('footer.php') ?>