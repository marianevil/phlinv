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

/* ===================== ENTRY ===================== */
if ($type === 'entry') {

    $province   = clean($conn, $_POST['province'] ?? '');
    $postOffice = clean($conn, $_POST['postOffice'] ?? '');
    $zip        = clean($conn, $_POST['zip'] ?? '');
    $deno       = clean($conn, $_POST['deno'] ?? '');
    $stamp      = clean($conn, $_POST['stamp'] ?? '');
    $item       = clean($conn, $_POST['item'] ?? '');

    if (!$province || !$postOffice || !$zip || !$deno || !$stamp || !$item) {
        echo "All fields are required!";
        exit;
    }

    $sql = "INSERT INTO riraf_entry 
            (province, post_office, zip, deno, stamp, item) 
            VALUES 
            ('$province','$postOffice','$zip','$deno','$stamp','$item')";
}

/* ===================== POST OFFICE (WITH ZIP) ===================== */
else if ($type === 'postoffice') {

    $name = clean($conn, $_POST['name'] ?? '');
    $zip  = clean($conn, $_POST['zip'] ?? '');

    if (!$name || !$zip) {
        echo "Post Office and Zip Code required!";
        exit;
    }

    $sql = "INSERT INTO riraf_postoffice (name, zip) VALUES ('$name','$zip')";
}

/* ===================== OTHER TYPES ===================== */
else {

    $value = clean($conn, $_POST['value'] ?? '');

    if (!$value) {
        echo "Value required!";
        exit;
    }

    $tableMap = [
        'province' => 'riraf_province',
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

/* ===================== EXECUTE ===================== */
if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>