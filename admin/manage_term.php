<?php
include('db_connect.php');
session_start();

// Fetch department data for editing
$meta = array(); // Initialize $meta
if(isset($_GET['id'])){
    $term = $conn->query("SELECT * FROM term WHERE termID=".$_GET['id']);
    foreach($term->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}
?>

<div class="container-fluid">
    <div id="msg"></div>
   
    <form action="" id="manage-term">   
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Term Name</label>
                <input type="text" name="termName" class="form-control" value="<?php echo isset($meta['termName']) ? $meta['termName'] : '' ?>" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Start Date</label>
                <input type="date" name="startDate" class="form-control" value="<?php echo isset($meta['startDate']) ? $meta['startDate'] : '' ?>" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Start Date</label>
                <input type="date" name="endDate" class="form-control" value="<?php echo isset($meta['endDate']) ? $meta['endDate'] : '' ?>" required>
            </div>
        </div>
    </form>
</div>

<script>
    $('#manage-term').submit(function(e){
        e.preventDefault();
        start_load();
        $.ajax({
            url:'ajax.php?action=save_term',
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp == 1){
                    alert_toast("Data successfully saved.",'success');
                    setTimeout(function(){
                        location.reload();
                    },1000);
                } else if (resp == 2) {
                    $('#msg').html('<div class="alert alert-danger">Term ID already exists.</div>');
                    end_load();
                } else {
                    $('#msg').html('<div class="alert alert-danger">Error: ' + resp + '</div>'); // Display the error
                    end_load();
                }
            }
        });
    });
</script>
