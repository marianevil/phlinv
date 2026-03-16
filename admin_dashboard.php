<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include 'admin_header.php'; ?>

<main class="content dashboard-bg">
    <div class="center-text">
        <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
    </div>
</main>

</body>
</html>