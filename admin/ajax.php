<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
$action = $_GET['action'];
switch ($action) {
    case 'login':
        $login = $crud->login();
        if ($login) echo $login;
        break;

    case 'login_faculty':
        $login_faculty = $crud->login_faculty();
        if ($login_faculty) echo $login_faculty;
        break;

    case 'login2':
        $login = $crud->login2();
        if ($login) echo $login;
        break;

    case 'logout':
        $logout = $crud->logout();
        if ($logout) echo $logout;
        break;

    case 'logout2':
        $logout = $crud->logout2();
        if ($logout) echo $logout;
        break;

    case 'save_user':
        $save = $crud->save_user();
        if ($save) echo $save;
        break;

    case 'delete_user':
        $save = $crud->delete_user();
        if ($save) echo $save;
        break;

    case 'signup':
        $save = $crud->signup();
        if ($save) echo $save;
        break;

    case 'update_account':
        $save = $crud->update_account();
        if ($save) echo $save;
        break;

    case 'save_settings':
        $save = $crud->save_settings();
        if ($save) echo $save;
        break;

    case 'save_course':
        $save = $crud->save_course();
        if ($save) echo $save;
        break;

    case 'delete_course':
        $delete = $crud->delete_course();
        if ($delete) echo $delete;
        break;

    case 'save_subject':
        $save = $crud->save_subject();
        if ($save) echo $save;
        break;

    case 'delete_subject':
        $delete = $crud->delete_subject();
        if ($delete) echo $delete;
        break;

    case 'save_faculty':
        $save = $crud->save_faculty();
        if ($save) echo $save;
        break;

    case 'delete_faculty':
        $save = $crud->delete_faculty();
        if ($save) echo $save;
        break;

    case 'save_schedule':
        $save = $crud->save_schedule();
        if ($save) echo $save;
        break;

    case 'delete_schedule':
        $save = $crud->delete_schedule();
        if ($save) echo $save;
        break;

    case 'get_schecdule':
        $get = $crud->get_schecdule();
        if ($get) echo $get;
        break;

    case 'delete_forum':
        $save = $crud->delete_forum();
        if ($save) echo $save;
        break;

    case 'save_comment':
        $save = $crud->save_comment();
        if ($save) echo $save;
        break;

    case 'delete_comment':
        $save = $crud->delete_comment();
        if ($save) echo $save;
        break;

    case 'save_event':
        $save = $crud->save_event();
        if ($save) echo $save;
        break;

    case 'delete_event':
        $save = $crud->delete_event();
        if ($save) echo $save;
        break;

    case 'participate':
        $save = $crud->participate();
        if ($save) echo $save;
        break;

    case 'get_venue_report':
        $get = $crud->get_venue_report();
        if ($get) echo $get;
        break;

    case 'save_art_fs':
        $save = $crud->save_art_fs();
        if ($save) echo $save;
        break;

    case 'delete_art_fs':
        $save = $crud->delete_art_fs();
        if ($save) echo $save;
        break;

    case 'get_pdetails':
        $get = $crud->get_pdetails();
        if ($get) echo $get;
        break;

		case 'save_room':
			$save = $crud->save_room();
			if ($save) echo $save;
			break;
	
		case 'delete_room':
			$delete = $crud->delete_room();
			if ($delete) echo $delete;
			break;
	
		// Add more room-related actions as needed
	
        case 'save_college':
            $college_name = isset($_POST['college_name']) ? $_POST['college_name'] : '';
            $add_college = $crud->add_college($college_name);
            if ($add_college) echo $add_college;

            
            break;
            
        
            case 'delete_college':
                $delete = $crud->delete_college();
                if ($delete) echo $delete;
                break; 
          
            case 'save_term':
                $save_term = $crud->save_term();
                if ($save_term) echo $save_term;
                break;
        
            case 'delete_term':
                $delete_term = $crud->delete_term();
                if ($delete_term) echo $delete_term;
                break;
        
        
            case 'save_class':
                $year_level = $_POST['year_level']; // Make sure to retrieve year_level from POST
                $save_class = $crud->save_class($year_level);
                if ($save_class) {
                    echo $save_class;
                }
                break;
        
            case 'delete_class':
                $delete_class = $crud->delete_class($_POST);
                echo $delete_class;
                break;
        
            case 'get_class':
                $get_class = $crud->get_class();
                if ($get_class) echo $get_class;
                break;
                case 'save_program':
                    $action_instance->save_program(); // Call the method on the instance
                    break;
                    case 'delete_program':
                        $delete = $crud->delete_program();
                        if ($delete) echo $delete;
                        break; 

                        case 'add_class':
                            $add_class = $admin->add_class();
                            echo $add_class;
                            break;
                            case 'add_subject_to_program':
                                $programID = isset($_POST['programID']) ? $_POST['programID'] : '';
                                $subCode = isset($_POST['subCode']) ? $_POST['subCode'] : '';
                        
                                $addSubject = $admin_class->add_subject_to_program($programID, $subCode);
                                echo $addSubject;
                                break;
                        
                            case 'delete_subject_from_program':
                                $programID = isset($_POST['programID']) ? $_POST['programID'] : '';
                                $subCode = isset($_POST['subCode']) ? $_POST['subCode'] : '';
                        
                                $deleteSubject = $admin_class->delete_subject_from_program($programID, $subCode);
                                echo $deleteSubject;
                                break;
                        
                            
                            
            // Add other cases if needed
        }
        
ob_end_flush();
?>
