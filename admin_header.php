<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$username = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>

<body class="accountable-body">

<!-- HEADER (LOGO ONLY) -->
<header class="header">
    <div class="logo">
        <img src="images/phlpost_logo.png" class="logo-img" alt="Logo">
    </div>
</header>

<!-- LAYOUT -->
<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar collapsed">

        <!-- MENU -->
        <ul class="sidebar-menu">

            <li>
                <a href="#" onclick="toggleSidebar(); return false;">
                    <img src="images/sideBar.png" class="side-icon">
                    <span>MENU</span>
                </a>
            </li>
            <li>
                <a href="admin_dashboard.php">
                    <img src="images/dashboard.png" class="side-icon">
                    <span>DASHBOARD</span>
                </a>
            </li>

            <li>
                <a href="manage_users.php">
                    <img src="images/manageUser.png" class="side-icon">
                    <span>MANAGE USERS</span>
                </a>
            </li>

            <li>
                <a href="accountable_form.php">
                    <img src="images/account.png" class="side-icon">
                    <span>ACCOUNTABLE FORMS</span>  
                </a>
            </li>

            <li>
                <a href="masterlistdata.php">
                    <img src="images/masterlist.png" class="side-icon">
                    <span>MASTER LIST DATA</span>
                </a>
            </li>

        </ul>

        <!-- ADMIN SECTION (PINAKA UBOS) -->
        <div class="sidebar-admin">

            <div class="admin-info">
                <img src="images/admin_icon.png" class="admin-icon">
                <span><?php echo htmlspecialchars($username); ?></span>
            </div>

            <a href="logout.php" class="logout-btn">Logout</a>

        </div>

    </aside>

    <!-- MAIN CONTENT START -->
    <main class="main-content">
<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('collapsed');
}
</script>