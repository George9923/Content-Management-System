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

                <?php 
                    
                if(isset($_GET['source'])){
                    $source = $_GET['source'];

                } else {
                    $source = '';
                }

                    switch($source ){

                        case 'add_post';
                        include "includesAdmin/add_post.php";
                        break;

                        case 'edit_post';
                        include "includesAdmin/edit_post.php";
                    
                        break;

                        case '200';
                        echo "Nice 200";
                        break;

                        default:

                        include "includesAdmin/view_all_posts.php";

                        break;
                        

                    }

                ?>

                </div>
            </div>
                <!-- /.row -->

        </div>
            <!-- /.container-fluid -->

    </div>
        <!-- /#page-wrapper -->

</div>


<?php include "includesAdmin/footerAdmin.php";?>
