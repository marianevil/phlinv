<?php
session_start();
include 'connection.php';

$username = trim($_POST['username']);
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        // UPDATE LAST LOGIN
        $update = $conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $update->bind_param("i", $user['id']);
        $update->execute();

        // SESSION
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: ../admin_dashboard.php");
        } else {
            header("Location: ../index.php");
        }
        exit();
    }
}

echo "<script>alert('Invalid login'); window.history.back();</script>";
exit();
?>