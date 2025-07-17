<?php
session_start();

$category = $_GET['category'] ?? '';

$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";

// Connect to DB
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch items in the selected category
$sql = "SELECT name, description, price FROM food_menu WHERE category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($category); ?> Menu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="order-item.php" method="POST" class="order-form">
        <h2><?php echo htmlspecialchars($category); ?> Menu</h2>
        <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">

        <label for="room_no">Room Number:</label>
        <input type="text" name="room_no" required>

        <label for="item_name">Select Item:</label>
        <select name="item_name" required>
            <?php foreach ($items as $item): ?>
                <option value="<?php echo htmlspecialchars($item['name']); ?>">
                    <?php echo htmlspecialchars($item['name']) . " - LKR " . number_format($item['price'], 2); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Quantity:</label>
        <input type="number" name="quantity" value="1" min="1">

        <input type="submit" value="Send to Room">
    </form>
</body>
</html>
