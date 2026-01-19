<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
include("dbconnect.php");

$message = "";
if (isset($_POST["submit"])) {
    $patient = $_POST["patient"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $doctor = $_POST["doctor"];
    
    // Check for duplicate appointment
    $check = mysqli_query($conn, 
        "SELECT * FROM appointments WHERE appointment_date='$date' AND appointment_time='$time' AND doctor_id='$doctor'");
    
    if (mysqli_num_rows($check) > 0) {
        $message = "This appointment slot is already booked!";
    } else {
        mysqli_query($conn,
            "INSERT INTO appointments (patient_name,appointment_date,appointment_time,doctor_id)
            VALUES ('$patient','$date','$time','$doctor')");
        $message = "Appointment Added Successfully!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Appointments</title>
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
        <h2>Appointment Booking</h2>
        
        <?php if($message): ?>
            <p style="text-align: center; padding: 10px; background: <?php echo strpos($message, 'Success') !== false ? '#d4edda' : '#f8d7da'; ?>; border-radius: 5px;">
                <?php echo $message; ?>
            </p>
        <?php endif; ?>
        
        <form method="POST" onsubmit="return validateForm()">
            <input type="text" name="patient" id="patient" placeholder="Enter Patient Name" required>
            <input type="date" name="date" id="date" required>
            <input type="time" name="time" id="time" required>
            <select name="doctor" id="doctor" required>
                <option value="">Select Doctor</option>
                <?php
                $d = mysqli_query($conn,"SELECT * FROM doctors");
                while($row=mysqli_fetch_assoc($d)){
                    echo "<option value='{$row["doctor_id"]}'>{$row["name"]} - {$row["specialty"]}</option>";
                }
                ?>
            </select>
            <button type="submit" name="submit">Book Appointment</button>
        </form>
        
        <h3>Recent Appointments</h3>
        <div id="listView">
            <?php
            $recent = mysqli_query($conn, "SELECT a.*, d.name as doctor_name FROM appointments a 
                                           JOIN doctors d ON a.doctor_id = d.doctor_id 
                                           ORDER BY a.appointment_date DESC, a.appointment_time DESC LIMIT 5");
            while($app = mysqli_fetch_assoc($recent)) {
                echo "<p><b>{$app['patient_name']}</b> — {$app['appointment_date']} — {$app['appointment_time']} — Dr. {$app['doctor_name']}</p>";
            }
            ?>
        </div>
    </div>
    
    <script>
    function validateForm() {
        let patient = document.getElementById("patient").value;
        let date = document.getElementById("date").value;
        let time = document.getElementById("time").value;
        let doctor = document.getElementById("doctor").value;
        
        if(patient == "" || date == "" || time == "" || doctor == "") {
            alert("Please fill all fields!");
            return false;
        }
        
        return true;
    }
    </script>
</body>
</html>
