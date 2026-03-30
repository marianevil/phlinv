<?php
include "connection.php";

$id = $_GET['id'];
$status = $_GET['status'];

$query = "UPDATE users SET status='$status' WHERE id=$id";

if(mysqli_query($conn, $query)){
    header("Location: ../manage_users.php");
}else{
    echo "Error updating status";
}
?>