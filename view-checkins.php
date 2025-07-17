<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";

$conn = new mysqli($host, $username, $password, $database);

// Get filters from URL
$from_date = $_GET['from_date'] ?? '';
$to_date = $_GET['to_date'] ?? '';

$query = "SELECT passport_no, full_name, room_no, checkin_time, checkout_time FROM checkins";
$params = [];

if ($from_date && $to_date) {
    $query .= " WHERE DATE(checkin_time) BETWEEN ? AND ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $from_date, $to_date);
} elseif ($from_date) {
    $query .= " WHERE DATE(checkin_time) = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $from_date);
} else {
    $stmt = $conn->prepare($query);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Guest Check-Ins</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="request-viewer">
        <h2>Guest Check-In / Check-Out Records</h2>

        <form method="GET" class="search-form">
            <label>From:</label>
            <input type="date" name="from_date" value="<?php echo htmlspecialchars($from_date); ?>">
            <label>To:</label>
            <input type="date" name="to_date" value="<?php echo htmlspecialchars($to_date); ?>">
            <input type="submit" value="Filter">
            <a href="view-checkins.php" style="margin-left:10px;">Reset</a>
        </form>

        <table class="request-table">
            <thead>
                <tr>
                    <th>Passport No</th>
                    <th>Full Name</th>
                    <th>Room No</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['passport_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['room_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['checkin_time']); ?></td>
                            <td><?php echo $row['checkout_time'] ? htmlspecialchars($row['checkout_time']) : '-'; ?></td>
                            <td>
                                <?php echo $row['checkout_time'] ? "<span style='color:red;'>Checked Out</span>" : "<span style='color:green;'>Checked In</span>"; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="6">No check-in records found for this filter.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
