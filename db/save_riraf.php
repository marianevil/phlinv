<?php
session_start();
include 'connection.php';
if(!isset($_SESSION['user'])){
    die("User not logged in");
}

$created_by = $_SESSION['user'];

// get POST values safely
$province      = $conn->real_escape_string($_POST['province'] ?? '');
$post_office   = $conn->real_escape_string($_POST['post_office'] ?? '');
$date          = $_POST['date'] ?? date("Y-m-d");
$inv_no        = $conn->real_escape_string($_POST['inv_no'] ?? '');
$weight        = $conn->real_escape_string($_POST['weight'] ?? '');
$type_accounts = $conn->real_escape_string($_POST['type_accounts'] ?? '');

$deno = $_POST['deno'] ?? '';
$quantity = $_POST['quantity'] ?? '';
$weighted = $_POST['weighted'] ?? '';
$kind_stamp = $_POST['kind_stamp'] ?? '';
$sheet = $_POST['sheet'] ?? '';
$unit_cost = $_POST['unit_cost'] ?? '';
$pieces = $_POST['pieces'] ?? '';

$stamp_from = $_POST['stamp_from'] ?? '';
$stamp_to = $_POST['stamp_to'] ?? '';
$stamp_total = $_POST['stamp_total'] ?? '';
$stamp_total_weighted = $_POST['stamp_total_weighted'] ?? '';
$stamp_amount = $_POST['stamp_amount'] ?? '';
$stamp_total_words = $_POST['stamp_total_words'] ?? '';

$items = $_POST['items'] ?? '';
$total_weighted_cost = $_POST['total_weighted_cost'] ?? '';
$quantity_pads = $_POST['quantity_pads'] ?? '';
$total_cost = $_POST['total_cost'] ?? '';

$receipt_from = $_POST['receipt_from'] ?? '';
$receipt_to = $_POST['receipt_to'] ?? '';
$receipt_total = $_POST['receipt_total'] ?? '';
$receipt_total_cost = $_POST['receipt_total_cost'] ?? '';

$mo_quantity = $_POST['mo_quantity'] ?? '';
$mo_weighted = $_POST['mo_weighted'] ?? '';
$mo_from = $_POST['mo_from'] ?? '';
$mo_to = $_POST['mo_to'] ?? '';
$mo_total = $_POST['mo_total'] ?? '';
$mo_amount = $_POST['mo_amount'] ?? '';

// create prefix based on type of accounts
$prefix = strtoupper(str_replace(" ", "_", $type_accounts));

// count existing records for that type
$query = $conn->query("SELECT COUNT(*) AS total FROM riraf_records WHERE type_accounts='$type_accounts'");
$row = $query->fetch_assoc();
$next = $row['total'] + 1;

// filename format example: POSTAGE_001
$filename = $prefix . "-" . $inv_no;

// insert into database
$sql = "INSERT INTO riraf_records
(filename, province, post_office, date, inv_no, weight, type_accounts,
deno, quantity, weighted, kind_stamp, sheet, unit_cost, pieces,
stamp_from, stamp_to, stamp_total, stamp_total_weighted, stamp_amount, stamp_total_words,
created_by)
VALUES
('$filename','$province','$post_office','$date','$inv_no','$weight','$type_accounts',
'$deno','$quantity','$weighted','$kind_stamp','$sheet','$unit_cost','$pieces',
'$stamp_from','$stamp_to','$stamp_total','$stamp_total_weighted','$stamp_amount','$stamp_total_words',
'$created_by')";

if($conn->query($sql)){
    header("Location: ../riraf.php");
    exit();
} else {
    echo "Error saving RIRAF record: " . $conn->error;
}
?>