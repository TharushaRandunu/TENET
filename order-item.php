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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Status</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
if ($stmt->execute()) {
    echo "
    <script>
        Swal.fire({
            icon: 'success',
            title: '✅ Order Sent!',
            text: 'Room $room_no has received the order.',
            confirmButtonText: 'Back to Menu'
        }).then(() => {
            window.location.href = 'menu.php';
        });
    </script>";
} else {
    $error = addslashes($stmt->error);
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: '❌ Order Failed',
            text: '$error',
            confirmButtonText: 'Try Again'
        }).then(() => {
            window.location.href = 'menu.php';
        });
    </script>";
}

$stmt->close();
$conn->close();
?>
</body>
</html>
