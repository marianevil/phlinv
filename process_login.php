<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

/* Sample account */
$valid_user = "admin";
$valid_pass = "12345";

if($username === $valid_user && $password === $valid_pass){
    $_SESSION['user'] = $username;
    header("Location: index.php");
} else {
    header("Location: login.php?error=1");
}
exit();
?>
