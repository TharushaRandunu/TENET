<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";
$conn = new mysqli($host, $username, $password, $database);

$today = $_GET['date'] ?? date('Y-m-d');
$service_type = 'Maintenance';

// Handle job status update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_status'])) {
    $request_id = $_POST['request_id'];
    $new_status = $_POST['job_status'];

    $update = $conn->prepare("UPDATE service_requests SET job_status = ? WHERE id = ?");
    $update->bind_param("si", $new_status, $request_id);
    $update->execute();
}

$sql = "SELECT * FROM service_requests 
        WHERE service_type = ? AND DATE(requested_at) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $service_type, $today);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Requests</title>
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
    <h2> Maintenance Requests</h2>

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
                <th>Details</th>
                <th>Requested At</th>
                <th>Status</th>
                <th>Update Job Status</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['passport_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['room_no']); ?></td>
                    <td><?php echo htmlspecialchars($row['details']); ?></td>
                    <td><?php echo htmlspecialchars($row['requested_at']); ?></td>
                    <td><?php echo htmlspecialchars($row['job_status']); ?></td>
                    <td>
                        <form method="POST" style="display:flex; gap:5px;">
                            <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
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
            <tr><td colspan="6">No maintenance requests found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
