<?php
include "connection.php";

$province = $_GET['province'] ?? '';
$location = $_GET['location'] ?? '';

$sql = "SELECT DISTINCT type_accounts 
        FROM riraf_records 
        WHERE province = ? AND post_office = ?
        ORDER BY type_accounts ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $province, $location);
$stmt->execute();

$result = $stmt->get_result();

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>