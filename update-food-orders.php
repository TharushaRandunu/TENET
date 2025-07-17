<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";
$conn = new mysqli($host, $username, $password, $database);

$today = $_GET['date'] ?? date('Y-m-d');

// Handle job status update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['job_status'];

    $update = $conn->prepare("UPDATE room_service_orders SET job_status = ? WHERE id = ?");
    $update->bind_param("si", $new_status, $order_id);
    $update->execute();
}

// Fetch today's food orders
$sql = "SELECT * FROM room_service_orders WHERE DATE(request_time) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $today);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Food Order Status Update</title>
    <link rel="stylesheet" href="stylesService.css">
    <style>
        .request-viewer {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
            background: #fff;
        }
        .request-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .request-table th, .request-table td {
            border: 1px solid #ccc;
            padding: 10px;
        }
        .request-table th {
            background-color: #4B0082;
            color: white;
        }
    </style>
</head>
<body>
<div class="request-viewer">
    <h2>Food Order Status - <?php echo htmlspecialchars($today); ?></h2>

    <form method="GET" class="search-form">
        <label>Search Date:</label>
        <input type="date" name="date" value="<?php echo htmlspecialchars($today); ?>">
        <input type="submit" value="Search">
    </form>

    <table class="request-table">
        <thead>
            <tr>
                <th>Passport No</th>
                <th>Room No</th>
                <th>Category</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Requested At</th>
                <th>Status</th>
                <th>Update Status</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['passport_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['room_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                    <td><?php echo htmlspecialchars($row['request_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['job_status']); ?></td>
                    <td>
                        <form method="POST" style="display:flex; gap:5px;">
                            <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                            <select name="job_status">
                                <option value="Pending" <?php if($row['job_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                <option value="In Progress" <?php if($row['job_status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                                <option value="Completed" <?php if($row['job_status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                            </select>
                            <button type="submit" name="update_status">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="8">No food orders found for this date.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
