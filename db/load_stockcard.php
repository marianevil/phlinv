<?php
include "connection.php";

header('Content-Type: application/json');

$province = $_GET['province'] ?? '';
$location = $_GET['location'] ?? '';
$type = $_GET['type'] ?? '';

$sql = "
SELECT 
    type_accounts,
    post_office,
    province,
    COUNT(*) AS total_records,
    MAX(date) AS latest_date
FROM riraf_records
WHERE province = ?
AND post_office = ?
AND type_accounts = ?
GROUP BY type_accounts, post_office, province
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $province, $location, $type);
$stmt->execute();

$result = $stmt->get_result();

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
exit;
?>