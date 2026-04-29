<?php
include "connection.php";

$id = $_POST['id'];
$qtyAdd = $_POST['qty'];

$result = mysqli_query($conn,"SELECT * FROM merchandise WHERE id=$id");
$row = mysqli_fetch_assoc($result);

$oldQty = $row['qty'];

$newQty = $oldQty + $qtyAdd;

mysqli_query($conn,"UPDATE merchandise SET qty='$newQty' WHERE id=$id");

$old_details =
"MERCHANDISE: {$row['name']}
QUANTITY: $oldQty
SOURCE: {$row['source']}
LOCATION: {$row['location']}
DATE RECEIVED: {$row['date_received']}";

$new_details =
"MERCHANDISE: {$row['name']}
QUANTITY: $newQty
SOURCE: {$row['source']}
LOCATION: {$row['location']}
DATE RECEIVED: {$row['date_received']}";

mysqli_query($conn,"INSERT INTO merchandise_history(merch_id,action,old_details,new_details)
VALUES($id,'ADD QTY','$old_details','$new_details')");

echo "success";
?>