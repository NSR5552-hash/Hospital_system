<?php
include("dbconnect.php");
$r = mysqli_query($conn,"SELECT * FROM doctors");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Doctors</title>
</head>
<body>
    <div class="container">
        <?php
        while($row=mysqli_fetch_assoc($r)){
            echo "<p>{$row["name"]} - {$row["specialty"]}</p>";
        }
        ?>
    </div>
</body>
</html>
