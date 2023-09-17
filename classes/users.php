<?php include "includesAdmin/headerAdmin.php";?>
<div id="wrapper">


<?php 

    if(!is_admin($_SESSION['username'])){
        header('Location: index.php');
    }

?>






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

                        case 'add_user';
                        include "includesAdmin/add_user.php";
                        break;

                        case 'edit_user';
                        include "includesAdmin/edit_user.php";
                    
                        break;

                        case '200';
                        echo "Nice 200";
                        break;

                        default:

                        include "includesAdmin/view_all_users.php";

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
