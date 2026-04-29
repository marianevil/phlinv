<?php
include "connection.php";

$sql = mysqli_query($conn,"SELECT * FROM merchandise ORDER BY id DESC");

$data = [];

while($row=mysqli_fetch_assoc($sql)){
$data[]=$row;
}

echo json_encode($data);
?>