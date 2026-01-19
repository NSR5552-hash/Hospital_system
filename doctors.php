<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
include("dbconnect.php");
$r = mysqli_query($conn,"SELECT * FROM doctors");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Doctors</title>
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
        <h2>Doctors</h2>
        <table>
            <tr>
                <th>Doctor Name</th>
                <th>Specialty</th>
                <th>Status</th>
            </tr>
            <?php
            while($row=mysqli_fetch_assoc($r)){
                // Check if doctor has appointments today
                $today = date('Y-m-d');
                $check = mysqli_query($conn, 
                    "SELECT COUNT(*) as count FROM appointments 
                     WHERE doctor_id={$row['doctor_id']} AND appointment_date='$today'");
                $status_data = mysqli_fetch_assoc($check);
                $status = $status_data['count'] > 0 ? "Busy" : "Available";
                $status_color = $status == "Busy" ? "#f8d7da" : "#d4edda";
                
                echo "<tr>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['specialty']}</td>";
                echo "<td style='background: $status_color; font-weight: bold;'>$status</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
