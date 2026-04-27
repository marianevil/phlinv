<?php
include 'connection.php';

$province = $_GET['province'] ?? '';

$stmt = $conn->prepare("SELECT name FROM riraf_postoffice WHERE province=? ORDER BY name ASC");
$stmt->bind_param("s",$province);
$stmt->execute();

$result = $stmt->get_result();

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>