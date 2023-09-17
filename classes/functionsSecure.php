<?php

function add_User($connection){
    if(isset($_POST['add_user'])){
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
    
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT,
        array("cost" => 12));

        // Pregatire statement 
        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, 
        username, user_email, user_password) ";
        $query .= 
        "VALUES (?, ?, ?, ?, ?, ?) ";
        $stmt = mysqli_prepare($connection, $query);

        // Legatura parametrilor
        mysqli_stmt_bind_param($stmt, "ssssss", $user_firstname, $user_lastname, $user_role, $username, $user_email, $hashed_password);

        // Executarea statement-ului
        mysqli_stmt_execute($stmt);

        // Verificare daca query-ulul a fost un succes 
        if(mysqli_stmt_affected_rows($stmt) == 1){
            header("Location: users.php");
        } else {
            echo "ERROR: " . mysqli_error($connection);
        }

        // Inchidere statement 
        mysqli_stmt_close($stmt);

    }
}
?>