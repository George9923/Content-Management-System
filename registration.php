<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php";
include "functionsCMS.php";?>

<?php 

// Setting Language Variables 

changelang();
registerUser($connection);
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">

    <form method="get" class="navbar-form navbar-right" action="" id="language_form">
        <div class="form-group">
            <select name="lang" class="form-control" onchange="changeLanguage()">
                <option value="en" <?php    if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'en'){ echo "selected en"; } ?>>English</option>
                <option value="ro"  <?php    if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'ro'){ echo "selected ro"; } ?>>Romanian</option>
            </select>
        </div>
    </form>
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1><?php echo _REGISTER;?></h1>


                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                    

                        <div class="form-group">
                            <label for="user_firstname" class="sr-only">Firstname</label>
                            <input type="text" name="user_firstname" id="user_firstname" class="form-control" placeholder="<?php echo _FIRSTNAME;?>"
                            
                            autocomplete="on"

                            value="<?php echo isset($user_firstname) ? $user_firstname: ''?>"
                            
                            >

                        </div>

                        <div class="form-group">
                            <label for="user_lastname" class="sr-only">Lastname</label>
                            <input type="text" name="user_lastname" id="user_lastname" class="form-control" placeholder="<?php echo _LASTNAME;?>"
                            
                            autocomplete="on"

                            value="<?php echo isset($user_lastname) ? $user_lastname: ''?>"
                            
                            
                            >

                        </div>

                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME;?>"
                            
                            
                            autocomplete="on"

                            value="<?php echo isset($username) ? $username: ''?>"                            
                            >

                            <p><?php echo isset($error['username']) ? $error['username']: ''?></p>
                        
                        
                        </div>



                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL;?>"
                            
                            autocomplete="on"

                            value="<?php echo isset($email) ? $email: ''?>"
                            
                            
                            
                            
                            >
                        </div>

                        <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD;?>">
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">

                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

        <script>
            function changeLanguage(){
                document.getElementById('language_form').submit();

            }
        </script>



<?php include "includes/footer.php";?>
