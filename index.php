<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<?php include 'header.php'; ?>

<main class="content dashboard-bg">
    <h1>Welcome to your Dashboard!</h1>
</main>

</body>
</html>
