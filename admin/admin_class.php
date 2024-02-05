<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		
			extract($_POST);		
			$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'password' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
				if($_SESSION['login_type'] != 1){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
					return 1;
			}else{
				return 3;
			}
	}
	function login_faculty(){
		
		extract($_POST);		
		$qry = $this->db->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM faculty where id_no = '".$id_no."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'password' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			return 1;
		}else{
			return 3;
		}
}
	function login2(){
		
			extract($_POST);
			if(isset($email))
				$username = $email;
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_SESSION['login_alumnus_id'] > 0){
				$bio = $this->db->query("SELECT * FROM alumnus_bio where id = ".$_SESSION['login_alumnus_id']);
				if($bio->num_rows > 0){
					foreach ($bio->fetch_array() as $key => $value) {
						if($key != 'passwors' && !is_numeric($key))
							$_SESSION['bio'][$key] = $value;
					}
				}
			}
			if($_SESSION['bio']['status'] != 1){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
				return 1;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = '$type' ";
		if($type == 1)
			$establishment_id = 0;
		$data .= ", establishment_id = '$establishment_id' ";
		$chk = $this->db->query("Select * from users where username = '$username' and id !='$id' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function signup(){
		extract($_POST);
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("INSERT INTO users set ".$data);
		if($save){
			$uid = $this->db->insert_id;
			$data = '';
			foreach($_POST as $k => $v){
				if($k =='password')
					continue;
				if(empty($data) && !is_numeric($k) )
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			if($_FILES['img']['tmp_name'] != ''){
							$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
							$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
							$data .= ", avatar = '$fname' ";

			}
			$save_alumni = $this->db->query("INSERT INTO alumnus_bio set $data ");
			if($data){
				$aid = $this->db->insert_id;
				$this->db->query("UPDATE users set alumnus_id = $aid where id = $uid ");
				$login = $this->login2();
				if($login)
				return 1;
			}
		}
	}
	function update_account(){
		extract($_POST);
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' and id != '{$_SESSION['login_id']}' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("UPDATE users set $data where id = '{$_SESSION['login_id']}' ");
		if($save){
			$data = '';
			foreach($_POST as $k => $v){
				if($k =='password')
					continue;
				if(empty($data) && !is_numeric($k) )
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			if($_FILES['img']['tmp_name'] != ''){
							$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
							$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
							$data .= ", avatar = '$fname' ";

			}
			$save_alumni = $this->db->query("UPDATE alumnus_bio set $data where id = '{$_SESSION['bio']['id']}' ");
			if($data){
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				$login = $this->login2();
				if($login)
				return 1;
			}
		}
	}

	function save_settings(){
		extract($_POST);
		$data = " name = '".str_replace("'","&#x2019;",$name)."' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['settings'][$key] = $value;
		}

			return 1;
				}
	}

	
	function save_course(){
		extract($_POST);
		$data = " course = '$course' ";
		$data .= ", description = '$description' ";
			if(empty($id)){
				$save = $this->db->query("INSERT INTO courses set $data");
			}else{
				$save = $this->db->query("UPDATE courses set $data where id = $id");
			}
		if($save)
			return 1;
	}
	function delete_course(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM courses where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_subject(){
		extract($_POST);
		$data = " subject = '$subject' ";
		$data .= ", description = '$description' ";
			if(empty($id)){
				$save = $this->db->query("INSERT INTO subjects set $data");
			}else{
				$save = $this->db->query("UPDATE subjects set $data where id = $id");
			}
		if($save)
			return 1;
	}
	function delete_subject(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM subjects where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_faculty(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k=> $v){
			if(!empty($v)){
				if($k !='id'){
					if(empty($data))
					$data .= " $k='{$v}' ";
					else
					$data .= ", $k='{$v}' ";
				}
			}
		}
			if(empty($id_no)){
				$i = 1;
				while($i == 1){
					$rand = mt_rand(1,99999999);
					$rand =sprintf("%'08d",$rand);
					$chk = $this->db->query("SELECT * FROM faculty where id_no = '$rand' ")->num_rows;
					if($chk <= 0){
						$data .= ", id_no='$rand' ";
						$i = 0;
					}
				}
			}

		if(empty($id)){
			if(!empty($id_no)){
				$chk = $this->db->query("SELECT * FROM faculty where id_no = '$id_no' ")->num_rows;
				if($chk > 0){
					return 2;
					exit;
				}
			}
			$save = $this->db->query("INSERT INTO faculty set $data ");
		}else{
			if(!empty($id_no)){
				$chk = $this->db->query("SELECT * FROM faculty where id_no = '$id_no' and id != $id ")->num_rows;
				if($chk > 0){
					return 2;
					exit;
				}
			}
			$save = $this->db->query("UPDATE faculty set $data where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_faculty(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM faculty where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_schedule(){
		extract($_POST);
		$data = " faculty_id = '$faculty_id' ";
		$data .= ", title = '$title' ";
		$data .= ", schedule_type = '$schedule_type' ";
		$data .= ", description = '$description' ";
		$data .= ", location = '$location' ";
		if(isset($is_repeating)){
			$data .= ", is_repeating = '$is_repeating' ";
			$rdata = array('dow'=>implode(',', $dow),'start'=>$month_from.'-01','end'=>(date('Y-m-d',strtotime($month_to .'-01 +1 month - 1 day '))));
			$data .= ", repeating_data = '".json_encode($rdata)."' ";
		}else{
			$data .= ", is_repeating = 0 ";
			$data .= ", schedule_date = '$schedule_date' ";
		}
		$data .= ", time_from = '$time_from' ";
		$data .= ", time_to = '$time_to' ";

		if(empty($id)){
			$save = $this->db->query("INSERT INTO schedules set ".$data);
		}else{
			$save = $this->db->query("UPDATE schedules set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_schedule(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM schedules where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function get_schecdule(){
		extract($_POST);
		$data = array();
		$qry = $this->db->query("SELECT * FROM schedules where faculty_id = 0 or faculty_id = $faculty_id");
		while($row=$qry->fetch_assoc()){
			if($row['is_repeating'] == 1){
				$rdata = json_decode($row['repeating_data']);
				foreach($rdata as $k =>$v){
					$row[$k] = $v;
				}
			}
			$data[] = $row;
		}
			return json_encode($data);
	}
	function delete_forum(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM forum_topics where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_comment(){
		extract($_POST);
		$data = " comment = '".htmlentities(str_replace("'","&#x2019;",$comment))."' ";

		if(empty($id)){
			$data .= ", topic_id = '$topic_id' ";
			$data .= ", user_id = '{$_SESSION['login_id']}' ";
			$save = $this->db->query("INSERT INTO forum_comments set ".$data);
		}else{
			$save = $this->db->query("UPDATE forum_comments set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_comment(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM forum_comments where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_event(){
		extract($_POST);
		$data = " title = '$title' ";
		$data .= ", schedule = '$schedule' ";
		$data .= ", content = '".htmlentities(str_replace("'","&#x2019;",$content))."' ";
		if($_FILES['banner']['tmp_name'] != ''){
						$_FILES['banner']['name'] = str_replace(array("(",")"," "), '', $_FILES['banner']['name']);
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['banner']['name'];
						$move = move_uploaded_file($_FILES['banner']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", banner = '$fname' ";

		}
		if(empty($id)){

			$save = $this->db->query("INSERT INTO events set ".$data);
		}else{
			$save = $this->db->query("UPDATE events set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_event(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM events where id = ".$id);
		if($delete){
			return 1;
		}
	}
	
	function participate(){
		extract($_POST);
		$data = " event_id = '$event_id' ";
		$data .= ", user_id = '{$_SESSION['login_id']}' ";
		$commit = $this->db->query("INSERT INTO event_commits set $data ");
		if($commit)
			return 1;

	}
	public function save_room() {
        extract($_POST);
        $data = " roomCODE = '$roomCODE' ";
        $data .= ", rm_buildingName = '$rm_buildingName' ";
        $data .= ", rm_Desc = '$rm_Desc' ";
        $data .= ", rm_type = '$rm_type' ";
        $data .= ", rm_floor = '$rm_floor' ";

        $chk = $this->db->query("SELECT * FROM room where roomCODE = '$roomCODE' and roomCODE != '$id'")->num_rows;
        if ($chk > 0) {
            return 2; // Room code already exists
            exit;
        }

        if (empty($id)) {
            $save = $this->db->query("INSERT INTO room set " . $data);
        } else {
            $save = $this->db->query("UPDATE room set " . $data . " where roomCODE = " . $id);
        }

        if ($save) {
            return 1; // Success
        }
    }

    public function delete_room() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM room where roomCODE = " . $id);
        if ($delete) {
            return 1; // Success
        }
    }

	
    public function save_term() {
        // Implementation for saving term data
        // This method should handle the data received from the AJAX request and interact with the database accordingly.
        // Ensure that it returns a meaningful response, such as success or an error message.

        // Example (replace this with your actual implementation):
		$termName=$_POST['termName'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        // Validate and sanitize input data if necessary

        // Perform the database operation (insert/update)
        // Replace the following line with your database operation:
        $result = $this->perform_database_operation($termName, $startDate, $endDate);

        if ($result) {
            // Successful operation
            return '1';
        } else {
            // Failed operation
            return 'Error: Something went wrong.';
        }
    }

	private function perform_database_operation($termName, $startDate, $endDate) {
        // Implement the actual database operation here
        // This function should interact with your database to save the term data.

        // Example (replace this with your actual database operation):
        $query = "INSERT INTO term (termName, startDate, endDate) VALUES ('$termName','$startDate', '$endDate')";
        $result = $this->db->query($query);

        return $result;
    }


    public function delete_term()
    {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM term WHERE termID = $id");
        if ($delete) {
            return 1; // Success
        } else {
            return 0; // Failed
        }
    }
		public function get_term(){
		$data = array();
		$qry = $this->db->query("SELECT * FROM term");
		while ($row = $qry->fetch_assoc()) {
			$data[] = $row;
		}
		return json_encode($data);
	}
	
	
	public function add_college($college_name) {
		// Use prepared statements to prevent SQL injection
		$chkStmt = $this->db->prepare("SELECT * FROM colleges WHERE col_name = ?");
		$chkStmt->bind_param("s", $college_name);
		$chkStmt->execute();
		$chkStmt->store_result();
		$chk = $chkStmt->num_rows;
		$chkStmt->close();
	
		if ($chk > 0) {
			return 2; // College name already exists
		}
	
		// Use prepared statements to prevent SQL injection
		$saveStmt = $this->db->prepare("INSERT INTO colleges (col_name) VALUES (?)");
		$saveStmt->bind_param("s", $college_name);
	
		$save = $saveStmt->execute();
	
		if ($save) {
			return 1; // Success
		} else {
			// Return the error message for debugging
			return "Error: " . $this->db->error;
		}
	}
	
    
    public function delete_college() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM colleges where col_ID = '$id'");
        if ($delete) {
            return 1; // Success
        }
    }

    public function save_class($year_level) {
        extract($_POST);

        // Validate and sanitize input data if necessary

        // Check if the combination of year_level and section already exists
        $chk = $this->db->query("SELECT * FROM class WHERE year_level = '$year_level' AND section = '$section' AND class_ID != '$id'")->num_rows;
        if ($chk > 0) {
            return 2; // Class already exists
        }

        // If the id is empty, it's a new entry, so insert the data
        if (empty($id)) {
            $save = $this->db->query("INSERT INTO class (year_level, section) VALUES ('$year_level', '$section')");
        } else {
            // If the id is not empty, it's an update, so update the existing data
            $save = $this->db->query("UPDATE class SET year_level = '$year_level', section = '$section' WHERE class_ID = '$id'");
        }

        if ($save) {
            return 1; // Success
        } else {
            return 0; // Error
        }
    }

    public function delete_class() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM class where class_ID = '$id'");
        if ($delete) {
            return 1; // Success
        }
    }

    public function get_class() {
        $data = array();
        $qry = $this->db->query("SELECT * FROM class");
        while ($row = $qry->fetch_assoc()) {
            $data[] = $row;
        }
        return json_encode($data);
    }
	function save_program() {


        // Extract POST data and handle default values
        $id = isset($_POST['prog_ID']) ? $_POST['prog_ID'] : '';
        $prog_code = mysqli_real_escape_string($db, $_POST['prog_code']);
        $prog_name = mysqli_real_escape_string($db, $_POST['prog_name']);
        $col_ID = isset($_POST['col_ID']) ? $_POST['col_ID'] : '';
        $sub_code = isset($_POST['sub_code']) ? $_POST['sub_code'] : null; // Set to null if not provided

        // Validate and sanitize input data if necessary

        // Check if the sub_code exists in the subjects table
        if (!empty($sub_code)) {
            $check_sub_query = $db->query("SELECT * FROM subjects WHERE sub_code = '$sub_code'");
            if ($check_sub_query->num_rows == 0) {
                echo 'Error: The specified subject code does not exist.';
                return;
            }
        }

        if (empty($id)) {
            $query = "INSERT INTO program (col_ID, prog_code, prog_name, sub_code) VALUES ('$col_ID', '$prog_code', '$prog_name', " . ($sub_code ? "'$sub_code'" : 'NULL') . ")";
        } else {
            $query = "UPDATE program SET col_ID='$col_ID', prog_code='$prog_code', prog_name='$prog_name', sub_code=" . ($sub_code ? "'$sub_code'" : 'NULL') . " WHERE prog_ID=$id";
        }

        $result = $conn->query($query);

        if ($result) {
            echo '1'; // Success
        } else {
            echo 'Error: ' . $db->error;
        }
    }

	public function delete_program() {
        extract($_POST);
        $delete = $this->db->query("DELETE FROM program where prog_ID = '$id'");
        if ($delete) {
            return 1; // Success
        }
    }
	public function add_class() {
        extract($_POST);
        $check = $this->db->query("SELECT * FROM class WHERE class_name = '$class_name' ")->num_rows;
        if($check > 0){
            return 2; // Class name already exists
        }

        $save = $this->db->query("INSERT INTO class SET class_name = '$class_name' ");
        if ($save) {
            return 1; // Success
        }
    }
	// admin_class.php

	public function add_subject_to_program($programID, $subCode) {
        // Use prepared statements to prevent SQL injection
        $stmt = $this->db->prepare("INSERT INTO program_subjects (prog_ID, sub_code) VALUES (?, ?)");
        $stmt->bind_param("ss", $programID, $subCode);

        if ($stmt->execute()) {
            $stmt->close();
            return 1; // Success
        } else {
            return "Error: " . $this->db->error;
        }
    }
public function delete_subject_from_program($programID, $subCode) {
    // Use prepared statements to prevent SQL injection
    $stmt = $this->db->prepare("DELETE FROM program_subjects WHERE prog_ID = ? AND sub_code = ?");
    $stmt->bind_param("ss", $programID, $subCode);

    $delete = $stmt->execute();

    if ($delete) {
        return 1; // Success
    } else {
        // Return the error message for debugging
        return "Error: " . $stmt->error;
    }
}

	
}
	