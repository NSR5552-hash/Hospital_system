<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
include("dbconnect.php");
$r = mysqli_query($conn,"SELECT COUNT(*) AS total FROM appointments");
$d = mysqli_fetch_assoc($r);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="appointments.php">Appointments</a>
        <a href="doctors.php">Doctors</a>
        <a href="appointments_list.php">List</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="container">
        <h1>Hospital System</h1>
        <p>Total Appointments: <?php echo $d["total"]; ?></p>
    </div>
</body>
</html>
