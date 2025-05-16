<?php
include('header.php');

if (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 2) {
     include('sidebar.php');
     //Edit Mode
     if (isset($_SESSION['Edit_Mode'])) {
          $obj = new Admission();
          $stu_id = $_SESSION['admission_s_id'];
          $obj->select('comunication', '*', "s_id = $stu_id");
          $res = $obj->getResult();
     } else {
          $res[0]['vill'] = '';
          $res[0]['po'] = '';
          $res[0]['locality'] = '';
          $res[0]['ps'] = '';
          $res[0]['pin'] = '';
          $res[0]['dist'] = '';
          $res[0]['state'] = '';
          $res[0]['country'] = '';
     }
     // echo '<pre>';
     // print_r($res);
     // die;
?>

     <div class="card">
          <div class="card-body">
               <h4 class="card-title"><u><?php echo isset($_SESSION['Edit_Mode']) ? "Edit "  : "" ?>Address Details</u></h4>
               <p class="text-danger">All fields are required.</p>
               <form id="comunication_form">
                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Village<span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="vill" id="vill" placeholder="Enter Village" value="<?php echo $res[0]['vill'] !== '' ? $res[0]['vill'] : '' ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Locality</label>
                                   <input type="text" class="form-control" name="locality" id="locality" placeholder="Enter Locality" value="<?php echo $res[0]['locality'] !== '' ? $res[0]['locality'] : '' ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Post Office<span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="po" id="po" placeholder="Enter Post Office" value="<?php echo $res[0]['po'] !== '' ? $res[0]['po'] : '' ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Police Station<span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="ps" id="ps" placeholder="Enter Police Station" value="<?php echo $res[0]['ps'] !== '' ? $res[0]['ps'] : '' ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Pin<span class="text-danger">*</span></label>
                                   <input type="number" class="form-control" name="pin" id="pin" placeholder="Enter Pin" value="<?php echo $res[0]['pin'] !== '' ? $res[0]['pin'] : '' ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">District<span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="dist" id="dist" placeholder="Enter District" value="<?php echo $res[0]['dist'] !== '' ? $res[0]['dist'] : '' ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">State<span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="state" id="state" value="<?php echo $res[0]['state'] !== '' ? $res[0]['state'] : 'West Bengal' ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Country<span class="text-danger">*</span></label>
                                   <input type="text" class="form-control" name="country" id="country" value="<?php echo $res[0]['country'] !== '' ? $res[0]['country'] : 'India' ?>">
                              </div>
                         </div>
                         <button type="reset" class="btn btn-secondary mx-auto col-md-2">Reset</button>
                         <?php
                         if (isset($_SESSION['Edit_Mode'])) {
                         ?>
                              <input type="submit" name="submit" value="Update" class="btn btn-success col-md-1 mx-auto">
                         <?php
                         } else {
                         ?>
                              <input type="submit" name="submit" value="Submit" class="btn btn-success col-md-1 mx-auto">
                         <?php
                         }
                         ?>
                    </div>
               </form>
          </div>
     </div>



<?php
}
include('footer.php');
?>