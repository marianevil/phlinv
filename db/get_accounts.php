<?php
include 'connection.php';

$result = $conn->query("SELECT name FROM type_of_accounts ORDER BY id ASC");
$accounts = [];
while($row = $result->fetch_assoc()){
    $accounts[] = $row;
}
echo json_encode($accounts);