<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Edit Category</label>

        <?php 

        if(isset($_GET['edit'])){
        
            $cat_id = $_GET['edit'];
    
            $query = "SELECT * FROM categories WHERE cat_id = $cat_id ";
            $select_categories_update = mysqli_query($connection, $query);
                                                            
            while($row = mysqli_fetch_assoc($select_categories_update)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            }
            }?>

        <input value ="<?php if(isset($cat_title)){echo $cat_title;} ?>"
        type="text" class="form-control" name='cat_title'>


        <?php 
                                                    
        if(isset($_POST['update_category'])){ // 
            $the_cat_id = $_POST['cat_title'];
            $query = "UPDATE categories SET cat_title =  '{$the_cat_id}' WHERE cat_id = {$cat_id} ";
            $update_categories = mysqli_query($connection, $query);
                                                                
        if(!$update_categories){
        die("QUERY FAILED" . mysqli_error($connection));
        }

        }            
                                                    
                     
        ?>

        </div>

        <div class="form-group">
        <input class="btn btn-primay" type="submit" name='update_category' value="Update Category">
        </div>

    </div>

</form>


