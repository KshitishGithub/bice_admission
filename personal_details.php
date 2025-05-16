<?php
include('header.php');

if (isset($_SESSION['admission_name']) && $_SESSION['admission_status'] == 1) {
     include('sidebar.php');

     if (isset($_SESSION['Edit_Mode'])) {
          $objAdd = new Admission();
          $stu_id = $_SESSION['admission_s_id'];
          $objAdd->select('personal_details', '*', "s_id = $stu_id");
          $res = $objAdd->getResult();
     } else {
          $res[0]['last_qualification'] = '';
          $res[0]['passing_year'] = '';
          $res[0]['ex_course'] = '';
          $res[0]['aadhar'] = '';
          $res[0]['height'] = '';
          $res[0]['weight'] = '';
          $res[0]['chest'] = '';
          $res[0]['com_know'] = '';
     }
?>
     <div class="card">
          <div class="card-body">
               <h4 class="card-title"><u><?php echo isset($_SESSION['Edit_Mode']) ? "Edit "  : "" ?>Personal Details</u></h4>
               <p class="text-danger">All fields are required.</p>
               <form class="forms-sample" id="personal_details">
                    <div class="row">
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Gander<span class="text-danger">*</span></label>
                                   <?php
                                   if (isset($res[0]['gander'])) {
                                        $male = '';
                                        $female = '';
                                        $others = '';
                                        echo "<select name='gander' class='form-control' id='gander'>";
                                        if ($res[0]['gander'] == 'Male') {
                                             $male = 'selected';
                                        } elseif ($res[0]['gander'] == 'Female') {
                                             $female = 'selected';
                                        } elseif ($res[0]['gander'] == 'Others') {
                                             $others = 'selected';
                                        }
                                        echo "<option disabled value=''>--Select Gander--</option>
                                                       <option $male value='Male'>Male</option>
                                                       <option $female value='Female'>Female</option>
                                                       <option $others value='Others'>Others</option>
                                                  </select>";
                                   } else {
                                        echo "<select name='gander' class='form-control' id='gander'>
                                                       <option selected disabled value=''>--Select Gander--</option>
                                                       <option value='Male'>Male</option>
                                                       <option value='Female'>Female</option>
                                                       <option value='Others'>Others</option>
                                                  </select>";
                                   }
                                   ?>
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Category<span class="text-danger">*</span></label>
                                   <?php
                                   if (isset($res[0]['category'])) {
                                        $sc = "";
                                        $st = "";
                                        $obc_a = "";
                                        $obc_b = "";
                                        $others = "";
                                        $general = "";
                                        echo '<select name="category" id="category" class="form-control">';
                                        if ($res[0]['category'] == "SC") {
                                             $sc = "selected";
                                        } elseif ($res[0]['category'] == "ST") {
                                             $st = "selected";
                                        } elseif ($res[0]['category'] == "OBC-A") {
                                             $obc_a = "selected";
                                        } elseif ($res[0]['category'] == "OBC-B") {
                                             $obc_b = "selected";
                                        } elseif ($res[0]['category'] == "OTHERS") {
                                             $others = "selected";
                                        } elseif ($res[0]['category'] == "GENERAL") {
                                             $general = "selected";
                                        }
                                        echo "<option disabled value=''>--Select Category--</option>
                                                       <option $sc value='SC'>SC</option>
                                                       <option $st value='ST'>ST</option>
                                                       <option $obc_a value='OBC-A'>OBC-A</option>
                                                       <option $obc_b value='OBC-B'>OBC-B</option>
                                                       <option $others value='OTHERS'>OTHERS</option>
                                                       <option $general value='GENERAL'>GENERAL</option>
                                                  </select>";
                                   } else {
                                        echo "<select name='category' id='category' class='form-control'>
                                                       <option selected disabled value=''>--Select Category--</option>
                                                       <option value='SC'>SC</option>
                                                       <option value='ST'>ST</option>
                                                       <option value='OBC-A'>OBC-A</option>
                                                       <option value='OBC-B'>OBC-B</option>
                                                       <option value='OTHERS'>OTHERS</option>
                                                       <option value='GENERAL'>GENERAL</option>
                                                  </select>";
                                   }
                                   ?>
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Religion<span class="text-danger">*</span></label>
                                   <?php
                                   if (isset($res[0]['religion'])) {
                                        $hindu = '';
                                        $islam = '';
                                        $chiris = '';
                                        $others = '';
                                        echo "<select name='religion' id='religion' class='form-control'>";
                                        if ($res[0]['religion'] == "Hinduism") {
                                             $hindu = 'selected';
                                        } elseif ($res[0]['religion'] == "Islam") {
                                             $islam = 'selected';
                                        } elseif ($res[0]['religion'] == "Chiristianity") {
                                             $chiris = 'selected';
                                        } elseif ($res[0]['religion'] == "Others") {
                                             $others = 'selected';
                                        }
                                        echo "<option disabled value=''>--Select Religion--</option>
                                                  <option $hindu value='Hinduism'>Hinduism</option>
                                                  <option $islam value='Islam'>Islam</option>
                                                  <option $chiris value='Chiristianity'>Chiristianity</option>
                                                  <option $others value='Others'>Others</option>
                                             </select>";
                                   } else {
                                        echo "<select name='religion' id='religion' class='form-control'>
                                                  <option selected disabled value=''>--Select Religion--</option>
                                                  <option value='Hinduism'>Hinduism</option>
                                                  <option value='Islam'>Islam</option>
                                                  <option value='Chiristianity'>Chiristianity</option>
                                                  <option value='Others'>Others</option>
                                             </select>";
                                   }
                                   ?>
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Course<span class="text-danger">*</span></label>
                                   <?php
                                   $obj->select('course', '*', null, null, 'course ASC');
                                   $result = $obj->getResult();
                                   if (isset($res[0]['course'])) {
                                        echo '<select class="form-control" name="course" id="course">
                                                   <option disabled value="" class="text-center">-- Select Course --</option>';
                                        foreach ($result as list('id' => $id, 'course' => $course)) {
                                             if ($course == $res[0]['course']) {
                                                  echo "<option selected value=" . $course . ">" . $course . "</option>";
                                             } else {
                                                  echo "<option value=" . $course . ">" . $course . "</option>";
                                             }
                                        }
                                        echo "</select>";
                                   } else {
                                        echo '<select class="form-control" name="course" id="course">
                                                       <option selected disabled value="" class="text-center">-- Select Course --</option>';
                                        foreach ($result as list('id' => $id, 'course' => $course)) {
                                             echo "<option value=" . $course . ">" . $course . "</option>";
                                        }
                                        echo "</select>";
                                   }
                                   ?>

                                   <!-- <select class="form-control" name="course" id="course">
                                        <option selected disabled value="" class="text-center">-- Select Course --</option> -->
                                   <?php
                                   // foreach ($result as list('course_id' => $course_id, 'course' => $course)) {
                                   //      echo "<option value=" . $course . ">" . $course . "</option>";
                                   // }
                                   ?>
                                   <!-- </select> -->
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Batch</label>
                                   <select class="form-control" name="batch" id="batch">
                                        <option disabled value="" class="text-center">-- Batchs --</option>
                                        <?php
                                        $obj->select('batchs', '*', null, null, 'batchs ASC');
                                        $batch_res = $obj->getResult();
                                        foreach ($batch_res as list('id' => $id, 'batchs' => $batchs, 'active_batch' => $active_batch)) {
                                             if ($active_batch == 1) {
                                                  echo "<option selected value=" . $batchs . " id=" . $id . ">" . $batchs . "</option>";
                                             }
                                        }
                                        ?>
                                   </select>
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Last Qualification<span class="text-danger">*</span></label>
                                   <input type="text" class="form-control mt-2" name="last_qualification" id="last_qualification" placeholder="Enter Last Qualification" value="<?php echo $res[0]['last_qualification'] !== '' ? $res[0]['last_qualification'] : ""  ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Year of passing<span class="text-danger">*</span></label>
                                   <input type="number" class="form-control mt-2" name="passing_year" id="passing_year" placeholder="Enter Year of Passing" value="<?php echo $res[0]['passing_year'] !== '' ? $res[0]['passing_year'] : ""  ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Others Qualification</label>
                                   <input type="text" class="form-control mt-2" name="ex_course" id="ex_course" placeholder="Enter others qualification" value="<?php echo $res[0]['ex_course'] !== '' ? $res[0]['ex_course'] : ""  ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Aadhar<span class="text-danger">*</span></label>
                                   <input type="number" class="form-control mt-2" name="aadhar" id="aadhar" placeholder="Enter Aadhar Card Number" value="<?php echo $res[0]['aadhar'] !== '' ? $res[0]['aadhar'] : ""  ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Height<small class="text-danger"> cm</small></label>
                                   <input type="number" class="form-control mt-2" name="height" id="height" placeholder="Enter Height" value="<?php echo $res[0]['height'] !== '' ? $res[0]['height'] : ""  ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Weight<small class="text-danger"> kg</small></label>
                                   <input type="number" class="form-control mt-2" name="weight" id="weight" placeholder="Enter Weight" value="<?php echo $res[0]['weight'] !== '' ? $res[0]['weight'] : ""  ?>">
                              </div>
                         </div>
                         <div class="col-md-6">
                              <div class="form-group">
                                   <label for="">Chest<small class="text-danger"> cm</small></label>
                                   <input type="number" class="form-control mt-2" name="chest" id="chest" placeholder="Enter Chest" value="<?php echo $res[0]['chest'] !== '' ? $res[0]['chest'] : ""  ?>">
                              </div>
                         </div>
                         <div class="offset-6"></div>
                         <div class="col-md-6">
                              <?php
                              if ($res[0]['com_know'] == 'on') {
                                   echo '<div class="form-check form-check-primary">
                                   <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="computer_knowledge" checked>
                                        Basic knowledge of computer course ?
                                        <i class="input-helper"></i>
                                   </label>
                              </div>';
                              } else {
                                   echo '<div class="form-check form-check-primary">
                                   <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="computer_knowledge">
                                        Basic knowledge of computer course ?
                                        <i class="input-helper"></i>
                                   </label>
                              </div>';
                              }

                              ?>
                         </div>
                    </div>
                    <div class="row">
                         <button type="reset" class="btn btn-primary mx-auto col-md-2">Reset</button>
                         <?php
                         if (isset($_SESSION['Edit_Mode'])) {
                              echo '<input type="submit" name="submit" value="Update" class="btn btn-info mx-auto col-md-2">';
                         } else {
                              echo '<input type="submit" name="submit" value="Submit" class="btn btn-success mx-auto col-md-2">';
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