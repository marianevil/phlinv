<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_page = basename($_SERVER['PHP_SELF']);
$username = isset($_SESSION['user']) ? $_SESSION['user'] : 'ADMIN';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Fondamento&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="images/phlpost_logo.png" alt="PHLPost" class="logo-img">
    </div>

    <nav class="nav">
        <span class="nav-hover"></span>
        <a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">HOME</a>
        <a href="create.php" class="<?= ($current_page == 'create.php') ? 'active' : '' ?>">CREATE</a>
        <a href="riraf.php" class="<?= ($current_page == 'riraf.php') ? 'active' : '' ?>">RIRAF</a>
        <a href="stockcard.php" class="<?= ($current_page == 'stockcard.php') ? 'active' : '' ?>">STOCK CARD</a>
        <a href="deno.php" class="<?= ($current_page == 'deno.php') ? 'active' : '' ?>">DENO</a>
        <a href="masterlistdata.php" class="<?= ($current_page == 'masterlistdata.php') ? 'active' : '' ?>">MASTER LIST DATA</a>

        <!-- Admin Dropdown (dynamic username) -->
        <div class="dropdown">
            <button class="dropbtn">
                <!-- LEFT ICON -->
                <svg class="admin-icon" width="16" height="16" viewBox="0 0 24 24">
                    <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-4 0-8 2-8 5v1h16v-1c0-3-4-5-8-5z"
                    fill="black"/>
                </svg>

                <!-- DYNAMIC USERNAME (no design change) -->
                <?php echo htmlspecialchars($username); ?>

                <!-- RIGHT ARROW -->
                <svg class="arrow-icon" width="14" height="14" viewBox="0 0 24 24">
                    <path d="M6 9l6 6 6-6" fill="none" stroke="black" stroke-width="2"/>
                </svg>
            </button>

            <div class="dropdown-content">
                <a href="logout.php">Logout</a>
            </div>
        </div>

    </nav>
</header>

<script>
const dropbtn = document.querySelector('.dropbtn');
const dropdown = document.querySelector('.dropdown');

dropbtn.addEventListener('click', function(e) {
    e.stopPropagation();
    dropdown.classList.toggle('active');
    dropdown.querySelector('.dropdown-content').classList.toggle('show');
});

document.addEventListener('click', function(e) {
    if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('active');
        dropdown.querySelector('.dropdown-content').classList.remove('show');
    }
});

const nav = document.querySelector('.nav');
const hoverSpan = document.querySelector('.nav-hover');
const navLinks = document.querySelectorAll('.nav a');

navLinks.forEach(link => {
    link.addEventListener('mouseenter', () => {
        const rect = link.getBoundingClientRect();
        const navRect = nav.getBoundingClientRect();

        hoverSpan.style.width = rect.width + "px";
        hoverSpan.style.left = (rect.left - navRect.left) + "px";
        hoverSpan.style.opacity = 1;
    });
});

nav.addEventListener('mouseleave', () => {
    hoverSpan.style.opacity = 0;
});
</script>

</body>
</html>