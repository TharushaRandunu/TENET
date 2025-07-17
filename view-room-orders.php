<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";

// Connect to database
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use today's date by default
$search_date = $_GET['date'] ?? date('Y-m-d');

$sql = "SELECT passport_no, room_no, category, item_name, quantity, request_time 
        FROM room_service_orders 
        WHERE DATE(request_time) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $search_date);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Room Service Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="request-viewer">
        <h2>Room Service Orders</h2>

        <form method="GET" class="search-form">
            <label for="date">Search by Date:</label>
            <input type="date" name="date" value="<?php echo htmlspecialchars($search_date); ?>">
            <input type="submit" value="Search">
        </form>

        <h3>Orders for: <?php echo htmlspecialchars($search_date); ?></h3>

        <?php if (count($orders) > 0): ?>
            <table class="request-table">
                <thead>
                    <tr>
                        <th>Passport No</th>
                        <th>Room No</th>
                        <th>Category</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Ordered At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['passport_no']); ?></td>
                            <td><?php echo htmlspecialchars($order['room_no']); ?></td>
                            <td><?php echo htmlspecialchars($order['category']); ?></td>
                            <td><?php echo htmlspecialchars($order['item_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($order['request_time']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No room service orders found for this date.</p>
        <?php endif; ?>
    </div>
</body>
</html>
