<?php
include 'connection.php'; // make sure path is correct

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $account = trim($_POST['account']);

    if(empty($account)){
        echo "Account name is required";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO type_of_accounts (name) VALUES (?)");
        $stmt->bind_param("s", $account);

        if($stmt->execute()){
            echo "success";
        } else {
            if($conn->errno === 1062){
                echo "Account already exists";
            } else {
                echo "Database error: ".$conn->error;
            }
        }
    } else {
        echo "Invalid request";
    }