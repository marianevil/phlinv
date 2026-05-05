<?php
include "connection.php";

$province = $_GET['province'] ?? '';

$sql = "SELECT DISTINCT post_office 
        FROM riraf_records 
        WHERE province = ?
        ORDER BY post_office ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $province);
$stmt->execute();

$result = $stmt->get_result();

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>