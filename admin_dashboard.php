<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include 'admin_header.php'; ?>

<div class="dashboard-bg">
    <div class="center-text">
        <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
    </div>
</div>

</main>
</div> <!-- END layout -->


<!-- SCRIPT -->
<script>
const nav = document.querySelector('.nav');
const hover = document.querySelector('.nav-hover');

document.querySelectorAll('.nav a, .dropdown-toggle').forEach(item => {
    item.addEventListener('mouseenter', function() {
        const rect = this.getBoundingClientRect();
        const navRect = nav.getBoundingClientRect();

        hover.style.width = rect.width + 'px';
        hover.style.left = (rect.left - navRect.left) + 'px';
        hover.style.opacity = '1';
    });
});

nav.addEventListener('mouseleave', function() {
    hover.style.width = '0';
    hover.style.opacity = '0';
});

document.querySelectorAll('.dropdown-toggle').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        const dropdown = this.parentElement;
        const content = dropdown.querySelector('.dropdown-content');

        dropdown.classList.toggle('active');
        content.classList.toggle('show');
    });
});

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