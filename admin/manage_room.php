<?php 
include('db_connect.php');
session_start();
if(isset($_GET['id'])){
    $room = $conn->query("SELECT * FROM room where roomCODE =".$_GET['id']);
    foreach($room->fetch_array() as $k =>$v){
        $meta[$k] = $v;
    }
}
?>
<div class="container-fluid">
    <div id="msg"></div>
    
    <form action="" id="manage-room">   
        <input type="hidden" name="id" value="<?php echo isset($meta['roomCODE']) ? $meta['roomCODE']: '' ?>">
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Room Code</label>
                <input type="text" name="roomCODE" class="form-control" value="<?php echo isset($meta['roomCODE']) ? $meta['roomCODE'] : '' ?>" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Building Name</label>
                <input type="text" name="rm_buildingName" class="form-control" value="<?php echo isset($meta['rm_buildingName']) ? $meta['rm_buildingName'] : '' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="control-label">Room Description</label>
                <input type="text" name="rm_Desc" class="form-control" value="<?php echo isset($meta['rm_Desc']) ? $meta['rm_Desc'] : '' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="control-label">Room Type</label>
                <input type="text" name="rm_type" class="form-control" value="<?php echo isset($meta['rm_type']) ? $meta['rm_type'] : '' ?>" required>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-4">
                <label class="control-label">Floor Level</label>
                <input type="text" name="rm_floor" class="form-control" value="<?php echo isset($meta['rm_floor']) ? $meta['rm_floor'] : '' ?>" required>
            </div>
        </div>
    </form>
</div>

<script>
    $('#manage-room').submit(function(e){
        e.preventDefault()
        start_load()
        $.ajax({
            url:'ajax.php?action=save_room',
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp == 1){
                    alert_toast("Data successfully saved.",'success')
                    setTimeout(function(){
                        location.reload()
                    },1000)
                }else if(resp == 2){
                    $('#msg').html('<div class="alert alert-danger">Room Code already existed.</div>')
                    end_load();
                }
            }
        })
    })
</script>
