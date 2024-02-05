<?php include('db_connect.php'); ?>

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

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12"></div>
        </div>
        <div class="row">
            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Classes</b>
                        <span class="">
                            <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_class">
                                <i class="fa fa-plus"></i> New</button>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed table-hover">
                                <colgroup>
                                    <col width="15%">
                                    <col width="50%">
                                    <col width="35%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="">Year/Section</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
if (isset($_POST['programID'])) {
    $programID = $_POST['programID'];

    $i = 1;

    // Assume $programID is a string, if it's an integer, you may need to adjust accordingly
    $classes = $conn->query("SELECT class.* FROM program
                            JOIN class ON program.class_ID = class.class_ID 
                            WHERE program.prog_ID = '$programID' 
                            ORDER BY program.prog_Id, program.prog_name ASC");

    // Check for errors
    if (!$classes) {
        echo "Error: " . $conn->error; // Print the error message
    }

    while ($row = $classes->fetch_assoc()):
?>
    <tr>
        <td class="text-center"><?php echo $i++ ?></td>
        <td class=""><b><?php echo $row['year_level'] . ' / ' . $row['section'] ?></b></td>
        <td class="text-center">
            <button class="btn btn-sm btn-outline-primary edit_class" type="button" data-id="<?php echo $row['class_ID'] ?>">Edit</button>
            <button class="btn btn-sm btn-outline-danger delete_class" type="button" data-id="<?php echo $row['class_ID'] ?>">Delete</button>
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

    td p {
        margin: unset;
    }

    img {
        max-width: 200px;
        max-height: 150px;
    }
</style>

<script>
    $(document).ready(function () {
        $('table').dataTable();
    });

    $('#new_class').click(function () {
        uni_modal("New Entry", "manage_class.php", 'mid-large');
    });

    $('.edit_class').click(function () {
        uni_modal("Manage Class", "manage_class.php?id=" + $(this).attr('data-id'), 'mid-large');
    });

    $('.delete_class').click(function () {
        _conf("Are you sure to delete this class?", "delete_class", [$(this).attr('data-id')], 'mid-large');
    });

    function delete_class($id) {
        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_class',
            method: 'POST',
            data: { id: $id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Class successfully deleted", 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                }
            }
        });
    }
</script>
