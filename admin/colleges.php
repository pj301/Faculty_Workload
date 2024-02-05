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
    <div id="program_table">

    <div class="col-lg-12">
        <div class="row mb-4 mt-4">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <b>Colleges</b>
                        <span class="">
                            <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_college">
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
                                        <th class="">College</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i = 1;
                                $colleges = $conn->query("SELECT * FROM colleges ORDER BY col_ID ASC");
                                while ($row = $colleges->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td class=""><b><?php echo $row['col_name'] ?></b></td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary edit_college" type="button" data-id="<?php echo $row['col_ID'] ?>">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger delete_college" type="button" data-id="<?php echo $row['col_ID'] ?>">Delete</button>
                                            <button class="btn btn-sm btn-outline-primary view_programs" type="button" data-id="<?php echo $row['col_ID'] ?>">Programs Offered</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                
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
    $(document).ready(function () {
        $('table').dataTable()
    })
  
  
    $('.view_programs').click(function () {
    var collegeID = $(this).attr('data-id');
    loadPrograms(collegeID);
});

    $('#new_college').click(function () {
        uni_modal("New Entry", "manage_college.php", 'mid-large')
    })
    $('.view_college').click(function () {
        uni_modal("College Details", "view_college.php?id=" + $(this).attr('data-id'), '')

    })
    $('.edit_college').click(function () {
        uni_modal("Manage College", "manage_college.php?id=" + $(this).attr('data-id'), 'mid-large')

    })
    $('.delete_college').click(function () {
        _conf("Are you sure to delete this college?", "delete_college", [$(this).attr('data-id')], 'mid-large')
    })

    function delete_college($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_college',
            method: 'POST',
            data: { id: $id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("College successfully deleted", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
    function loadPrograms(collegeID) {
    start_load();
    $.ajax({
        url: 'loadprograms.php',
        method: 'POST',
        data: { collegeID: collegeID },
        success: function (resp) {
            $('#program_table').html(resp);
            end_load();
        }
    });
}

</script>
