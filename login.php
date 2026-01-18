<?php
session_start();
include("dbconnect.php");
if (isset($_POST["login"])) {
    $u = $_POST["username"];
    $p = $_POST["password"];
    $q = mysqli_query($conn,
        "SELECT * FROM users WHERE username='$u' AND password='$p'");
    if (mysqli_num_rows($q) == 1) {
        $_SESSION["user"] = $u;
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <input name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <button name="login">Login</button>
        </form>
        <p>admin / admin</p>
    </div>
</body>
</html>
