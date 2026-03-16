<?php
session_start();
if(isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>PHLPost Login</title>

<link href="https://fonts.googleapis.com/css2?family=Antic&family=Junge&display=swap" rel="stylesheet">

<link rel="stylesheet" href="style.css">

</head>

<body class="login-page">

<!-- HEADER -->
<div class="login-header">

    <img src="images/phlpost_logo.png" class="login-logo">

    <a href="login_form.php" class="login-btn">LOGIN</a>

</div>

<!-- CENTER DESIGN -->
<div class="login-center">

    <div class="login-banner">

        <h1>
            <span class="gold">PHILATELIC &</span><br>
            <span class="blue">STAMPS UNIT</span><br>
            <span class="office">OFFICE</span>
        </h1>

    </div>

</div>

</body>
</html>