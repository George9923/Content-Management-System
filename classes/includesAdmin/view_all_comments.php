<table class="table table-bordered table-hover">
    
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approved</th>
            <th>Rejected</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
        <?php showAllComments();?>
    </tbody>

</table>


<?php deleteComments();
rejectedComments();
approvedComments();?>

