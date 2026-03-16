<?php
include 'connection.php';

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    echo "<script>
        alert('Please fill up the form');
        window.history.back();
    </script>";
    exit();
}

$username = trim($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $password);

if ($stmt->execute()) {
    echo "<script>
        alert('Account created successfully!');
        window.location.href = '../login_form.php';
    </script>";
    exit();
}

echo "<script>
    alert('Signup failed. Username might already exist.');
    window.history.back();
</script>";
exit();
?>