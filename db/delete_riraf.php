<?php
if (session_status() === PHP_SESSION_NONE) session_start();
include 'connection.php';

$type = $_POST['type'] ?? '';
$ids = json_decode($_POST['ids'] ?? '[]', true);

if (!$type || empty($ids)) { echo "Invalid request"; exit; }

if ($type === 'entry') { $table = 'riraf_entry'; }
else {
    $tableMap = [
        'province' => 'riraf_province',
        'postoffice' => 'riraf_postoffice',
        'denomination' => 'riraf_denomination',
        'stamp' => 'riraf_stamp',
        'item' => 'riraf_item'
    ];
    if (!isset($tableMap[$type])) { echo "Invalid type"; exit; }
    $table = $tableMap[$type];
}

$idList = implode(',', array_map('intval', $ids));
$sql = "DELETE FROM $table WHERE id IN ($idList)";
if (mysqli_query($conn, $sql)) { echo "Deleted successfully"; }
else { echo "Error: " . mysqli_error($conn); }
?>