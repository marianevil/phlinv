<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include 'connection.php';

$type = $_GET['type'] ?? '';
$start = intval($_GET['start'] ?? 0);
$limit = intval($_GET['limit'] ?? 5);

function fetchData($conn, $table, $start, $limit){
    $sql = "SELECT * FROM $table ORDER BY id DESC LIMIT $start, $limit";
    $res = mysqli_query($conn, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($res)){
        $data[] = $row;
    }
    return $data;
}

if ($type === 'entry') {
    $data = fetchData($conn, 'riraf_entry', $start, $limit);
} else {
    $tableMap = [
        'province' => 'riraf_province',
        'postoffice' => 'riraf_postoffice',
        'denomination' => 'riraf_denomination',
        'stamp' => 'riraf_stamp',
        'item' => 'riraf_item'
    ];
    if (!isset($tableMap[$type])) { echo json_encode([]); exit; }
    $data = fetchData($conn, $tableMap[$type], $start, $limit);
}

echo json_encode($data);
?>