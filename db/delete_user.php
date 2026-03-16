<?php
session_start();
include "connection.php";

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ../manage_users.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>
        alert('User successfully deleted');
        window.location.href = '../manage_users.php';
    </script>";
    exit();
}

echo "<script>
    alert('Delete failed');
    window.history.back();
</script>";
exit();
?>