<?php
session_start();
include("dbconnect.php");
if (isset($_POST["submit"])) {
    mysqli_query($conn,
        "INSERT INTO appointments (patient_name,appointment_date,appointment_time,doctor_id)
        VALUES ('{$_POST["patient"]}','{$_POST["date"]}','{$_POST["time"]}','{$_POST["doctor"]}')");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Appointments</title>
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="appointments.php">Appointments</a>
    </nav>
    <div class="container">
        <form method="POST">
            <input name="patient" placeholder="Patient Name">
            <input type="date" name="date">
            <input type="time" name="time">
            <select name="doctor">
                <?php
                $d = mysqli_query($conn,"SELECT * FROM doctors");
                while($row=mysqli_fetch_assoc($d)){
                    echo "<option value='{$row["doctor_id"]}'>{$row["name"]}</option>";
                }
                ?>
            </select>
            <button name="submit">Book</button>
        </form>
    </div>
</body>
</html>
