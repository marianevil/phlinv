<?php
include 'connection.php';

$result = mysqli_query($conn, "SELECT * FROM merchandise ORDER BY id DESC");

$data = [];

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}

echo json_encode($data);
?>