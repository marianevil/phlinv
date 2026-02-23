
<!DOCTYPE html>
<html>
<head>
    
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body class="login-page">

    <div class="login-header">
        <img src="images/phlpost_logo.png" class="login-logo">
        <a href="login_form.php" class="login-btn">LOGIN</a>
    </div>

<div class="form-container">
    <form action="process_login.php" method="POST" class="login-form">
        <h2>LOGIN</h2>


        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required>
            <img src="images/user.png" alt="user icon" class="input-icon">
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
            <img src="images/lock.png" alt="lock icon" class="input-icon">
        </div>

        <button type="submit">LOGIN</button>
    </form>
</div>

</body>
</html>
