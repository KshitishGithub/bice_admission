<!doctype html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
     <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
     <link rel="stylesheet" href="assets/style.css">
     <title>Account Activate</title>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
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

     <div class="container mt-5">
          <div class="row">
               <div class="col-md-6 offset-md-3 bg-light shadow-lg rounded">
                    <form action="" method="post" class="p-3">
                         <h3>Account Activate:</h3>
                         <div class="form-group my-3">
                              <label for="">Email<span class="text-danger">*</span></label>
                              <input type="email" class="form-control" name="email" placeholder="Enter Email">
                              <button type="button" class="btn btn-sm btn-primary my-2">Get OTP</button><br>
                              <label for="">Enter OTP <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="otp" placeholder="Enter OTP">
                         </div>
                         <a href="index.php" class="btn btn-info">Back</a>
                         <input type="submit" name="submit" value="Submit" class="btn btn-success float-end">
                    </form>
               </div>
          </div>
     </div>



</body>

</html>