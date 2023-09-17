<?php 

include "delete_modal.php";

    if(isset($_POST['checkBoxArray'])){
        foreach(($_POST['checkBoxArray']) as $postValueId ){
            $bulkoptions = $_POST['bulkoptions'];


            switch($bulkoptions){
                case 'publised':
                    
                    $query = "UPDATE posts SET post_status = '{$bulkoptions}' WHERE post_id = '{$postValueId}'";
                    
                    $update_to_published_status = mysqli_query($connection, $query);
                    
                    break;

                case 'draft':

                    $query = "UPDATE posts SET post_status = '{$bulkoptions}' WHERE post_id = '{$postValueId}'";
                    
                    $update_to_draft_status = mysqli_query($connection, $query);
                    
                    break;

                case 'delete':

                    $query = "DELETE FROM posts WHERE post_id = {$postValueId}  ";
                            
                    $update_to_delete_status = mysqli_query($connection, $query);
                            
                    break;

                case "clone":
                    
                    $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                    $dublicate_post_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($dublicate_post_query)){
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_date = $row['post_date'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        $post_content = $row['post_content'];
                    }

                    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, 
                    post_image, post_content, post_tags	,post_status) ";
                    $query .= 
                    "VALUES({$post_category_id}, '{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}',
                    '{$post_tags}','{$post_status}') ";

                    $copy_query = mysqli_query($connection, $query);
                    if(!$copy_query){
                        die("QUERY FAILED" . mysqli_error($connection));
                    }

                    break;
            }
        }
    }
?>



<form action="" method="post">

    <table class="table table-bordered table-hover">

        <div id="bulkOptionContainer" class="col-xs-4">
        <select class="form-control" name="bulkoptions" id="">
            <option value="">Select Options</option>
            <option value="publised">Publish</option>
            <option value="draft">Draft</option>
            <option value="clone">Clone</option>
            <option value="delete">Delete</option>
        </select>
        </div>    

        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-succes" value="Apply">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views</th>
            </tr>
        </thead>

        <tbody>
            <?php showAllPosts(); die("dasdadas"); echo $_SESSION['user_role'];?>
        </tbody>

    </table>

</form>


<?php deletePosts();
resetCountViewPost();
?>

<script>
$(document).ready(function(){

    $(".delete_link").on('click', function(){

        var id = $(this).attr("rel");

        var delete_url = "posts.php?delete="+ id +" ";

        $(".modal_delete_link").attr("href", delete_url);

        $("#myModal").modal('show');
    });

});

</script>

