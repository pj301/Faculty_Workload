<?php
include('db_connect.php');
session_start();

if (isset($_GET['id'])) {
    $subject = $conn->query("SELECT * FROM subjects WHERE sub_code =" . $_GET['id']);
    foreach ($subject->fetch_array() as $k => $v) {
        $meta[$k] = $v;
    }
}

?>
<div class="container-fluid">
    <div id="msg"></div>
    
    <form action="" id="manage-subjects">   
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Subject Code</label>
                    <input type="text" name="sub_code" class="form-control" value="<?php echo isset($meta['sub_code']) ? $meta['sub_code'] : '' ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Course Title</label>
                    <input type="text" name="course_title" class="form-control" value="<?php echo isset($meta['coourse_title']) ? $meta['course_title'] : '' ?>" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Year Level</label>
                <select name="year_level" class="form-control" required>
                    <?php
                    // Assuming $conn is your database connection
                    $classID = isset($meta['class_ID']) ? $meta['class_ID'] : '';

                    // Fetch year levels from class table
                    $classLevels = $conn->query("SELECT DISTINCT year_level FROM class");

                    while ($row = $classLevels->fetch_assoc()):
                        $selected = ($classID == $row['class_ID']) ? 'selected' : '';
                    ?>
                        <option value="<?php echo $row['year_level']; ?>" <?php echo $selected; ?>><?php echo $row['year_level']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Semester</label>
                    <select name="semester" class="form-control" required>
                        <option value="First Semester" <?php echo (isset($meta['semester']) && $meta['semester'] == 'First Semester') ? 'selected' : '' ?>>First Semester</option>
                        <option value="Second Semester" <?php echo (isset($meta['semester']) && $meta['semester'] == 'Second Semester') ? 'selected' : '' ?>>Second Semester</option>
                        <option value="Summer" <?php echo (isset($meta['semester']) && $meta['semester'] == 'Summer') ? 'selected' : '' ?>>Summer</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label class="control-label">Lecture Hours</label>
        <input type="number" name="lecture_hrs" class="form-control" value="<?php echo isset($meta['lecture_hrs']) ? $meta['lecture_hrs'] : '' ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Lab Hours</label>
                    <input type="number" name="lab_hrs" class="form-control" value="<?php echo isset($meta['lab_hrs']) ? $meta['lab_hrs'] : '' ?>" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Unit Credit</label>
                    <input type="number" name="unit_credit" class="form-control" value="<?php echo isset($meta['unit_credit']) ? $meta['unit_credit'] : '' ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Slot</label>
                    <input type="number" name="slot" class="form-control" value="<?php echo isset($meta['slot']) ? $meta['slot'] : '' ?>" required>
                </div>
            </div>
        </div>
        <input type="text" name="prog_ID" value="<?php echo isset($_SESSION['prog_ID']) ? $_SESSION['prog_ID'] : ''; ?>">
    </form>
</div>
<script>
    $('#manage-subjects').submit(function(e){
    e.preventDefault();
    start_load();
    $.ajax({
            url: 'ajax.php?action=add_subject_to_program',
            method: 'POST',
            data: { 
                id: $('[name="id"]').val(),
                sub_code: $('[name="sub_code"]').val(),
                course_title: $('[name="course_title"]').val(),
                semester: $('[name="semester"]').val(),
                year_level: $('[name="year_level"]').val(),
                lecture_hrs: $('[name="lecture_hrs"]').val(),
                lab_hrs: $('[name="lab_hrs"]').val(),
                unit_credit: $('[name="unit_credit"]').val(),
                slot: $('[name="slot"]').val(),
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully saved.", 'success');
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                } else if (resp == 2) {
                    $('#msg').html('<div class="alert alert-danger">Subject code already exists.</div>');
                    end_load();
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert_toast("Error: " + error, 'error');
                end_load();
            }
        });
    });


</script>


