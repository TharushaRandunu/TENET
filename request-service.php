<?php
// Connect to DB
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passport_no = $_POST['passport_no'];
    $room_no = $_POST['room_no'];
    $service_type = $_POST['service_type'];
    $details = $_POST['details'];

    $sql = "INSERT INTO service_requests (passport_no, room_no, service_type, details)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $passport_no, $room_no, $service_type, $details);

    if ($stmt->execute()) {
        echo "<h2>Request Submitted Successfully!</h2>";
        echo "<p>Thank you. We’ll respond shortly.</p>";
        echo "<a href='homePage.php'>Back to Home</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
