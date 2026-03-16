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
<header class="header">
    <div class="logo">
        <img src="images/phlpost_logo.png" class="logo-img" alt="Logo">
    </div>

    <nav class="nav">
        <span class="nav-hover"></span>

        <!-- INVENTORY DROPDOWN -->
        <div class="dropdown">  
            <button class="dropbtn dropdown-toggle">
                Inventory Category
                <svg class="arrow-icon" width="14" height="14" viewBox="0 0 24 24">
                    <path d="M6 9l6 6 6-6" fill="none" stroke="black" stroke-width="2"/>
                </svg>
            </button>
            <div class="dropdown-content">
                <a href="accountable_form.php">Accountable forms</a>
                <a href="riraf.php">Supplies</a>
                <a href="deno.php">Merchandise</a>
            </div>
        </div>

        <a href="stockcard.php">STOCK CARD</a>
        <a href="masterlistdata.php">MASTER LIST DATA</a>

        <!-- ADMIN DROPDOWN -->
        <div class="dropdown">
            <button class="dropbtn dropdown-toggle">
                <img src="images/admin_icon.png" class="admin-icon" alt="Admin Icon">
                <?php echo htmlspecialchars($username); ?>
                <svg class="arrow-icon" width="14" height="14" viewBox="0 0 24 24">
                    <path d="M6 9l6 6 6-6" fill="none" stroke="black" stroke-width="2"/>
                </svg>
            </button>
            <div class="dropdown-content">
                <a href="manage_users.php">Manage Users</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>

    </nav>
</header>

<!-- HOVER + DROPDOWN SCRIPT -->
<script>
const nav = document.querySelector('.nav');
const hover = document.querySelector('.nav-hover');

// HOVER SLIDE EFFECT
document.querySelectorAll('.nav a, .dropdown-toggle').forEach(item => {
    item.addEventListener('mouseenter', function() {
        const rect = this.getBoundingClientRect();
        const navRect = nav.getBoundingClientRect();

        hover.style.width = rect.width + 'px';
        hover.style.left = (rect.left - navRect.left) + 'px';
        hover.style.opacity = '1';
    });
});

// HIDE HOVER WHEN LEAVING NAV
nav.addEventListener('mouseleave', function() {
    hover.style.width = '0';
    hover.style.opacity = '0';
});

// CLICKABLE DROPDOWN TOGGLE
document.querySelectorAll('.dropdown-toggle').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        const dropdown = this.parentElement;
        const content = dropdown.querySelector('.dropdown-content');

        dropdown.classList.toggle('active');
        content.classList.toggle('show');
    });
});

// CLOSE DROPDOWN WHEN CLICKING OUTSIDE
window.addEventListener('click', function (e) {
    document.querySelectorAll('.dropdown').forEach(drop => {
        if (!drop.contains(e.target)) {
            drop.classList.remove('active');
            drop.querySelector('.dropdown-content').classList.remove('show');
        }
    });
});
</script>

</body>
</html>