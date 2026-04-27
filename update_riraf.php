<?php
include 'db/connection.php';

$id = $_POST['id'];

$sql = "UPDATE riraf_records SET 
province='$province',
post_office='$post_office',
date='$date',
inv_no='$inv_no',
weight='$weight',
type_accounts='$type_accounts',
deno='$deno',
quantity='$quantity',
weighted='$weighted',
kind_stamp='$kind_stamp',
sheet='$sheet',
unit_cost='$unit_cost',
pieces='$pieces',
stamp_from='$stamp_from',
stamp_to='$stamp_to',
stamp_total='$stamp_total',
stamp_total_weighted='$stamp_total_weighted',
stamp_amount='$stamp_amount',
stamp_total_words='$stamp_total_words'
WHERE id='$id'";

// update query
$sql = "UPDATE riraf_records SET
province='$province',
post_office='$post_office',
date='$date',
inv_no='$inv_no',
weight='$weight',
type_accounts='$type_accounts',
deno='$deno',
quantity='$quantity',
weighted='$weighted',
kind_stamp='$kind_stamp',
sheet='$sheet',
unit_cost='$unit_cost',
pieces='$pieces',
stamp_from='$stamp_from',
stamp_to='$stamp_to',
stamp_total='$stamp_total',
stamp_total_weighted='$stamp_total_weighted',
stamp_amount='$stamp_amount',
stamp_total_words='$stamp_total_words'
WHERE id='$id'";

if($conn->query($sql)){
    header("Location: ../riraf.php");
    exit;
} else {
    echo "Error updating record: " . $conn->error;
}
?>