<?php

if(isset($_POST['submit'])){
    $post_title = escape($connection, $_POST['title']);
    $post_user = escape($connection,$_POST['post_user']);
    $post_category_id = escape($connection,$_POST['post_category_id']);
    $post_status = escape($connection,$_POST['post_status']);

    $post_image = escape($connection,$_FILES['image']['name']);
    $post_image_temp = escape($connection,$_FILES['image']['tmp_name']);

    $post_tags = escape($connection,$_POST['post_tags']);
    $post_content = escape($connection,$_POST['post_content']);
    $post_date = escape($connection,date('d-m-Y')); 

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_user, post_date, 
    post_image, post_content, post_tags	,post_status) ";

    $query .= 
    "VALUES({$post_category_id}, '{$post_title}','{$post_author}','{$post_user}',now(),'{$post_image}','{$post_content}',
    '{$post_tags}','{$post_status}') ";

    $create_post_query = mysqli_query($connection, $query);

    confirmQuery($create_post_query);
    header("Location: posts.php");
}
 ?>


<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
         <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">

    <label for="category">Category</label>
        <select name="post_category_id" id="">

            <?php 
            
            $query = "SELECT * FROM categories ";
            $select_categories = mysqli_query($connection, $query);

            confirmQuery($select_categories);
                                                            
            while($row = mysqli_fetch_assoc($select_categories)){
                $cat_id = escape($connection, $row['cat_id']);
                $cat_title = escape($connection, $row['cat_title']);
            
                $selected = ($cat_id == $post_category_id) ? "selected" : "";
            
                echo "<option value='$cat_id' $selected>{$cat_title}</option>";
            
                echo "cat_id: $cat_id, post_category_id: $post_category_id, selected: $selected<br>";
            }
            
            ?>
            
        </select>
    </div>

    <div class="form-group">

        <label for="Users">Users</label>
        <select name="post_user" id="">

            <?php 
            
            $query = "SELECT * FROM users ";
            $select_users = mysqli_query($connection, $query);

            confirmQuery($select_users);
                                                            
            while($row = mysqli_fetch_assoc($select_users)){
                $user_id = escape($connection, $row['user_id']);
                $username = escape($connection, $row['username']);

                echo "<option value='{$username}'>{$username}</option>";
            }
            
            ?>
            
        </select>
    </div>


    <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
         <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
         <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10">
</textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primay" type="submit" name='submit' value="Add Post">
    </div>

</form>