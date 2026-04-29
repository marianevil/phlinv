<?php
include "connection.php";

$name = $_POST['name'];
$qty = $_POST['qty'];
$source = $_POST['source'];
$location = $_POST['location'];
$date = $_POST['date'];

mysqli_query($conn,"INSERT INTO merchandise(name,qty,source,location,date_received)
VALUES('$name','$qty','$source','$location','$date')");

$last_id = mysqli_insert_id($conn);

mysqli_query($conn,"INSERT INTO merchandise_history(merch_id,action,old_details,new_details)
VALUES(
$last_id,
'ADD',
'NONE',
'Qty: $qty | Source: $source | Location: $location | Date: $date'
)");

echo "success";
?>