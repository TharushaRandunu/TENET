<?php
session_start();
$passport_no = $_SESSION['passport_no'] ?? '';
$room_no = $_POST['room_no'] ?? '';
$category = $_POST['category'] ?? '';
$item_name = $_POST['item_name'] ?? '';
$quantity = $_POST['quantity'] ?? 1;

$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO room_service_orders (passport_no, room_no, category, item_name, quantity)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $passport_no, $room_no, $category, $item_name, $quantity);

if ($stmt->execute()) {
    echo "<h3>Order Sent to Room $room_no!</h3>";
    echo "<a href='menu.php'>Back to Menu</a>";
} else {
    echo "Failed to send order: " . $stmt->error;
}

$stmt->close();
$conn->close();
