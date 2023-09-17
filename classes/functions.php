<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function escape($connection, $string){
    return mysqli_real_escape_string($connection, trim(($string)));
}


function users_online(){
    global $connection;
$session = session_id();
$time = time();
$time_out_in_seconds = 30;
$time_out = $time - $time_out_in_seconds;

$query = "SELECT * FROM users_online WHERE session = '$session' ";
$send_query = mysqli_query($connection, $query);

$count = mysqli_num_rows($send_query);

if($count == NULL){
    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time') ");
} else {
    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
}

$users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out' ");
return $count_user = mysqli_num_rows($users_online_query);

}

function redirect($location){
    header(header:"Location:" . $location);
    exit();
}

function confirmQuery($result){
    global $connection;
    if (!$result) {
        die("Query Failed: " . mysqli_error($connection));
    }
}

function insert_categories(){

    global $connection;

    if(isset($_POST['submit'])){

        $cat_title = $_POST['cat_title'];


        if($cat_title == "" || empty($cat_title)){

             echo "This field should not be empty";

        } else {

             $query = "INSERT INTO categories(cat_title) ";
             $query .= "VALUES('{$cat_title}') ";

             $create_categories = mysqli_query($connection, $query);

             if(!$create_categories){
                 die("FAILED" . mysqli_error($connection));
             }
         }
     }
}

function findAllCategories(){

    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>$cat_id</td>";
        echo "<td>$cat_title</td>";
        echo "<td><a class='btn btn-info' href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<td><a class='btn btn-danger' href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "</tr>";
    }

}

function deleteCategories(){

    global $connection;     
             
    if(isset($_GET['delete'])){

        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_categories = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}


// FUNCTII VIEW_ALL_COMMENTS




function showAllComments(){
    global $connection;
                            
    $query = "SELECT * FROM comments ";
    $select_comments = mysqli_query($connection, $query);
                            
    while($row = mysqli_fetch_assoc($select_comments)){
    $comment_id  = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];                    
    $comment_author = $row['comment_author'];        
    $comment_content = $row['comment_content'];
    $comment_email = $row['comment_email'];
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo "<tr>";
    echo "<td>{$comment_id}</td>";
    echo "<td>{$comment_author}</td>";
    echo "<td>{$comment_content}</td>";
    echo "<td>{$comment_email}</td>";
    echo "<td>{$comment_status}</td>";

    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
    $select_post_id_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_post_id_query)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];


        echo "<td><a class='btn btn-link' href='../post.php?p_id=$post_id'>{$post_title}</a></td>";

    }

    echo "<td>{$comment_date}</td>";
    echo "<td><a class='btn btn-success' href='comments.php?approved=$comment_id'>Approved</a></td>";
    echo "<td><a class='btn btn-info' href='comments.php?rejected=$comment_id'>Rejected</a></td>";
    echo "<td><a class='btn btn-danger' href='comments.php?delete=$comment_id'>Delete</a></td>";
    echo "</tr>";
    }
                                
}

function showAllPostComments(){
    global $connection;
                            
    $query = "SELECT * FROM comments WHERE comment_post_id = ". mysqli_real_escape_string($connection, $_GET['id']) ." ";
    $select_comments = mysqli_query($connection, $query);
                            
    while($row = mysqli_fetch_assoc($select_comments)){
    $comment_id  = $row['comment_id'];
    $comment_post_id = $row['comment_post_id'];                    
    $comment_author = $row['comment_author'];        
    $comment_content = $row['comment_content'];
    $comment_email = $row['comment_email'];
    $comment_status = $row['comment_status'];
    $comment_date = $row['comment_date'];

    echo "<tr>";

    echo "<td>{$comment_id}</td>";
    echo "<td>{$comment_author}</td>";
    echo "<td>{$comment_content}</td>";


    // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
    // $select_categories_update = mysqli_query($connection, $query);
                                                    
    // while($row = mysqli_fetch_assoc($select_categories_update)){
    //     $cat_id = $row['cat_id'];
    //     $cat_title = $row['cat_title'];
    
    //     echo "<td>{$cat_title}</td>";
    // }

    echo "<td>{$comment_email}</td>";
    echo "<td>{$comment_status}</td>";

    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
    $select_post_id_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_post_id_query)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];


        echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";

    }


    echo "<td>{$comment_date}</td>";
    echo "<td><a href='post_comments.php?approved=$comment_id&id={$_GET['id']}'>Approved</a></td>";
    echo "<td><a href='post_comments.php?rejected=$comment_id&id={$_GET['id']}'>Rejected</a></td>";
    echo "<td><a href='post_comments.php?delete=$comment_id&id={$_GET['id']}'>Delete</a></td>";

    echo "</tr>";
    }
                                
}

function deleteComments(){
    global $connection;
    if(isset($_GET['delete'])){

        $the_comment_id = $_GET['delete'];
    
        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
        $delete_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    
    }
}

function deleteCommentsPost(){
    global $connection;
    if(isset($_GET['delete'])){
        $the_comment_id = $_GET['delete'];
    
        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
        $delete_comment_query = mysqli_query($connection, $query);
        header("Location: post_comments.php?id=".$_GET['id']."");
    
    }
}

function rejectedComments(){
    global $connection;
        
    if(isset($_GET['rejected'])){

        $the_comment_id = $_GET['rejected'];

        $query = "UPDATE comments SET comment_status = 'rejected' WHERE comment_id = $the_comment_id ";
        $rejected_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");

    }
}

function rejectedCommentsPost(){
    global $connection;
        
    if(isset($_GET['rejected'])){

        $the_comment_id = $_GET['rejected'];

        $query = "UPDATE comments SET comment_status = 'rejected' WHERE comment_id = $the_comment_id ";
        $rejected_comment_query = mysqli_query($connection, $query);
        header("Location: post_comments.php?id=".$_GET['id']."");

    }
}

function approvedComments(){
    global $connection;
    if(isset($_GET['approved'])){

        $the_comment_id = $_GET['approved'];
    
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
        $approved_comment_query = mysqli_query($connection, $query);
        header("Location: comments.php");
    
    }
    
}

function approvedCommentsPost(){
    global $connection;
    if(isset($_GET['approved'])){

        $the_comment_id = $_GET['approved'];
    
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
        $approved_comment_query = mysqli_query($connection, $query);
        header("Location: post_comments.php?id=".$_GET['id']."");
    
    }
    
}


// FUNCTII VIEW_ALL_POSTS


function deletePosts(){
    global $connection;
    if(isset($_POST['delete'])){

        $the_post_id = $_POST['post_id'];

        $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
        $delete_query_posts = mysqli_query($connection, $query);
        header("Location: posts.php");

    }
}

function resetCountViewPost(){
    global $connection;
    if(isset($_GET['reset'])){

        $the_post_id = $_GET['reset'];

        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = " . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
        $reset_query_posts = mysqli_query($connection, $query);
        header("Location: posts.php");

    }
}

function showAllPosts(){
    global $connection;
                                    
    $query = "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, ";
    $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
    $query .= " FROM posts ";
    $query .= " LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";

    
    $select_posts = mysqli_query($connection, $query);
                            
    while($row = mysqli_fetch_assoc($select_posts)){
    $post_id  = $row['post_id'];
    $post_author = $row['post_author'];   
    $post_user = $row['post_user'];                                     
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
    $post_views_count = $row['post_views_count'];
    $category_title = $row['cat_title'];
    $category_id = $row['cat_id'];

    echo "<tr>";
    ?>
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $post_id; ?>"></td>
    <?php

    echo "<td>{$post_id}</td>";

    if(!empty($post_author)){
        echo "<td>{$post_author}</td>";
    } elseif(!empty($post_user)) {
        echo "<td>{$post_user}</td>";
    }




    echo "<td>{$post_title}</td>";



    echo "<td>{$category_title}</td>";


    echo "<td>{$post_status}</td>";
    echo "<td><img class='img-responsive' src='../images/{$post_image}' alt='images'></td>";
    echo "<td>{$post_tags}</td>";

    $query_comments = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
    $send_comment_query = mysqli_query($connection, $query_comments);

    if($send_comment_query){
        $count_commets = mysqli_num_rows($send_comment_query);
  
    if($count_commets > 0){
        $row = mysqli_fetch_array($send_comment_query);
        $comment_id = $row['comment_id'];
    
        echo "<td><a href='post_comments.php?id=$post_id'>$count_commets</a></td>";
    
    } else {
       echo "<td><a href='post_comments.php?id=$post_id'>0</a></td>";
    }
    } else {
        echo "Error: " . mysqli_error($connection);
    }



    echo "<td>{$post_date}</td>";
    echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>";
    echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";

    ?>

    <form action="" method="post">

    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

    <?php

    echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>'

    ?>


    </form>

<?php

    // echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";



    // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "<td><a href='posts.php?delete={$post_id}'>{$post_views_count}</a></td>";
    echo "</tr>";
    }
          
}




// FUNCTII VIEW_ALL_USERS


function deleteUsers(){
    global $connection;
    if(isset($_GET['delete'])){

        if(isset($_SESSION['user_role'])){

            if($_SESSION['user_role'] == 'admin'){

        $the_user_id = mysqli_real_escape_string($connection,$_GET['delete']);
    
        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
        $delete_users_query = mysqli_query($connection, $query);
        header("Location: users.php");
    }
    }
    }
    
}

function change_to_admin_user(){
    global $connection;
    if(isset($_GET['change_to_admin'])){

        $the_user_id = $_GET['change_to_admin'];
    
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
        $change_to_admin_query = mysqli_query($connection, $query);
        header("Location: users.php");
    
    }
    
}

function change_to_subscriber_user(){
    global $connection;
    if(isset($_GET['change_to_subscriber'])){

        $the_user_id = $_GET['change_to_subscriber'];
    
        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
        $change_to_subscriber_query = mysqli_query($connection, $query);
        header("Location: users.php");
    
    }
}

function showUsers(){
    global $connection;
    $query = "SELECT * FROM users ";
    $select_users = mysqli_query($connection, $query);
                            
    while($row = mysqli_fetch_assoc($select_users)){
    $user_id  = $row['user_id'];
    $username  = $row['username'];
    $user_password  = $row['user_password'];
    $user_firstname  = $row['user_firstname'];
    $user_lastname  = $row['user_lastname'];
    $user_email  = $row['user_email'];
    $user_image  = $row['user_image'];
    $user_role  = $row['user_role'];

    echo "<tr>";

    echo "<td>{$user_id}</td>";
    echo "<td>{$username}</td>";
    echo "<td>{$user_firstname}</td>";

    echo "<td>{$user_lastname}</td>";
    echo "<td>{$user_email}</td>";
    echo "<td>{$user_role}</td>";

    echo "<td><a class='btn btn-primary' href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
    echo "<td><a class='btn btn-success' href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";
    echo "<td><a class='btn btn-info' href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
    echo "<td><a class='btn btn-danger' href='users.php?delete={$user_id}'>Delete</a></td>";
    echo "</tr>";
    }
}

function recordCount($connection, $table){

    $query = "SELECT * FROM " . $table;
    $select_all_posts = mysqli_query($connection, $query);

    $result = mysqli_num_rows($select_all_posts);

    confirmQuery($result);

    return $result;
}

function checkStatus($connection, $table, $column, $status){

    $query = "SELECT * FROM $table WHERE $column = '$status'";
    $result = mysqli_query($connection, $query);

    confirmQuery($result);

    return mysqli_num_rows($result);
}


function checkUserRole($connection, $table, $column, $role){

    $query = "SELECT * FROM $table WHERE $column = '$role'";
    $select_all_subscribers = mysqli_query($connection, $query);

    return mysqli_num_rows($select_all_subscribers);
}

function is_admin(){

    if(isLoggedIn()){


        $result = query("SELECT user_role FROM users WHERE user_id =" . $_SESSION['user_id'] ." ");    
        $row = fetchRecords($result);
    
        if($row['user_role'] == 'admin'){
            return true; 
        } else {
            return false;
        }
    }
    return false;

}

function get_all_posts_user_comments(){
    return query("SELECT * FROM posts 
    INNER JOIN comments 
    ON posts.post_id=comments.comment_post_id
    WHERE user_id=". loggedInUserId() ."");
}

function get_all_user_categories(){
    return query("SELECT * FROM categories WHERE user_id=". loggedInUserId() ."");
}


function get_all_user_published_posts(){
    return query("SELECT * FROM posts WHERE user_id=". loggedInUserId() ." AND post_status='publised'");
}

function get_all_user_approved_comments(){
    return query("SELECT * FROM posts 
    INNER JOIN comments 
    ON posts.post_id=comments.comment_post_id
    WHERE user_id=". loggedInUserId() ." AND comment_status='approved'");
}

function get_all_user_rejected_comments(){
    return query("SELECT * FROM posts 
    INNER JOIN comments 
    ON posts.post_id=comments.comment_post_id
    WHERE user_id=". loggedInUserId() ." AND comment_status='rejected'");}


function get_all_user_draft_posts(){
    return query("SELECT * FROM posts WHERE user_id=". loggedInUserId() ." AND post_status='draft'");
}



function getUserName(){

    return isset($_SESSION['username']) ? $_SESSION['username'] : null;

}

function getUserPost(){
    return query("SELECT * FROM posts WHERE user_id=". loggedInUserId() ."");
}

function count_records($result){
    return mysqli_num_rows($result);
}



function fetchRecords($result){
    return mysqli_fetch_array($result);
}


function username_exists($username){
    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username' ";

    $result = mysqli_query($connection, $query); 
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }


}


function email_exist($email){
    global $connection;

    $query = "SELECT user_email FROM users WHERE user_email = '$email' ";

    $result = mysqli_query($connection, $query); 
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }


}

function redirectUsers($location){
    header("Location:" . $location);
    exit;
}


function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;

    }

    return false;

}

function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
   return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    
    if(isLoggedIn()){
        redirect($redirectLocation);

    }

}

function imageplaceholder($image=null){
    if(!$image){
        return 'Java.jpg';
    } else {
        return $image;
    }
}

function loggedInUserId(){
    if(isLoggedIn()){
        $result = query("SELECT * FROM users WHERE username='" . $_SESSION['username'] ."'");
        confirmQuery($result);
        $user = mysqli_fetch_array($result);
        return mysqli_num_rows($result) >= 1 ? $user['user_id'] : false;
    }
    return false;
}

function userLikedThisPost($post_id){
    $result = query("SELECT * FROM likes WHERE user_id=" .loggedInUserId() . " AND post_id={$post_id}");
    confirmQuery($result);
    return mysqli_num_rows($result) >= 1 ? true : false;
}

function getPostlikes($post_id){
    $result = query("SELECT * FROM likes WHERE post_id = $post_id");
    confirmQuery($result);
    echo mysqli_num_rows($result);
}

function query($query){
    global $connection;
    return mysqli_query($connection, $query);
}


?>