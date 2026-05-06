<?php
include 'connection.php';

$province = $_POST['province'];
$post_office = $_POST['post_office'];
$type_accounts = $_POST['type_accounts'];
$inv_no = $_POST['inv_no'];
$latest_date = $_POST['latest_date'];
$user = $_POST['user'];

$sql = "INSERT INTO stock_card 
(province, post_office, type_accounts, inv_no, latest_date, created_by)
VALUES 
('$province', '$post_office', '$type_accounts', '$inv_no', '$latest_date', '$user')";

if($conn->query($sql)){
    echo "success";
}else{
    echo "error";
}
?>