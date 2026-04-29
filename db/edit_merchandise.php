<?php
include "connection.php";

$id = $_POST['id'];

$old = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM merchandise WHERE id=$id"));

$name = $_POST['name'];
$qty = $_POST['qty'];
$source = $_POST['source'];
$location = $_POST['location'];
$date = $_POST['date'];

mysqli_query($conn,"UPDATE merchandise SET
name='$name',
qty='$qty',
source='$source',
location='$location',
date_received='$date'
WHERE id=$id");

$old_details =
"MERCHANDISE: {$old['name']}
QUANTITY: {$old['qty']}
SOURCE: {$old['source']}
LOCATION: {$old['location']}
DATE RECEIVED: {$old['date_received']}";

$new_details =
"MERCHANDISE: $name
QUANTITY: $qty
SOURCE: $source
LOCATION: $location
DATE RECEIVED: $date";

mysqli_query($conn,"INSERT INTO merchandise_history(merch_id,action,old_details,new_details)
VALUES($id,'EDIT','$old_details','$new_details')");

echo "success";
?>