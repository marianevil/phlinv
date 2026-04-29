<?php
include "connection.php";

$id = $_POST['id'];

$row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM merchandise WHERE id=$id"));

$old_details =
"MERCHANDISE: {$row['name']}
QUANTITY: {$row['qty']}
SOURCE: {$row['source']}
LOCATION: {$row['location']}
DATE RECEIVED: {$row['date_received']}";

$new_details = $old_details;

mysqli_query($conn,"DELETE FROM merchandise WHERE id=$id");

mysqli_query($conn,"INSERT INTO merchandise_history(merch_id,action,old_details,new_details)
VALUES($id,'DELETE','$old_details','$new_details')");

echo "success";
?>