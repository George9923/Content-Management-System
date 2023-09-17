<?php include "includesAdmin/headerAdmin.php";?>
<div id="wrapper">
<?php include "includesAdmin/NavigationAdmin.php";?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-6">

                <h1 class="page-header">
                    Welcome to commets
                    <small>Author</small>
                </h1>

<table class="table table-bordered table-hover">
    
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approved</th>
            <th>Rejected</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
        <?php showAllPostComments();?>
    </tbody>

</table>


<?php deleteCommentsPost();
rejectedCommentsPost();
approvedCommentsPost();?>


                </div>
            </div>
                <!-- /.row -->

        </div>
            <!-- /.container-fluid -->

    </div>
        <!-- /#page-wrapper -->



<?php include "includesAdmin/footerAdmin.php";?>

