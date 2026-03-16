
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

    <div class="form-wrapper">

        <!-- LOGIN FORM -->
        <form class="login-form form-box active" id="loginForm" action="db/process_login.php" method="POST">
            <h2>LOGIN</h2>

            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit">LOGIN</button>

            <p class="switch-text">
                Don't have an account?
                <span id="showSignup">Sign Up</span>
            </p>
        </form>


        <!-- SIGN UP FORM -->
<form class="login-form form-box" id="signupForm" action="db/process_signup.php" method="POST">
    <h2>SIGN UP</h2>

    <div class="input-group">
        <input type="text" name="username" placeholder="Username" required>
    </div>

    <div class="input-group">
        <input type="password" name="password" placeholder="Password" required>
    </div>

    <button type="submit">REGISTER</button>

    <p class="switch-text">
        Already have an account?
        <span id="showLogin">Login</span>
    </p>
</form>

    </div>
</div>
<script>
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");

    document.getElementById("showSignup").onclick = function () {
        loginForm.classList.remove("active");
        signupForm.classList.add("active");
    };

    document.getElementById("showLogin").onclick = function () {
        signupForm.classList.remove("active");
        loginForm.classList.add("active");
    };
</script>
</body>
</html>
