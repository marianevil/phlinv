<?php
include 'connection.php';

$id = $_POST['id'];

$sql = "DELETE FROM merchandise WHERE id=$id";

if(mysqli_query($conn, $sql)){
    echo "success";
}else{
    echo "error";
}
?>