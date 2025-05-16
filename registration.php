<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>Registraion</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="images/android-chrome-192x192.png" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
    <!-- Loading Spinner -->
    <div id="overlayer" class="container-fluid" style="display: none;">
        <div class="row">
            <div id="loading">
                <img src="assets/img/hug.gif">
                <span>Loading....</span>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand mr-auto" href="#">
                <img src="assets/img/logo.png" alt="Bootstrap" width="80" height="40">
            </a>
            <ul class="navbar-nav mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Welcome <span class="fw-bold">Student</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-md-5">
        <div class="row pb-5">
            <div class="col-md-8 col-12 offset-md-2 bg-light shadow-lg rounded">
                <form method="post" class="p-3" id="reg_form">
                    <div class="alert alert-danger alert-dismissible fade" role="alert" style="display:none;">
                    </div>
                    <!-- <div id="alertBox" class="col-12 alert alert-danger" role="alert"></div> -->
                    <table class="table table-responsive table-borderless">
                        <tbody>
                            <h3>Registration Form:</h3>
                            <tr>
                                <td scope="row" class="text-end">Name<span class="text-danger">*</span></td>
                                <td><input type="text" class="form-control" name="fname" id="fname" placeholder="First Name"></td>
                                <td><input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name"></td>
                            </tr>
                            <tr>
                                <td scope="row" class="text-end">Father's: Name</td>
                                <td colspan="2"><input type="text" class="form-control" name="FatherName" id="father_name" id="father_name" placeholder="Fathers' name"> </td>
                            </tr>
                            <tr>
                                <td scope="row" class="text-end">Spouse Name</td>
                                <td colspan="2"><input type="text" class="form-control" name="SpouseName" id="spouse_name" placeholder="Spouse name"> </td>
                            </tr>
                            <tr>
                                <td scope="row" class="text-end">Mothers' Name<span class="text-danger">*</span></td>
                                <td colspan="2"><input type="text" class="form-control" name="MotherName" id="mother_name" placeholder="Mothers' name"> </td>
                            </tr>
                            <tr>
                                <td scope="row" class="text-end">Mobile<span class="text-danger">*</span></td>
                                <td colspan="2"><input type="number" pattern="0-9" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile"> </td>
                            </tr>
                            <tr>
                                <td scope="row" class="text-end">Gurdain Mobile<span class="text-danger">*</span></td>
                                <td colspan="2"><input type="number" pattern="0-9" class="form-control" name="gurdain_mobile" id="gurdain_mobile" placeholder="Enter Gurdain Mobile"> </td>
                            </tr>
                            <tr>
                                <td scope="row" class="text-end">Email<span class="text-danger">*</span></td>
                                <td colspan="2"><input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" autocomplete="off"> </td>
                            </tr>
                            <tr>
                                <td scope="row" class="text-end">Date of birth<span class="text-danger">*</span></td>
                                <td colspan="2"><input type="text" class="form-control datepicker" id="dob" name="dob" data-inputmask='"mask": "99-99-9999"' data-mask> </td>
                            </tr>
                            <tr>
                                <td scope="row" class="text-end">Password<span class="text-danger">*</span></td>
                                <td><input type="password" class="form-control" name="newpassword" id="newpass" placeholder="New Password" autocomplete="off"></td>
                                <td><input type="password" class="form-control" name="confirmpassword" id="cnewpass" placeholder="Confirm Password" autocomplete="off"></td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="index.php" class="btn btn-info">Back</a>
                    <input type="submit" name="submit" value="Submit" id="submit" class="btn btn-success float-end">
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Input Mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    <script src="assets/js/registration.js"></script>
    <script>
    $(document).ready(function() {
            $('[data-mask]').inputmask();
        });
</script>
</body>

</html>


<!-- Modal -->
<div class="modal fade" id="modal1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"><u>Verify Registration Form</u></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td width='50%'><label>Name : </label></td>
                            <td><span id="name"></span></td>
                        </tr>
                        <tr>
                            <td><label>Father's Name : </label></td>
                            <td><span id="f_name"></span></td>
                        </tr><tr>
                            <td><label>Spouse Name : </label></td>
                            <td><span id="s_name"></span></td>
                        </tr>
                        <tr>
                            <td><label>Mother's Name : </label></td>
                            <td><span id="m_name"></span></td>
                        </tr>
                        <tr>
                            <td><label>Mobile : </label></td>
                            <td><span id="m_number"></span></td>
                        </tr>
                        <tr>
                            <td><label>Gurdain Mobile : </label></td>
                            <td><span id="g_mobile"></span></td>
                        </tr>
                        <tr>
                            <td><label>Email : </label></td>
                            <td><span id="e_mail"></span></td>
                        </tr>
                        <tr>
                            <td><label>Date of Birth : </label></td>
                            <td><span id="d_o_b"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <small class="text-danger"><b>Note:</b> Once you submit the form you can't change any data. </small>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" id="save-btn" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>