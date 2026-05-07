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

<style>
/* CONTRIBUTORS TEXT */
.credit-box{
    position: fixed;
    left: 70px;
    top: 420px;
    bottom: 20px;
    text-align: left;
    color: black;
    font-size: 12px;
    line-height: 1.0;
    font-family: Arial, sans-serif;
}
</style>

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
            <span class="office">SECTION</span>
        </h1>

    </div>

</div>

<!-- CONTRIBUTORS -->
<div class="credit-box">
    <strong>System Developers</strong><br><br>

    Mariane Jane C. Villasan<br>
    <small>Front End / Back End Developer</small><br><br>

    Rommel John L. Alegarbes<br>
    <small>Back End / Database</small><br><br>

    Diana C. Gape<br>
    <small>UI/UX Design</small>
</div>

</body>
</html>