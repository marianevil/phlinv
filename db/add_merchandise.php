<?php
include 'connection.php';

$name = $_POST['name'];
$qty = $_POST['qty'];
$source = $_POST['source'];
$location = $_POST['location'];

$sql = "INSERT INTO merchandise (name, qty, source, location)
        VALUES ('$name', '$qty', '$source', '$location')";

if(mysqli_query($conn, $sql)){
    echo "success";
}else{
    echo "error: " . mysqli_error($conn);
}
?>