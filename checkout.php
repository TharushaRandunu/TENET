<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";

$conn = new mysqli($host, $username, $password, $database);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passport_no = $_POST['passport_no'];

    $sql = "UPDATE checkins SET checkout_time = NOW() 
            WHERE passport_no = ? AND checkout_time IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $passport_no);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Guest checked out successfully!";
    } else {
        echo "No active check-in found for this passport.";
    }

    $stmt->close();
}
?>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<form method="POST">
    <h2>Guest Check-Out</h2>
    Passport No: <input type="text" name="passport_no" required><br><br>
    <input type="submit" value="Check Out">
</form>
