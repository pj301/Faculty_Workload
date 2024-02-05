<?php
include('db_connect.php');

class Action {
    function save_program() {
        global $conn;

        // Extract POST data and handle default values
         $id = isset($_POST['prog_ID']) ? $_POST['prog_ID'] : '';
        $prog_code = mysqli_real_escape_string($conn, $_POST['prog_code']);
        $prog_name = mysqli_real_escape_string($conn, $_POST['prog_name']);
        $col_ID = isset($_POST['col_ID']) ? $_POST['col_ID'] : '';
        $sub_code = isset($_POST['sub_code']) ? $_POST['sub_code'] : null; // Set to null if not provided

        // Validate and sanitize input data if necessary

        // Check if the sub_code exists in the subjects table
        if (!empty($sub_code)) {
            $check_sub_query = $conn->query("SELECT * FROM subjects WHERE sub_code = '$sub_code'");
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
            echo 'Error: ' . $conn->error;
        }
    }

   
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $action_instance = new Action(); // Create an instance of the Action class

    switch ($action) {
        case 'save_program':
            $action_instance->save_program(); // Call the method on the instance
            break;
        // case 'delete_program':
        //     $action_instance->delete_program();
        //     break;
    }
}
?>

<div class="container-fluid">
    <style>
        input[type=checkbox] {
            -ms-transform: scale(1.5);
            -moz-transform: scale(1.5);
            -webkit-transform: scale(1.5);
            -o-transform: scale(1.5);
            transform: scale(1.5);
            padding: 10px;
        }
    </style>
    <div id="subjectclass_table">
        <div class="col-lg-12">
            <div class="row mb-4 mt-4">
                <div class="col-md-12"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b>Programs</b>
                            <span class="">
                            <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_program_modal">
                                        <i class="fa fa-plus"></i> New
                                    </button>

                            </span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed table-hover">
                                    <colgroup>
                                        <col width="1%">
                                        <col width="5%">
                                        <col width="25%">
                                        <col width="20%">
                                        <col width="13%">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Program Code</th>
                                            <th class="text-center">Program Name</th>
                                            <th class="text-center">College</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_POST['collegeID'])) {
                                            $collegeID = $_POST['collegeID'];

                                            $i = 1;
                                            $colleges = $conn->query("SELECT program.*, colleges.col_name FROM program
                                                        INNER JOIN colleges ON program.col_ID =colleges.col_ID
                                                        WHERE program.col_ID = $collegeID
                                                        ORDER BY program.prog_ID ASC");

                                            while ($row = $colleges->fetch_assoc()):
                                        ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $i++ ?></td>
                                                    <td class="text-center"><?php echo $row['prog_code'] ?></td>
                                                    <td class="text-center"><?php echo $row['prog_name'] ?></td>
                                                    <td class="text-center"><?php echo $row['col_name'] ?></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-outline-primary edit_program" type="button" data-id="<?php echo $row['prog_ID'] ?>">Edit</button>
                                                        <button class="btn btn-sm btn-outline-danger delete_program" type="button" data-id="<?php echo $row['prog_ID'] ?>">Delete</button>
                                                        <button class="btn btn-sm btn-outline-primary view_class" type="button" data-id="<?php echo $row['prog_ID'] ?>">Class</button>
                                                        <button class="btn btn-sm btn-outline-primary view_subjects" type="button" data-id="<?php echo $row['prog_ID'] ?>">Subject</button>
                                                    </td>
                                                </tr>
                                        <?php
                                            endwhile;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add new program modal -->
<div class="modal fade" id="newProgramModal" tabindex="-1" role="dialog" aria-labelledby="newProgramModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newProgramModalLabel">New Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Include your form here -->
                <form id="newProgramForm">
                    <div class="form-group">
                        <label for="prog_code">Program Code</label>
                        <input type="text" class="form-control" id="prog_code" name="prog_code" required>
                    </div>
                    <div class="form-group">
                        <label for="prog_name">Program Name</label>
                        <input type="text" class="form-control" id="prog_name" name="prog_name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    td {
        vertical-align: middle !important;
    }

    td p {
        margin: unset
    }

    img {
        max-width: 200px;
        max-height: :150px;
    }
</style>
<script>
$('#new_program_modal').click(function () {
            $('#newProgramModal').modal('show');
        });
        $('.view_subjects').click(function () {
            var programID = $(this).attr('data-id');
            loadSubjects(programID);
        });

        $('.view_class').click(function () {
            var programID = $(this).attr('data-id');
            var collegeID = $(this).closest('tr').find('.view_program').attr('data-id');
            loadClass(programID, collegeID);
        });

   // Handle the form submission
$('#newProgramForm').submit(function (e) {
    e.preventDefault();

    var collegeID = <?php echo isset($_POST['collegeID']) ? $_POST['collegeID'] : 'null'; ?>;
    var prog_code = $('#prog_code').val();
    var prog_name = $('#prog_name').val();

    // Perform validation if needed

    // AJAX request to save the new program
    $.ajax({
        url: 'loadprograms.php?action=save_program',
        method: 'POST',
        data: {
            col_ID: collegeID,
            prog_code: prog_code,
            prog_name: prog_name
        },
        success: function (resp) {
            if (resp.includes('SUCCESSFULLY ADDED PROGRAM')) {
                alert_toast("Program added successfully", 'success');
                location.reload(); // Reload the programs table or perform any necessary updates
            } else {
                alert(resp); // Display the error message
            }
        }
    });
});

    $('.view_program').click(function () {
        uni_modal("Program Details", "view_program.php?id=" + $(this).attr('data-id'), '')
    });

    $('.edit_program').click(function () {
        uni_modal("Manage Program", "manage_program.php?id=" + $(this).attr('data-id'), 'mid-large')
    });

    $('.delete_program').click(function () {
      
        _conf("Are you sure to delete this program?", "delete_program", [$(this).attr('data-id')], 'mid-large')
     
    });
  
    $('.delete_program').click(function () {
    _conf("Are you sure to delete this program?", "delete_program", [$(this).attr('data-id')], 'mid-large');
});

// Function to handle the confirmation and perform the deletion
function delete_program(id) {
    $.ajax({
        url: 'ajax.php?action=delete_program',
        method: 'POST',
        data: { id: id },
        success: function (resp) {
            if (resp.includes('SUCCESSFULLY DELETED PROGRAM')) {
                alert_toast("Program successfully deleted", 'success');
            } else {
                alert_toast("SUCCESSFULLY DELETED PROGRAM", 'error');
                location.reload(); // Call a function to reload the programs table dynamically

            }
            end_load();
        }
    });
}


// Function to load programs table
function loadProgramsTable() {
    $.ajax({
        url: 'loadprograms.php', // Adjust the URL as needed
        method: 'GET',
        success: function (resp) {
            $('#subjectclass_table').html(resp); // Update the content of the table
        }
    });
}

    function loadSubjects(programID) {
        start_load();
        $.ajax({
            url: 'subjects.php',
            method: 'POST',
            data: { programID: programID },
            success: function (resp) {
                $('#subjectclass_table').html(resp);
                end_load();
            }
        });
    }

    function loadClass(programID, collegeID) {
        start_load();
        $.ajax({
            url: 'class.php',
            method: 'POST',
            data: { programID: programID, collegeID: collegeID },
            success: function (resp) {
                $('#subjectclass_table').html(resp);
                end_load();
            }
        });
    }

   
</script>
