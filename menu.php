<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM food_menu ORDER BY category, name";
$result = $conn->query($sql);

$menu = [];
while ($row = $result->fetch_assoc()) {
    $menu[$row['category']][] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Menu</title>
    <link rel="stylesheet" href="stylesMenu.css">
</head>
<body>
<div class="menu-wrapper">
    <h2>🍽 Hotel Menu</h2>

    <?php foreach ($menu as $category => $items): ?>
        <h3><?php echo htmlspecialchars($category); ?></h3>
        <table class="menu-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Price (LKR)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['description']); ?></td>
                        <td><?php echo number_format($item['price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</div>
</body>
</html>
