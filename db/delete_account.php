<?php
include 'connection.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $account = trim($_POST['account']);

    if(empty($account)){
        echo "Account name required";
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM type_of_accounts WHERE name = ?");
    $stmt->bind_param("s", $account);

    if($stmt->execute()){
        echo "success";
    } else {
        echo "Database error: ".$conn->error;
    }
} else {
    echo "Invalid request";
}