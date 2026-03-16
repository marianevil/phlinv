<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($_POST['id']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = "UPDATE users SET 
                    username='$username', 
                    role='$role',
                    password='$password'
                 WHERE id=$id";
    } else {
        $query = "UPDATE users SET 
                    username='$username', 
                    role='$role'
                 WHERE id=$id";
    }

    mysqli_query($conn, $query);
}

header("Location: ../manage_users.php");
exit();
?>