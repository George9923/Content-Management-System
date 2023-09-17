<?php include "includesAdmin/headerAdmin.php";?>
<div id="wrapper">
<?php include "includesAdmin/NavigationAdmin.php";?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-6">

                        <h1 class="page-header">
                            Welcome to admin <?php echo strtoupper( getUserName());?>
                        </h1>
                        
                        </h1>

                        <div class="col-xs-6">

                        <?php insert_categories(); ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input type="text" class="form-control" name='cat_title'>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primay" type="submit" name='submit' value="Add Category">
                            </div>

                        </form>


                        <?php // UPDATE AND INCLUDE QUERY 
                        
                        if(isset($_GET['edit'])){

                            $cat_id = $_GET['edit'];
                            include "includesAdmin/update_categories.php";

                        }
                        
                        ?>
                        </div> <!--Add Category Form-->
                        <div class="col-xs-12">

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th> 
                                    <th>Category Title</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php findAllCategories();?>
                                <?php deleteCategories();?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>


<?php include "includesAdmin/footerAdmin.php";?>
