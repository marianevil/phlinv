<?php
session_start();
session_destroy(); // terminate session
header("Location: login.php"); // redirect to login page
exit();
?>
