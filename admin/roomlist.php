<?php
$type = array("", "Admin", "Staff", "Alumnus/Alumna");
include 'db_connect.php';
$rooms = $conn->query("SELECT * FROM room ORDER BY roomCode ASC");
?>

<style>
    .dropdown-menu a.edit_room {
        background-color: #213440;
        color: #ffffff;
    }

    .dropdown-menu a.delete_room {
        background-color: #213440;
        color: #ffffff;
    }

    .container-fluid {
        padding-top: 30px;
        padding-bottom: 30px;
      
        padding-bottom:30px;
		padding-top: 100px;
		width:90%;

    }
    
</style>

<div class="container-fluid">
    <br>
    <div class="row"> 
        <div class="card col-lg-12">
            <div class="card-body">
            <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" id="new_room"><i class="fa fa-plus"></i> New Room</button>
        </div>
                <h2 class="text-center mb-4">Room List</h2> <!-- Added Table Title -->
                <table class="table-striped table-bordered col-md-12">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Room Code</th>
                            <th class="text-center">Building</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Floor</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = $rooms->fetch_assoc()):
                        ?>
                            <tr>
                                <td class="text-center">
                                    <?php echo $i++ ?>
                                </td>
                                <td>
                                    <?php echo $row['roomCODE'] ?>
                                </td>

                                <td>
                                    <?php echo $row['rm_buildingName'] ?>
                                </td>
                                <td>
                                    <?php echo $row['rm_Desc'] ?>
                                </td>
                                <td>
                                    <?php echo $row['rm_type'] ?>
                                </td>
                                <td>
                                    <?php echo $row['rm_floor'] ?>
                                </td>
                                <td>
                                    <center>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary">Action</button>
                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item edit_room" href="javascript:void(0)" data-id='<?php echo $row['roomCODE'] ?>'>Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete_room" href="javascript:void(0)" data-id='<?php echo $row['roomCODE'] ?>'>Delete</a>
                                            </div>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $('table').dataTable();
    $('#new_room').click(function () {
        uni_modal('New Room', 'manage_room.php')
    })
    $('.edit_room').click(function () {
        uni_modal('Edit Room', 'manage_room.php?id=' + $(this).attr('data-id'))
    })
    $('.delete_room').click(function () {
        _conf("Are you sure to delete this room?", "delete_room", [$(this).attr('data-id')])
    })

    function delete_room($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_room',
            method: 'POST',
            data: {
                id: $id
            },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)
                }
            }
        })
    }
</script>
