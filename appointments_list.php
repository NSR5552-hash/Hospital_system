<?php
include("dbconnect.php");
$r = mysqli_query($conn,"
    SELECT patient_name,appointment_date,appointment_time,doctors.name
    FROM appointments JOIN doctors ON doctors.doctor_id=appointments.doctor_id
");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>List</title>
</head>
<body>
    <div class="container">
        <?php
        while($row=mysqli_fetch_assoc($r)){
            echo "<p>{$row["patient_name"]} - {$row["name"]}</p>";
        }
        ?>
    </div>
</body>
</html>
