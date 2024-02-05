<?php
include('db_connect.php');

$collegeID = isset($_GET['collegeID']) ? $_GET['collegeID'] : null;
?>

<!-- FORM Panel -->
<form action="" id="manage-program">
    <div class="card">
        <div class="card-header">
            Program Form
        </div>
        <div class="card-body">
            <input type="text" name="prog_ID">
            <input type="text" name="col_ID" value="<?php echo $collegeID; ?>">
            <?php
            // Fetch and display college name
            $college_name = "";
            if ($collegeID) {
                $result = mysqli_query($conn, "SELECT col_name FROM colleges WHERE col_id = $collegeID");
                $row = mysqli_fetch_assoc($result);
                $college_name = $row['col_name'];
            }
            ?>
            <div class="form-group">
                <label class="control-label">College Name</label>
                <input type="text" class="form-control" name="col_name" value="<?php echo $college_name; ?>" readonly>
            </div>
            <div class="form-group">
                <label class="control-label">Program Code</label>
                <input type="text" class="form-control" name="prog_code">
            </div>
            <div class="form-group">
                <label class="control-label">Program Name</label>
                <input type="text" class="form-control" name="prog_name">
            </div>
        </div>
    </div>
</form>
<!-- FORM Panel -->

<script>
// Retrieve col_ID from session
// Retrieve col_ID from session
var col_ID = <?php echo isset($_SESSION['current_col_ID']) ? $_SESSION['current_col_ID'] : 'null'; ?>;

$('#manage-program').submit(function (e) {
    e.preventDefault();
    start_load();

    var formData = $(this).serialize(); // Serialize the form data

    // Add the col_ID value to the serialized form data
    formData += '&col_ID=' + col_ID;

    $.ajax({
        url: 'ajax.php?action=save_program',
        method: 'POST',
        data: formData, // Use the serialized form data
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Program successfully added.", 'success');
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else {
                $('#msg').html('<div class="alert alert-danger">Error adding program: ' + resp + '</div>');
                end_load();
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert_toast("Error: " + error, 'error');
            end_load();
        }
    });
});


</script>
