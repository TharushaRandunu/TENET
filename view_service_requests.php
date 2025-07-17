<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Default to today's date unless user selected a specific date
$search_date = $_GET['date'] ?? date('Y-m-d');

$sql = "SELECT passport_no, room_no, service_type, details, requested_at 
        FROM service_requests 
        WHERE DATE(requested_at) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $search_date);
$stmt->execute();
$result = $stmt->get_result();

$requests = [];
while ($row = $result->fetch_assoc()) {
    $requests[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Service Requests</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="request-viewer">
        <h2>Service Requests</h2>

        <form method="GET" class="search-form">
            <label for="date">Search by Date:</label>
            <input type="date" name="date" value="<?php echo htmlspecialchars($search_date); ?>">
            <input type="submit" value="Search">
        </form>

        <h3>Results for: <?php echo htmlspecialchars($search_date); ?></h3>

        <?php if (count($requests) > 0): ?>
            <table class="request-table">
                <thead>
                    <tr>
                        <th>Passport No</th>
                        <th>Room No</th>
                        <th>Service Type</th>
                        <th>Details</th>
                        <th>Requested At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $req): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($req['passport_no']); ?></td>
                            <td><?php echo htmlspecialchars($req['room_no']); ?></td>
                            <td><?php echo htmlspecialchars($req['service_type']); ?></td>
                            <td><?php echo htmlspecialchars($req['details']); ?></td>
                            <td><?php echo htmlspecialchars($req['requested_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No service requests found for this date.</p>
        <?php endif; ?>
    </div>
</body>
</html>
