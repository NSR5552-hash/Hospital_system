<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
include("dbconnect.php");
$r = mysqli_query($conn,"
    SELECT patient_name,appointment_date,appointment_time,doctors.name
    FROM appointments JOIN doctors ON doctors.doctor_id=appointments.doctor_id
    ORDER BY appointment_date DESC, appointment_time DESC
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Appointments List</title>
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
        <h2>Appointments List</h2>
        <table>
            <tr>
                <th>Patient</th>
                <th>Date</th>
                <th>Time</th>
                <th>Doctor</th>
            </tr>
            <?php
            if(mysqli_num_rows($r) > 0) {
                while($row=mysqli_fetch_assoc($r)){
                    echo "<tr>";
                    echo "<td>{$row['patient_name']}</td>";
                    echo "<td>{$row['appointment_date']}</td>";
                    echo "<td>{$row['appointment_time']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align: center;'>No appointments found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
