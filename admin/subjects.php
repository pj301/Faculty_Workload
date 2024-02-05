<style>
    /* Add this style to your existing style tag or in your CSS file */
    h3 {
        color: #fff; /* Set the text color to white */
    }
</style>


<?php
include('db_connect.php');
function getProgramDetails($programID) {
    global $conn;
    $query = "SELECT program.*, colleges.col_name
              FROM program
              LEFT JOIN colleges ON program.col_ID = colleges.col_ID
              WHERE program.prog_ID = '$programID'";

    return $conn->query($query)->fetch_assoc();
}

function getSubjectsByProgram($programID) {
    global $conn;
    $programDetails = getProgramDetails($programID);

    $query = "SELECT subjects.*, colleges.col_name,subjects.year_level
              FROM program_subjects
              LEFT JOIN colleges ON program_subjects.col_ID = colleges.col_ID
              LEFT JOIN subjects ON program_subjects.sub_code = subjects.sub_code
              WHERE program_subjects.prog_ID = '$programID'
              ORDER BY subjects.sub_code ASC";

    return [
        'programDetails' => $programDetails,
        'subjects' => $conn->query($query),
    ];
}

// Assuming $programID is set somewhere in your code
$programID = $_POST['programID'];

$programData = getSubjectsByProgram($programID);
$programDetails = $programData['programDetails'];
$subjects = $programData['subjects'];
?>


<div id="program_table">
    <!-- Display program details here -->
    <h3>Program: <?php echo $programDetails['prog_code']; ?></h3>
    <h3>College: <?php echo $programDetails['col_name']; ?></h3>
    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">
                <!-- Your content here -->
            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Subjects</b>
                        <span class="">
                            <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_subjects">
                                <i class="fa fa-plus"></i> New</button>
                        </span>
                    </div>
                   
                    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-hover">
                <thead>
                    <tr>
                        <th class="text-center">College</th>
                        <th class="text-center">Program</th>
                        <th class="text-center">Subject Code</th>
                        <th class="text-center">Course Title</th>
                        <th class="text-center">Lecture/Lab Hrs</th>
                        <th class="text-center">Unit Credit</th>
                        <th class="text-center">Slot</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
if (isset($_POST['programID'])) {
    $programID = $_POST['programID'];
    $programData = getSubjectsByProgram($programID);
    $programDetails = $programData['programDetails'];
    $subjects = $programData['subjects'];

    // Display program details row
    ?>
    <tr>
        <td class="text-center"><?php echo $programDetails['col_name'] ?></td>
        <td class="text-center"><?php echo $programDetails['prog_code'] ?></td>
        <td colspan="6"></td> <!-- You might adjust the colspan based on the number of columns in your table -->
    </tr>
    <?php

    // Display subject rows
    while ($row = $subjects->fetch_assoc()):
?>
        <tr>
            <td class="text-center"><?php echo $row['sub_code'] ?></td>
            <td class="text-center"><?php echo $row['course_title'] ?></td>
            <td class="text-center"><?php echo $row['lecture_hrs'] . ' / ' . $row['lab_hrs'] ?></td>
            <td class="text-center"><?php echo $row['unit_credit'] ?></td>
            <td class="text-center"><?php echo $row['slot'] ?></td>
            <!-- Add your action buttons (Edit, Delete, etc.) here -->
            <td class="text-center">
            
                <!-- New buttons for adding/removing subjects -->
                <button class="btn btn-sm btn-outline-success add_subject_to_program" type="button" data-sub-code="<?php echo $row['sub_code']; ?>">Add to Program</button>
                <button class="btn btn-sm btn-outline-warning delete_subject_from_program" type="button" data-sub-code="<?php echo $row['sub_code']; ?>">Remove from Program</button>
            </td>
        </tr>
<?php endwhile;
}
?>



                </tbody>
            </table>
        </div>
    </div>
</div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>
</div>

<style>
    td {
        vertical-align: middle !important;
    }

    .container-fluid {
        padding-top: 30px;
        padding-bottom: 30px;
    }
    /* Adjust content width when the sidebar is collapsed */
#view-panel.collapsed {
  margin-left: 50px;
  transition: margin-left 0.3s ease; /* Add transition for smooth width change */
  width: 100%;
}

/* Adjust content width when the sidebar is collapsed */
#sidebar.collapsed{

    transition: margin-left 0.3s ease; /* Add transition for smooth width change */
    width: 5% !important;
}

</style>
<script>
    $(document).ready(function () {
        $('table').dataTable()
    })
  
    $('#new_subjects').click(function () {
        uni_modal("New Entry", "manage_subjects.php", 'mid-large')
    })
    $('.view_subjects').click(function () {
        uni_modal("Subject Details", "view_subjects.php?id=" + $(this).attr('data-id'), '')

    })
    $('.edit_subject').click(function () {
        uni_modal("Manage Subject", "manage_subjects.php?id=" + $(this).attr('data-id'), 'mid-large')

    })
    $('.delete_subjects').click(function () {
        _conf("Are you sure to delete this subjects?", "delete_subjects", [$(this).attr('data-id')], 'mid-large')
    })

    $.ajax({
    url: 'ajax.php?action=add_subject_to_program',
    method: 'POST',
    data: {
        programID: 'prog_ID', // Replace with the actual program ID
        subCode: 'sub_code'  // Replace with the actual subject code
    },
    success: function(resp) {
        if (resp == 1) {
            alert_toast("Subject successfully added to the program", 'success');
        } else {
            alert_toast("Error: " + resp, 'error');
        }
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText);
        alert_toast("Error: " + error, 'error');
    }
});

// New AJAX call for deleting subject from program
$('.delete_subject_from_program').click(function() {
    var subCode = $(this).attr('data-sub-code');
    $.ajax({
        url: 'ajax.php?action=delete_subject_from_program',
        method: 'POST',
        data: { programID: '<?php echo $programID; ?>', subCode: subCode },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Subject successfully removed from program.", 'success');
                setTimeout(function(){
                    location.reload();
                }, 1000);
            } else {
                // ... handle other cases if needed
            }
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert_toast("Error: " + error, 'error');
        }
    });
});


</script>
