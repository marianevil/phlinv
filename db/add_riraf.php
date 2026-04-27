<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'connection.php';

if (!isset($_POST['type'])) {
    echo "Invalid request";
    exit;
}

$type = trim($_POST['type']);

function clean($conn, $str){
    return $conn->real_escape_string(trim($str));
}

if ($type === 'entry') {

    $province   = clean($conn, $_POST['province'] ?? '');
    $postOffice = clean($conn, $_POST['postOffice'] ?? '');
    $deno       = clean($conn, $_POST['deno'] ?? '');
    $stamp      = clean($conn, $_POST['stamp'] ?? '');
    $item       = clean($conn, $_POST['item'] ?? '');

    if (!$province || !$postOffice || !$deno || !$stamp || !$item) {
        echo "All fields are required!";
        exit;
    }

    $sql = "INSERT INTO riraf_entry 
            (province, post_office, deno, stamp, item) 
            VALUES 
            ('$province','$postOffice','$deno','$stamp','$item')";

} 
else {

    $value = clean($conn, $_POST['value'] ?? '');

    if (!$value) {
        echo "Value required!";
        exit;
    }

    $tableMap = [
        'province' => 'riraf_province',
        'postoffice' => 'riraf_postoffice',
        'denomination' => 'riraf_denomination',
        'stamp' => 'riraf_stamp',
        'item' => 'riraf_item'
    ];

    if (!isset($tableMap[$type])) {
        echo "Invalid type";
        exit;
    }

    $table = $tableMap[$type];

    $sql = "INSERT INTO $table (name) VALUES ('$value')";
}

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>