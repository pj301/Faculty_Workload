<?php
include('db_connect.php');
session_start();

// Fetch class data for editing
if(isset($_GET['id'])){
    $class = $conn->query("SELECT * FROM class WHERE class_ID =".$_GET['id']);
    foreach($class->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}
?>

<div class="container-fluid">
    <div id="msg"></div>
    
    <form action="" id="manage-class">   
        <input type="hidden" name="id" value="<?php echo isset($meta['class_ID']) ? $meta['class_ID']: '' ?>">
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Year Level</label>
                <input type="text" name="year_level" class="form-control" value="<?php echo isset($meta['year_level']) ? $meta['year_level'] : '' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="control-label">Section</label>
                <input type="text" name="section" class="form-control" value="<?php echo isset($meta['section']) ? $meta['section'] : '' ?>" required>
            </div>
        </div>
    </form>
</div>

<script>
 $('#manage-class').submit(function(e){
    e.preventDefault();
    start_load();
    $.ajax({
        url: 'ajax.php?action=add_class',
        method: 'POST',
        data: { 
            year_level: $('[name="year_level"]').val(),
            section: $('[name="section"]').val()
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully saved.", 'success');
                setTimeout(function(){
                    location.reload();
                }, 1000);
            } else if (resp == 2) {
                $('#msg').html('<div class="alert alert-danger">Class already exists.</div>');
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
