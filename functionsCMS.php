<?php 
include_once "admin/functions.php";


function create_comment_post($connection){

    if(isset($_POST['create_comment'])){

        $the_post_id = $_GET['p_id'];

        $comment_author = $_POST['comment_author'];
        $comment_email = $_POST['comment_email'];
        $comment_content = $_POST['comment_content'];


        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {

            $query = "INSERT INTO comments(comment_post_id, comment_author,
            comment_email, comment_content, comment_status, comment_date)";

            $query .= "VALUES($the_post_id , '{$comment_author}','{$comment_email}' ,
            '{$comment_content}', 'rejected', now())";


            $create_comment_query = mysqli_query($connection, $query);

            if(!$create_comment_query){
                die("QUERY FAILED" . mysqli_error($connection));
            } 


            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
            $query .= "WHERE post_id = $the_post_id ";


            $update_comment_count = mysqli_query($connection, $query);

        } else {
            echo "<script>alert('Fields cannot be empty')</script>";
        }

    }

}

function changelang(){
    if(isset($_GET['lang']) && !empty($_GET['lang'])){
        $_SESSION['lang'] = $_GET['lang'];
    
        if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']){
            echo "<script type='text/javascript'> location.reload(); </script>";
        }
    }
    
    if(isset($_SESSION['lang'])){
        include "includes/languages/" . $_SESSION['lang'] . ".php";
    } else {
        include "includes/languages/en.php";
    }
}

function resetpassword($connection){
    
if(!isset($_GET['email']) && !isset($_GET['token'])){

    redirectUsers('index.php');
}


if($stmt = mysqli_prepare($connection, 'SELECT username, user_email, token FROM users WHERE token = ?')){

    mysqli_stmt_bind_param($stmt, "s", $_GET['token']);
    mysqli_stmt_bind_result($stmt, $username, $user_email, $token);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    
    if(isset($_POST['password']) && isset($_POST['confirmpassword'])){
   
        if($_POST['password'] === $_POST['confirmpassword']){

            $password = $_POST['password'];
            $hashespassowrd = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));


            if($stmt = mysqli_prepare($connection, "UPDATE users SET token='', user_password='{$hashespassowrd}' WHERE user_email = ? ")){
                mysqli_stmt_bind_param($stmt, "s", $_GET['email']);
                mysqli_stmt_execute($stmt);

                if(mysqli_stmt_affected_rows($stmt) >= 1){

                    redirectUsers("login.php");

                } 
                mysqli_stmt_close($stmt);
        }
    }

} 
}
}

function registerUser($connection){
    global $message;

    if($_SERVER['REQUEST_METHOD'] == "POST") {

        $username = trim(isset($_POST["username"]) ? $_POST["username"] : "");
        $user_firstname = trim(isset($_POST["user_firstname"]) ? $_POST["user_firstname"] : "");
        $user_lastname = trim(isset($_POST["user_lastname"]) ? $_POST["user_lastname"] : "");
        $email = trim(isset($_POST["email"]) ? $_POST["email"] : "");
        $password = trim(isset($_POST["password"]) ? $_POST["password"] : "");
        $role = 'subscriber';

        $error = [
            'username' => '',
            'user_firstname' => '',
            'user_lastname' => '',
            'email' => '',
            'password' => ''
        ];
        
        if (strlen($username) < 4) {
            $error['username'] = 'Username needs to be longer';
        } 
        if ($username == '') {
            $error['username'] = 'Username cannot be empty';
        } 
        if (username_exists($username)) {
            $error['username'] = 'Username already exists. Please choose a different username.';
        } 
        if (email_exist($email)) {
            $error['email'] = 'Email already exists. <a href="index.php">Please login</a>';
        } 
        if ($email == '') {
            $error['email'] = 'Email cannot be empty';
        } 
        if ($password == '') {
            $error['password'] = 'Password cannot be empty';
        } 
        
        foreach ($error as $key => $value) {
            if (!empty($value)) {
                unset($error[$key]);
                login_user($username, $password);
                echo '<div class="error">' . $value . '</div>';
            }
        }
        if(empty($error)){
            registerUser($connection);
        }
    
            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);
            $user_firstname = mysqli_real_escape_string($connection,$user_firstname);
            $user_lastname = mysqli_real_escape_string($connection, $user_lastname);
        
            $hased_password = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
            
            $query = "INSERT INTO users (username, user_firstname, user_lastname, user_email, user_password, user_role) ";
            $query .= "VALUES(?, ?, ?, ?, ?, ?) ";
            $stmt = mysqli_prepare($connection, $query);
            
            mysqli_stmt_bind_param($stmt, "ssssss", $username, $user_firstname, $user_lastname, $email, $hased_password, $role);

            mysqli_stmt_execute($stmt);

            if(mysqli_stmt_affected_rows($stmt) == 1){
                // $message = "Your Registration has been submitted";
            } else {
                $message = "Fields cannot be empty";
            }

            mysqli_stmt_close($stmt);
        
        }  else {
                $message = "";
        }

}


function login_user($username, $password){
    global $connection;

    $username = trim($username);
    $password = trim($password);

    // for injections 
    $username = mysqli_real_escape_string($connection, $username); 
    $password = mysqli_real_escape_string($connection, $password); 

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_users_query = mysqli_query($connection, $query );

    if(!$select_users_query){
        die("NO" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($select_users_query)){
        $db_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

    
        if(password_verify($password, $db_user_password)){
        
        $_SESSION['user_id'] = $db_id;
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        
        redirectUsers("/CMS/admin");
        

    } else {

        return false;
    }

    }

    return true;


}




?>