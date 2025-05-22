<?php
class Database
{
    // Local Server 
    private $db_server = "localhost";
    private $username = "root";
    private $db_pass = "";
    private $db_database = "bice_admin";

    // Live Server 
    // private $db_server = "localhost";
    // private $username = "u875326553_bice";
    // private $db_pass = "!6m=!KG=V";
    // private $db_database = "u875326553_bice";



    private $conn = false;
    private $result = array();
    public $mysqli = "";
    private $myQuery = ""; // Debuging return


    //! Connetion on .. 
    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli($this->db_server, $this->username, $this->db_pass, $this->db_database);
            $this->conn = true;
            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }

    //! Insert Function ...
    public function insert($table, $params = array())
    {
        if ($this->tableExists($table)) {

            $table_columns =  implode(',', array_keys($params));
            $table_valuess =  implode("','", $params);

            $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_valuess')";

            $this->myQuery = $sql; // Pass back the SQL
            if ($this->mysqli->query($sql)) {
                array_push($this->result, "success");
                return true;
            } else {
                array_push($this->result, "failed");
                return false;
            }
        } else {
            return false;
        }
    }


    //! Update Function  ...
    public function update($table, $params = array(), $where = null)
    {
        if ($this->tableExists($table)) {

            $argus = array();
            foreach ($params as $key => $value) {
                $argus[] = "$key = '$value'";
            }
            $value = implode(',', $argus);
            $sql = "UPDATE $table SET $value";

            if ($where != null) {
                $sql .= " WHERE $where";
            }
            $this->myQuery = $sql; // Pass back the SQL
            if ($this->mysqli->query($sql)) {
                array_push($this->result, "success");
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }
    //! Select Function ...... 
    public function select($table, $row = "*", $WHERE = null, $JOIN = null,  $ORDER = null, $LIMIT =null)
    {
        
        if ($this->tableExists($table)) {

            $sql = "SELECT $row FROM $table";

            if ($WHERE != null) {
                $sql .= " WHERE $WHERE";
            }

            if ($JOIN != null) {
                $sql .= " JOIN $JOIN";
            }

            if ($ORDER != null) {
                $sql .= " ORDER BY $ORDER";
            }
            if ($LIMIT != null) {
                $sql .= " LIMIT $LIMIT";
            }
            $this->myQuery = $sql; // Pass back the SQL
        } else {
            return false;
        }
        $query = $this->mysqli->query($sql);
       
        if ($query) {
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            
            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }

        //! Pagination Function ...... 
    public function pagination($table, $WHERE = null, $JOIN = null, $LIMIT , $PAGE = null, $url ){
        
        if ($this->tableExists($table)) {

            $sql = "SELECT COUNT(*) FROM $table";

            if($WHERE != null){
               $sql .= " WHERE $WHERE ";
            } 
            if ($JOIN != null) {
                $sql .= " JOIN $JOIN ";
            }
            
            if($PAGE != null){
                $page = $PAGE;
            }else{
                $page = 1;
            }
            $query = $this->mysqli->query($sql);
            $total_records = $query->fetch_array();
            $total_records = $total_records[0];

            $total_page = ceil($total_records / $LIMIT);
            $outPut = "";
            $outPut .= "<nav aria-label='Page navigation example'>
                    <ul class='pagination justify-content-center'>";
                    if($page > 1 ){
                $outPut .= "<li class='page-item'><a class='page-link' data-page=". ($PAGE - 1) . " data-url=" . $url . " href='#'>Previous</a></li>";
                    }

                    if($total_records > $LIMIT){
                        for($i = 1; $i <= $total_page; $i++ ){
                            if($i == $page){
                                $class ="active";
                            }else{
                                $class = "";
                            }
                    $outPut .= "<li class='page-item $class'><a class='page-link' data-page=$i data-url=". $url ."  href='#'>$i</a></li>";
                        }
                    }
            if ($total_page > $page) {
                $outPut .= "<li class='page-item'><a class='page-link' data-page= " . ($page + 1) . " data-url=" . $url . " href='#'>Next</a></li>";
            }
                    $outPut .= "</ul>
                             </nav> ";

            echo $outPut;

        }else{
            return false;
        }
    }

    //! rawsql function .... 
    public function rawsql($sql)
    {
        $query = $this->mysqli->query($sql);
        $this->myQuery = $sql; // Pass back the SQL
        if ($query) {
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            return true;
        } else {
            return false;
        }
    }

    //!Delete Function ...... 
    public function delete($table, $where = null)
    {
        if ($this->tableExists($table)) {
            $sql = "DELETE FROM $table";
        }
        if ($where != null) {
            $sql .= " WHERE $where";
        }
        $this->myQuery = $sql; // Pass back the SQL
        if ($this->mysqli->query($sql)) {
            array_push($this->result, "success");
            return true;
        } else {
            array_push($this->result, "error");
            return false;
        }
    }

    //! Image Upload Function ////////// 
    public function ImageUpload($image,$upload_path)
    {
        if ($image['name'] !== '') {
            $file_name = $image['name'];
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            // $file_type = $image['type'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $extentions = array("jpeg", "jpg", "JPG", "JPEG", "pdf");
            if (in_array($file_ext, $extentions)) {
                if ($file_size < 1048576) {
                    $new_name = rand() . "." . $file_ext;
                    $path = $upload_path . $new_name;
                    if (move_uploaded_file($file_tmp, $path)) {

                        //! Insert file name in sql database...
                        $aadhar =  $_SESSION['aadhar'];
                        $sql = "UPDATE request SET imagename = '$new_name' WHERE aadhar = $aadhar ";
                        if ($this->mysqli->query($sql)) {
                            array_push($this->result, 'success');
                        } else {
                            array_push($this->result, $this->mysqli->error);
                            return false;
                        }
                    } else {
                        array_push($this->result, "Image Can not be upload.");
                    }
                } else {
                    array_push($this->result, "Image must have less than 1MB or lower.");
                }
            } else {
                array_push($this->result, "Image must have been jpg, jpeg and pdf format.");
            }
        } else {
            array_push($this->result, "Please Select File.");
        }
    }


    //! Table Exists...
    private function tableExists($table)
    {
        $sql = "SHOW TABLES FROM $this->db_database LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);
        if ($tableInDb) {
            if ($tableInDb->num_rows == 1) {
                return true;
            } else {
                array_push($this->result, "<h4>$table</h4>Does Not Exist in the database.");
                return false;
            }
        }
    }

    //! Send SMS....
    public function sendsms($header, $smsid, $value = [], $mobile = [])
    {
         $smsvalues = implode('|', $value);
         $mobile = implode(',',$mobile);
        
       $fields = array(
            "route" => "dlt",
            "sender_id" => "$header",
            "message" => "$smsid",
            "variables_values" =>$smsvalues,
            // "variables_values" => $value,
            "flash" => 0,
            "numbers" => $mobile,
        );
        // print_r($fields);
        // die();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization:hmlbFHwuQK79aBykpARfDrWtTJ5GvOc4Nj0Z1z3i6Cq2VxonXsFO1us5HXwavx6PIMWn7JDZTRmB4bor",
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            // echo "cURL Error #:" . $err;
            array_push($this->result, "failed");
        } else {
            //SMS send Successfully.. 
            array_push($this->result, "success");
        }
    }

    //! Email send funciton ........
    // public function sendmail($to, $subject, $body)
    // {
    //     $mail = new PHPMailer();
    //     $mail->SMTPDebug=3;
    //     $mail->IsSMTP();
    //     $mail->SMTPAuth = true;
    //     $mail->SMTPSecure = 'tls';
    //     $mail->Host = "smtp.gmail.com";
    //     $mail->Port = "587";
    //     $mail->IsHTML(true);
    //     $mail->CharSet = 'UTF-8';
    //     $mail->Username = "official.kshitish.com";
    //     $mail->Password = 'Kshitish@2761';
    //     $mail->SetFrom = "official.kshitish.com";
    //     $mail->Subject = $subject;
    //     $mail->Body = $body;
    //     $mail->AddAddress($to);
    //     $mail->SMTPOptions = array('ssl' => array(
    //             'verify_peer' => false,
    //             'verify_peer_name' => false,
    //             'allow_self_signed' => false
    //         ));
    //     if (!$mail->Send()) {
    //         array_push($this->result, $mail->ErrorInfo);
    //         // array_push($this->result, "Can't send email due to technical issues.");
    //     } else {
    //         array_push($this->result, "success");
    //     }
    // }
    //!Show result function ....
    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    //! show sql command .....
    public function getSql()
    {
        $val = $this->myQuery;
        $this->myQuery = array();
        echo $val;
    }

    //! Escape string
    public function escapeString($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $this->mysqli->real_escape_string($data);
    }


    //!Conection Close ..
    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli->close()) {
                $this->conn = false;
                return true;
            }
        } else {
            return false;
        }
    }
}
class Admission
{
    // Local Server 
    private $db_server = "localhost";
    private $username = "root";
    private $db_pass = "";
    private $db_database = "bice_admission";

    // Live Server 
    // private $db_server = "localhost";
    // private $username = "u875326553_bice_admission";
    // private $db_pass = "!6m=!KG=V";
    // private $db_database = "u875326553_bice_admission";



    private $conn = false;
    private $result = array();
    public $mysqli = "";
    private $myQuery = ""; // Debuging return


    //! Connetion on .. 
    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli($this->db_server, $this->username, $this->db_pass, $this->db_database);
            $this->conn = true;
            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }

    //! Insert Function ...
    public function insert($table, $params = array())
    {
        if ($this->tableExists($table)) {

            $table_columns =  implode(',', array_keys($params));
            $table_valuess =  implode("','", $params);

            $sql = "INSERT INTO $table ($table_columns) VALUES ('$table_valuess')";

            $this->myQuery = $sql; // Pass back the SQL
            if ($this->mysqli->query($sql)) {
                array_push($this->result, "success");
                return true;
            } else {
                array_push($this->result, "failed");
                return false;
            }
        } else {
            return false;
        }
    }
    //! Update Function  ..... 

    public function update($table, $params = array(), $where = null)
    {
        if ($this->tableExists($table)) {

            $argus = array();
            foreach ($params as $key => $value) {
                $argus[] = "$key = '$value'";
            }
            $value = implode(',', $argus);
            $sql = "UPDATE $table SET $value";

            if ($where != null) {
                $sql .= " WHERE $where";
            }
            $this->myQuery = $sql; // Pass back the SQL
            if ($this->mysqli->query($sql)) {
                array_push($this->result, "success");
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }
    //! Select Function ...... 
    public function select($table, $row = "*", $WHERE = null, $JOIN = null,  $ORDER = null, $LIMIT = null)
    {

        if ($this->tableExists($table)) {

            $sql = "SELECT $row FROM $table";

            if ($WHERE != null) {
                $sql .= " WHERE $WHERE";
            }

            if ($JOIN != null) {
                $sql .= " JOIN $JOIN";
            }

            if ($ORDER != null) {
                $sql .= " ORDER BY $ORDER";
            }
            if ($LIMIT != null) {
                $sql .= " LIMIT $LIMIT";
            }
            $this->myQuery = $sql; // Pass back the SQL
        } else {
            return false;
        }
        $query = $this->mysqli->query($sql);

        if ($query) {
            $this->result = $query->fetch_all(MYSQLI_ASSOC);

            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }

    //! Pagination Function ...... 
    public function pagination($table, $WHERE = null, $JOIN = null, $LIMIT, $PAGE = null, $url)
    {

        if ($this->tableExists($table)) {

            $sql = "SELECT COUNT(*) FROM $table";

            if ($WHERE != null) {
                $sql .= " WHERE $WHERE ";
            }
            if ($JOIN != null) {
                $sql .= " JOIN $JOIN ";
            }

            if ($PAGE != null) {
                $page = $PAGE;
            } else {
                $page = 1;
            }
            $query = $this->mysqli->query($sql);
            $total_records = $query->fetch_array();
            $total_records = $total_records[0];

            $total_page = ceil($total_records / $LIMIT);
            $outPut = "";
            $outPut .= "<nav aria-label='Page navigation example'>
                    <ul class='pagination justify-content-center'>";
            if ($page > 1) {
                $outPut .= "<li class='page-item'><a class='page-link' data-page=" . ($PAGE - 1) . " data-url=" . $url . " href='#'>Previous</a></li>";
            }

            if ($total_records > $LIMIT) {
                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $page) {
                        $class = "active";
                    } else {
                        $class = "";
                    }
                    $outPut .= "<li class='page-item $class'><a class='page-link' data-page=$i data-url=" . $url . "  href='#'>$i</a></li>";
                }
            }
            if ($total_page > $page) {
                $outPut .= "<li class='page-item'><a class='page-link' data-page= " . ($page + 1) . " data-url=" . $url . " href='#'>Next</a></li>";
            }
            $outPut .= "</ul>
                             </nav> ";

            echo $outPut;
        } else {
            return false;
        }
    }

    //! rawsql function .... 
    public function rawsql($sql)
    {
        $query = $this->mysqli->query($sql);
        $this->myQuery = $sql; // Pass back the SQL
        if ($query) {
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            return true;
        } else {
            return false;
        }
    }

    //!Delete Function ...... 
    public function delete($table, $where = null)
    {
        if ($this->tableExists($table)) {
            $sql = "DELETE FROM $table";
        }
        if ($where != null) {
            $sql .= " WHERE $where";
        }
        $this->myQuery = $sql; // Pass back the SQL
        if ($this->mysqli->query($sql)) {
            array_push($this->result, "success");
            return true;
        } else {
            array_push($this->result, "error");
            return false;
        }
    }

    //! Image Upload Function ////////// 
    public function ImageUpload($image, $upload_path)
    {
        if ($image['name'] !== '') {
            $file_name = $image['name'];
            $file_size = $image['size'];
            $file_tmp = $image['tmp_name'];
            // $file_type = $image['type'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $extentions = array("jpeg", "jpg", "JPG", "JPEG", "pdf");
            if (in_array($file_ext, $extentions)) {
                if ($file_size < 1048576) {
                    $new_name = rand() . "." . $file_ext;
                    $path = $upload_path . $new_name;
                    if (move_uploaded_file($file_tmp, $path)) {

                        //! Insert file name in sql database...
                        $aadhar =  $_SESSION['aadhar'];
                        $sql = "UPDATE request SET imagename = '$new_name' WHERE aadhar = $aadhar ";
                        if ($this->mysqli->query($sql)) {
                            array_push($this->result, 'success');
                        } else {
                            array_push($this->result, $this->mysqli->error);
                            return false;
                        }
                    } else {
                        array_push($this->result, "Image Can not be upload.");
                    }
                } else {
                    array_push($this->result, "Image must have less than 1MB or lower.");
                }
            } else {
                array_push($this->result, "Image must have been jpg, jpeg and pdf format.");
            }
        } else {
            array_push($this->result, "Please Select File.");
        }
    }


    //! Table Exists...
    private function tableExists($table)
    {
        $sql = "SHOW TABLES FROM $this->db_database LIKE '$table'";
        $tableInDb = $this->mysqli->query($sql);
        if ($tableInDb) {
            if ($tableInDb->num_rows == 1) {
                return true;
            } else {
                array_push($this->result, "<h4>$table</h4>Does Not Exist in the database.");
                return false;
            }
        }
    }

    //! Send SMS....
    public function sendsms($header, $smsid, $value = [], $mobile = [])
    {
        $smsvalues = implode('|', $value);
        $mobile = implode(',', $mobile);

        $fields = array(
            "route" => "dlt",
            "sender_id" => "$header",
            "message" => "$smsid",
            "variables_values" => $smsvalues,
            // "variables_values" => $value,
            "flash" => 0,
            "numbers" => $mobile,
        );
        // print_r($fields);
        // die();

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization:hmlbFHwuQK79aBykpARfDrWtTJ5GvOc4Nj0Z1z3i6Cq2VxonXsFO1us5HXwavx6PIMWn7JDZTRmB4bor",
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            // echo "cURL Error #:" . $err;
            array_push($this->result, "failed");
        } else {
            //SMS send Successfully.. 
            array_push($this->result, "success");
        }
    }

    //! Email send funciton ........
    // public function sendmail($to, $subject, $body)
    // {
    //     $mail = new PHPMailer();
    //     $mail->SMTPDebug=3;
    //     $mail->IsSMTP();
    //     $mail->SMTPAuth = true;
    //     $mail->SMTPSecure = 'tls';
    //     $mail->Host = "smtp.gmail.com";
    //     $mail->Port = "587";
    //     $mail->IsHTML(true);
    //     $mail->CharSet = 'UTF-8';
    //     $mail->Username = "official.kshitish.com";
    //     $mail->Password = 'Kshitish@2761';
    //     $mail->SetFrom = "official.kshitish.com";
    //     $mail->Subject = $subject;
    //     $mail->Body = $body;
    //     $mail->AddAddress($to);
    //     $mail->SMTPOptions = array('ssl' => array(
    //             'verify_peer' => false,
    //             'verify_peer_name' => false,
    //             'allow_self_signed' => false
    //         ));
    //     if (!$mail->Send()) {
    //         array_push($this->result, $mail->ErrorInfo);
    //         // array_push($this->result, "Can't send email due to technical issues.");
    //     } else {
    //         array_push($this->result, "success");
    //     }
    // }
    //!Show result function ....
    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    //! show sql command .....
    public function getSql()
    {
        $val = $this->myQuery;
        $this->myQuery = array();
        echo $val;
    }

    //! Escape string
    public function escapeString($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $this->mysqli->real_escape_string($data);
    }


    //!Conection Close ..
    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli->close()) {
                $this->conn = false;
                return true;
            }
        } else {
            return false;
        }
    }
}
