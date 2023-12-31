<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; 
include_once 'admin/functions.php';
include_once 'functionsCMS.php';?>

<?php resetpassword($connection);?>

<!-- Navigation -->
<?php  include "includes/navigation.php"; ?>
    

<!-- Page Content -->
<div class="container">




    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Reset Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                        <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="password" name="password" placeholder="Enter New Password" class="form-control"  type="password">
                                        </div>

                                        <div class="form-group">
                                        <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="confirmpassword" name="confirmpassword" placeholder="Confirm New Password" class="form-control"  type="password">
                                        </div>
                                        
                                        
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>
                                </div><!-- Body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->
