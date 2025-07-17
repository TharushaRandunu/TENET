<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";

$conn = new mysqli($host, $username, $password, $database);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passport_no = $_POST['passport_no'];
    $full_name = $_POST['full_name'];
    $room_no = $_POST['room_no'];

    $sql = "INSERT INTO checkins (passport_no, full_name, room_no) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $passport_no, $full_name, $room_no);
    $stmt->execute();

    echo "Guest checked in successfully!";
    $stmt->close();
}
?>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<form method="POST">
    <h2>Guest Check-In</h2>
    Passport No: <input type="text" name="passport_no" required><br><br>
    Full Name: <input type="text" name="full_name" required><br><br>
    Room No: <input type="text" name="room_no" required><br><br>
    <input type="submit" value="Check In">
</form>
