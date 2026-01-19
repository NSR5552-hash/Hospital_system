<?php
session_start();
include("dbconnect.php");

$error = "";
if (isset($_POST["login"])) {
    $u = $_POST["username"];
    $p = $_POST["password"];
    $q = mysqli_query($conn,
        "SELECT * FROM users WHERE username='$u' AND password='$p'");
    if (mysqli_num_rows($q) == 1) {
        $_SESSION["user"] = $u;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MFCC - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
    </div>

    <!-- Login Box -->
    <div class="login-box">
        <h2>Login</h2>
        <?php if($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" class="input-box" placeholder="Username" required>
            <input type="password" name="password" class="input-box" placeholder="Password" required>
            <button type="submit" name="login" class="btn">Login</button>
        </form>
        <p class="note">Default: admin / admin123</p>
    </div>
</body>
</html>

