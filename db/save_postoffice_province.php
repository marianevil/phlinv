<?php
include 'connection.php';

$id = $_POST['id'] ?? '';
$province = $_POST['province'] ?? '';

$sql = "UPDATE riraf_postoffice SET province=? WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $province, $id);

if($stmt->execute()){
    echo "success";
}else{
    echo "error";
}
?>