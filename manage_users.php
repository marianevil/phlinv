<?php
session_start();
include "db/connection.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$query = "SELECT * FROM users ORDER BY last_login DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "admin_header.php"; ?>

<main class="dashboard-bg">

<h2 class="manage-title">Manage Users</h2>
 
<div class="manage-container">
    

<table class="manage-table">
<thead>
<tr>
    <th>Username</th>
    <th>Date Access</th>
    <th>Time</th>
    <th>Action</th>
</tr>
</thead>
<tbody>

<?php while ($row = mysqli_fetch_assoc($result)) : ?>
<tr>
    <td><?= $row['username']; ?></td>

    <td>
        <?= $row['last_login'] ? date("Y-m-d", strtotime($row['last_login'])) : "-"; ?>
    </td>

    <td>
        <?= $row['last_login'] ? date("h:i A", strtotime($row['last_login'])) : "-"; ?>
    </td>

    <td>
        <a href="edit_user.php?id=<?= $row['id']; ?>" class="edit-btn">
            Edit
        </a>

        <a href="db/delete_user.php?id=<?= $row['id']; ?>"
            onclick="return confirm('Delete this user?');"
            class="delete-btn">
            Delete
        </a>
    </td>
</tr>
<?php endwhile; ?>

</tbody>
</table>

</div>
</main>

</body>
</html>