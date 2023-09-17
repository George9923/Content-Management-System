<?php include "includesAdmin/headerAdmin.php";?>

<?php 
                
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];  

        $query = "SELECT * FROM users WHERE username = '{$username}' ";

        $select_user_profile = mysqli_query($connection, $query);

        while($row = mysqli_fetch_array($select_user_profile)){
            $user_id  = $row['user_id'];
            $username  = $row['username'];
            $user_password  = $row['user_password'];
            $user_firstname  = $row['user_firstname'];
            $user_lastname  = $row['user_lastname'];
            $user_email  = $row['user_email'];
            $user_image  = $row['user_image'];
            $user_role  = $row['user_role'];
    
        }
    }
            
?>

<?php 
        if(isset($_POST['edit_user'])){
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $username = $_POST['username'];
            $user_email = $_POST['user_email'];
            $user_password = $_POST['user_password'];

    
            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$user_firstname}' , ";
            $query .= "user_lastname = '{$user_lastname}' , ";
            $query .= "username = '{$username}' , ";
            $query .= "user_email = '{$user_email}' , ";
            $query .= "user_password = '{$user_password}'  ";
            $query .= "WHERE username = '{$username}' ";
            
            $update_user = mysqli_query($connection, $query);
            
            confirmQuery($update_user);
            header("Location: users.php");
    
        }

?>


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

                <form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">FirstName</label>
     <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
</div>

<div class="form-group">
    <label for="post_status">LastName</label>
     <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
</div>

<div class="form-group">
    <label for="post_tags">UserName</label>
     <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
</div>

<div class="form-group">
    <label for="post_content">Email</label>
    <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
</div>

<div class="form-group">
    <label for="post_content">Password</label>
    <input autocomplete="off" type="password" class="form-control" name="user_password" value="">
</div>

<div class="form-group">
    <input class="btn btn-primay" type="submit" name='edit_user' value="Update Profile">
</div>

</form>

                <?php 
                    
                if(isset($_GET['source'])){
                    $source = $_GET['source'];

                } else {
                    $source = '';
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
