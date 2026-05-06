<?php
include "connection.php";

$sql = "SELECT 
        date,
        filename,
        province,
        post_office,
        created_by
        FROM riraf_records
        ORDER BY date DESC";

$result = $conn->query($sql);

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>