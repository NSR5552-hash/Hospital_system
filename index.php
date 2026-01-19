<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
include("dbconnect.php");
$r = mysqli_query($conn,"SELECT COUNT(*) AS total FROM appointments");
$d = mysqli_fetch_assoc($r);
?>
<!DOCTYPE html>
<html>
<head>
    <title>MFCC - Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="appointments.php">Appointments</a>
        <a href="doctors.php">Doctors</a>
        <a href="appointments_list.php">Appointments List</a>
        <a href="about.php">About</a>
        <a href="logout.php">Logout</a>
    </div>
    
    <div class="container">
        <h1>MFCC Appointment System</h1>
        <h3>Welcome to our Appointment System</h3>
        
        <div class="container-box">
            <h1>MFCC ® Web Based IVF Software</h1>
            <p style="margin-top:10px;font-weight:600;">
                MFCC® v8 Practice Management System for IVF Healthcare Facilities is designed
                specifically to meet the needs of obstetricians, gynecologists, embryologists and nurses specializing
                in women's health and infertility, integrating every aspect of your practice from patient/cycle
                management, appointment scheduling, billing, reporting, and so on into a single, web-based
                platform. MFCC® provides everything from single to multi-chain clinics. Be ready to take control of
                your practice completely! No other IVF product has never been so comprehensive before!
                Access your clinic 24/7 from anywhere - anytime!
            </p>
            <p style="font-weight: bold; margin-top: 20px;">
                Maternal and Fetal Care Center<br>
                مركز العناية بالأم والجنين
            </p>
            <p style="margin-top: 20px; font-size: 18px; color: #2c6ed5;">
                <strong>Total Appointments: <?php echo $d["total"]; ?></strong>
            </p>
            <button class="btn btn-appoint" onclick="window.location.href='appointments.php'">ADD Appointment</button>
        </div>
    </div>
</body>
</html>
