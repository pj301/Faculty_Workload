<?php
include('db_connect.php');
session_start();

// Fetch department data for editing
if(isset($_GET['id'])){
    $college = $conn->query("SELECT * FROM colleges WHERE col_ID =".$_GET['id']);
    foreach($college->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}
?>

<div class="container-fluid">
    <div id="msg"></div>
    
    <form action="" id="manage-college">   
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">College Name</label>
                <input type="text" name="college_name" class="form-control" value="<?php echo isset($meta['college_name']) ? $meta['college_name'] : '' ?>" required>
            </div>
        </div>
      
    </form>
</div>

<script>
    $('#manage-college').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_college',
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp == 1){
                    alert_toast("Data successfully saved.",'success')
                    setTimeout(function(){
                        location.reload()
                    },1000)
                }else if(resp == 2){
                    $('#msg').html('<div class="alert alert-danger">College name already exists.</div>')
                    end_load();
                }
            }
        })
    })
</script>
