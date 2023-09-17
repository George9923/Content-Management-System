<table class="table table-bordered table-hover">
   
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Role</th>
            <th>Convert to admin</th>
            <th>Convert to subscriber</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
        <?php showUsers();?>
    </tbody>

</table>


<?php 
deleteUsers();
change_to_admin_user();
change_to_subscriber_user();?>

