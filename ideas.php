<!DOCTYPE html>

<?php
// METADATA
$page_title = 'Ideas';

include_once 'includes/database.php';
include 'includes/head.php';
include 'includes/sidebar.php';
include 'includes/header.php';
include '_functions/_ideas.php';
?>

<!--Body goes here-->
<div class="col-12">
    <div class="card mb-4">
        <div class="card-block">
            <h3 class="card-title">Project Ideas List</h3>
            <div class="card-title-btn-container">
                <button type="button" class="btn btn-primary" id="btnNewIdea"><i class="fa fa-plus"></i> New Idea</button>
            </div>
            <div class="table-responsive">
                <!--TABLE-->
                <table id='tblIdeas' class="table table-striped">
                    <thead>
                        <tr>
                            <!--<th>ID</th>-->
                            <th>Title</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM ProjectPlanner_DB.Ideas;";
                        $get_ideas_list = $conn->query($sql);

                        if ($get_ideas_list->num_rows > 0) {
                            // output data of each row
                            while ($row = $get_ideas_list->fetch_assoc()) {
                                echo "<tr data-id='" . $row["idIdeas"] . "'>"
//                                . "<td>" . $row["idIdeas"] . "</td>"
                                . "<td>" . $row["Title"] . "</td>"
                                . "<td>" . $row["Description"] . "</td>"
                                . "<td class='text-right'>"
                                . "<button type='button' class='btnEdit btn btn-info btn-sm'><i class=\"fa fa-pencil\"></i> Edit</button>&nbsp;"
                                . "<button class='btnDelete btn btn-dark btn-sm'><i class=\"fa fa-trash-o\"></i> Delete</button>"
                                . "</td>"
                                . "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class='action_buttons' style='display:none;'>
        <button type='button' class='btn btn-info btn-sm'><i class="fa fa-pencil"></i> Edit</button>&nbsp;
        <button class='btn btn-dark btn-sm'><i class="fa fa-trash-o"></i> Delete</button>
    </div>
    
</div>
<!--End body-->

<!--FOOTER SCRIPTS-->
<?php include 'includes/footer_scripts.php'; ?>

<!--SCRIPTS-->
<script>
    $(function () {
        var table = $('#tblIdeas').DataTable();

        $('#btnNewIdea').click(function () {
            var b = bootbox.dialog({
                message: '<h3 class="card-title">New Project Idea</h3> <div class="form-group"> <label for="txtTitle">Title</label> <input class="form-control" id="txtTitle" name="title" placeholder="Your awesome idea title"/> </div><div class="form-group"> <label for="txtDesc">Description</label> <textarea class="form-control" name="description" id="txtDesc" rows="5"></textarea> </div><div class="form-group text-right"> </div>',
                buttons: {
                    cancel: {
                        label: "Cancel",
                        className: 'btn-secondary'
                    },
                    ok: {
                        label: 'Submit',
                        callback: function () {
                            console.log('btton');
                            var title = $('#txtTitle').val();
                            var desc = $('#txtDesc').val();
                            console.log(title + ": " + desc);

                            $.ajax({
                                url: '_functions/_ideas.php',
                                type: 'POST',
                                data: {
                                    'insert': 1,
                                    'title': title,
                                    'desc': desc
                                },
                                success: function () {
                                    location.reload();
                                },
                                error: function (error) {
                                    console.log(error);
                                }
                            });
                        }
                    }
                }
            });
        });
        
//        $('#btnNewIdea').click(function () {
//            var b = bootbox.dialog({
//                message: '<h3 class="card-title">Edit Project Idea</h3> <div class="form-group"> <label for="txtTitle">Title</label> <input class="form-control" id="txtTitle" name="title" placeholder="Your awesome idea title"/> </div><div class="form-group"> <label for="txtDesc">Description</label> <textarea class="form-control" name="description" id="txtDesc" rows="5"></textarea> </div><div class="form-group text-right"> </div>',
//                buttons: {
//                    cancel: {
//                        label: "Cancel",
//                        className: 'btn-secondary'
//                    },
//                    ok: {
//                        label: 'Submit',
//                        callback: function () {
//                            console.log('btton');
//                            var title = $('#txtTitle').val();
//                            var desc = $('#txtDesc').val();
//                            console.log(title + ": " + desc);
//
//                            $.ajax({
//                                url: '_functions/_ideas.php',
//                                type: 'POST',
//                                data: {
//                                    'insert': 1,
//                                    'title': title,
//                                    'desc': desc
//                                },
//                                success: function () {
//                                    location.reload();
//                                },
//                                error: function (error) {
//                                    console.log(error);
//                                }
//                            });
//                        }
//                    }
//                }
//            });
//        });
    });
</script>


<!--FOOTER-->
<?php include 'includes/footer.php'; ?>
