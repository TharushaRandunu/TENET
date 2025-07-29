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
    $passport_no = $_POST['passport_no'] ?? '';
    $room_no = $_POST['room_no'] ?? '';
    $service_type = $_POST['service_type'] ?? '';
    $details = $_POST['details'] ?? '';

    $sql = "INSERT INTO service_requests (passport_no, room_no, service_type, details)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssss", $passport_no, $room_no, $service_type, $details);

        if ($stmt->execute()) {
            // ✅ Redirect back to form with success status
            header("Location: request-service.html?status=success");
            exit();
        } else {
            // ❌ Redirect back to form with error status
            header("Location: request-service.html?status=error");
            exit();
        }

        $stmt->close();
    } else {
        // ❌ If prepare fails
        header("Location: request-service.html?status=error");
        exit();
    }

    $conn->close();
}
?>
