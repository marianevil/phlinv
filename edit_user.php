<?php
session_start();
include "db/connection.php";

if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit();
}

$id = intval($_GET['id']);
$query = "SELECT * FROM users WHERE id=$id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    header("Location: manage_users.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "admin_header.php"; ?>

<main class="dashboard-bg">

<div class="edit-container">
    <h2>Edit User</h2>

<form action="db/update_user.php" method="POST">
    <input type="hidden" name="id" value="<?= $user['id']; ?>">

    <label>Username:</label>
    <input type="text" name="username" value="<?= $user['username']; ?>" required>

    <label>Role:</label>
    <input type="text" value="<?= ucfirst($user['role']); ?>" readonly>
    <input type="hidden" name="role" value="<?= $user['role']; ?>">

    <label class="password-label">New Password (Optional):</label>
    <input type="password" name="password" placeholder="Leave blank if no change">
    <br><br>

    <button type="submit" class="save-btn">Update</button>
    <a href="manage_users.php" class="cancel-btn">Cancel</a>
</form>
</div>

</main>

</body>
</html>