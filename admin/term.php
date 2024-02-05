<?php include('db_connect.php'); ?>

<div class="container-fluid">
    <style>
        input[type=checkbox] {
            /* Double-sized Checkboxes */
            -ms-transform: scale(1.5); /* IE */
            -moz-transform: scale(1.5); /* FF */
            -webkit-transform: scale(1.5); /* Safari and Chrome */
            -o-transform: scale(1.5); /* Opera */
            transform: scale(1.5);
            padding: 10px;
        }
    </style>
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
                        <b>Term List</b>
                        <span class="">
                            <button class="btn btn-primary btn-block btn-sm col-sm-2 float-right" type="button" id="new_term">
                                <i class="fa fa-plus"></i> New</button>
                        </span>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed table-hover">
                                <colgroup>
                                    <col width="15%">
                                    <col width="30%">
                                    <col width="25%">
                                    <col width="15%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="">Term Name</th>
                                        <th class="">Start Date</th>
                                        <th class="">End Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $terms = $conn->query("SELECT * FROM term ORDER BY termID ASC");
                                    while ($row = $terms->fetch_assoc()):
                                    ?>
                                        <tr>

                                            <td class="text-center"><?php echo $i++ ?></td>
                                            <td class=""><?php echo $row['termName'] ?></td>
                                            <td class=""><?php echo $row['startDate'] ?></td>
                                            <td class=""><?php echo $row['endDate'] ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary view_term" type="button" data-id="<?php echo $row['termID'] ?>">View</button>
                                                <button class="btn btn-sm btn-outline-primary edit_term" type="button" data-id="<?php echo $row['termID'] ?>">Edit</button>
                                                <button class="btn btn-sm btn-outline-danger delete_term" type="button" data-id="<?php echo $row['termID'] ?>">Delete</button>
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
    /* Adjust content width when the sidebar is collapsed */
#view-panel.collapsed {
  margin-left: 50px;
  transition: margin-left 0.3s ease; /* Add transition for smooth width change */
  width: 90%;
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
    $('#new_term').click(function () {
        uni_modal("New Entry", "manage_term.php", 'mid-large')
    })
    $('.view_term').click(function () {
        uni_modal("Term Details", "view_term.php?id=" + $(this).attr('data-id'), '')

    })
    $('.edit_term').click(function () {
        uni_modal("Manage Term", "manage_term.php?id=" + $(this).attr('data-id'), 'mid-large')

    })
    $('.delete_term').click(function () {
        _conf("Are you sure to delete this term?", "delete_term", [$(this).attr('data-id')], 'mid-large')
    })

    function delete_term($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_term',
            method: 'POST',
            data: { id: $id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Term successfully deleted", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
</script>
