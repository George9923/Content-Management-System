<?php require_once "functionsSecure.php";?>

<?php add_User($connection);?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">FirstName</label>
         <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">LastName</label>
         <input type="text" class="form-control" name="user_lastname">
    </div>


    <div class="form-group">
        <select name="user_role" id="">

        <option value="subscriber">Select Option</option>

        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>

        </select>
    </div>

    <div class="form-group">
        <label for="post_tags">UserName</label>
         <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_content">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primay" type="submit" name='add_user' value="Add User">
    </div>

</form>