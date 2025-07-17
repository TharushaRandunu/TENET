<?php
session_start();

if (!isset($_SESSION['full_name']) || !isset($_SESSION['passport_no'])) {
    header("Location: login.html");
    exit();
}

$passport_no = $_SESSION['passport_no'];
$full_name = $_SESSION['full_name'];

// Greeting logic
$hour = date('H');
$greeting = ($hour >= 5 && $hour < 12) ? "Good Morning" :
            (($hour >= 12 && $hour < 17) ? "Good Afternoon" :
            (($hour >= 17 && $hour < 21) ? "Good Evening" : "Good Night"));

// DB connection
$conn = new mysqli("localhost", "root", "", "hotel");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get food orders
$food_stmt = $conn->prepare("SELECT category, item_name, quantity, room_no, request_time, job_status FROM room_service_orders WHERE passport_no = ? ORDER BY request_time DESC");
$food_stmt->bind_param("s", $passport_no);
$food_stmt->execute();
$food_orders = $food_stmt->get_result();

// Get service requests
$service_stmt = $conn->prepare("SELECT service_type, details, requested_at, job_status FROM service_requests WHERE passport_no = ? ORDER BY requested_at DESC");
$service_stmt->bind_param("s", $passport_no);
$service_stmt->execute();
$service_requests = $service_stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hotel Management System - Home</title>
    <link rel="stylesheet" href="styles2.css" />
    
    <style>
      table {
    border-collapse: collapse;
    width: 100%;
    margin-top: 20px;
    color: white;
    font-weight: bold;
    backdrop-filter: blur(10px); /* Blurs background */
    background-color: rgba(255, 255, 255, 0.1); /* Transparent white */
    border-radius: 10px;
}
table th, table td {
    padding: 10px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    text-align: left;
    background-color: rgba(255, 255, 255, 0.05); /* Optional: light blur layer inside cells */
}
table th {
    background-color: rgba(75, 0, 130, 0.6); /* Indigo with transparency */
    color: white;
}


    </style>
</head>
<body>
<header>
    <nav class="nav">
        <h1>Hotel Tenet Waskaduwa</h1>
        <ul class="nav-links">
            <li><a href="orderMenu.php">Order</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="how-to-use.html">How to Use</a></li>
            <li><a href="contact.html">Contact Numbers</a></li>
            <li><a href="gallery.html">Gallery</a></li>
            <li><a href="maintenance_requests.php">About Us</a></li>
            <li><a href="facilities.html">Our Facilities</a></li>
            <li><a href="OrderFood.html">Order Food</a></li>
            <li><a href="request-service.html">Request a Service</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="welcome-section">
        <h1><?php echo "$greeting, " . htmlspecialchars($full_name); ?>!</h1>
        <p>Your comfort is our priority. Book, request services, and explore all that we offer.</p>

        
        <h2>Your Food Orders</h2>
        <?php if ($food_orders->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Category</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Room No</th>
                    <th>Requested At</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = $food_orders->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['category']); ?></td>
                        <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($row['room_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['request_time']); ?></td>
                         <td>
                            <?php
                            $status = $row['job_status'];
                            if ($status === 'Completed') {
                                echo "<span style='color:green;'>$status</span>";
                            } elseif ($status === 'In Progress') {
                                echo "<span style='color:orange;'>$status</span>";
                            } else {
                                echo "<span style='color:red;'>$status</span>";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>You have not placed any food or drink orders yet.</p>
        <?php endif; ?>

       
        <h2> Your Service Requests</h2>
        <?php if ($service_requests->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Service Type</th>
                    <th>Details</th>
                    <th>Requested At</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = $service_requests->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['service_type']); ?></td>
                        <td><?php echo htmlspecialchars($row['details']); ?></td>
                        <td><?php echo htmlspecialchars($row['requested_at']); ?></td>
                        <td>
                            <?php
                            $status = $row['job_status'];
                            if ($status === 'Completed') {
                                echo "<span style='color:green;'>$status</span>";
                            } elseif ($status === 'In Progress') {
                                echo "<span style='color:orange;'>$status</span>";
                            } else {
                                echo "<span style='color:red;'>$status</span>";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>You have not made any service requests yet.</p>
        <?php endif; ?>
    </section>
    <div class="section-row">
      <div class="section-box">
        <h2>Luxury Rooms</h2>
        <p>Spacious, air-conditioned rooms with ocean views and private balconies.</p>
      </div>
      <div class="section-box">
        <h2>Infinity Pool</h2>
        <p>Relax in our crystal-clear pool overlooking the beach.</p>
      </div>
      <div class="section-box">
        <h2>Spa & Wellness</h2>
        <p>Enjoy massages and wellness treatments in a serene environment.</p>
      </div>
    </div>

    <!-- Hotel Details Section -->
    <div class="section-row">
      <div class="section-box">
        <h2>Location</h2>
        <p>Located in Waskaduwa, just steps from the Indian Ocean.</p>
      </div>
      <div class="section-box">
        <h2>Dining</h2>
        <p>Fine dining with local and international cuisine.</p>
      </div>
      <div class="section-box">
        <h2>Events & Weddings</h2>
        <p>Host memorable events with our beachfront venue and banquet hall.</p>
      </div>
    </div>
    <section class="discover">
  <h2 class="discover-title">Discover Teneyt Waskaduwa</h2>
  <div class="discover-cards">
    <div class="discover-card">
      <img src="image1.jpg" alt="Hotel Exterior">
      <h3>Stunning Beachfront</h3>
      <p>Wake up to the sound of waves and breathtaking sunrises. Our hotel sits directly on the golden sands of Waskaduwa.</p>
    </div>
    <div class="discover-card">
      <img src="image2.jpg" alt="Luxury Rooms">
      <h3>Modern Luxury Rooms</h3>
      <p>Enjoy elegantly designed rooms with modern amenities, plush bedding, and private balconies overlooking the ocean.</p>
    </div>
    <div class="discover-card">
      <img src="image3.jpg" alt="Dining Experience">
      <h3>Exceptional Dining</h3>
      <p>Our chefs bring you an exquisite mix of local and international cuisine using the freshest ingredients daily.</p>
    </div>
  </div>
</section>


    <!-- Footer -->
    <footer>
      <p>&copy; 2025 Teneyt Waskaduwa Hotel. All rights reserved.</p>
      <h3>Contact Us</h3>
      <p><strong>Address&nbsp;:</strong> 123 Beach Road, Waskaduwa, Sri Lanka</p>
      <p><strong>Phone&nbsp;:</strong> +94 34 222 1234</p>
      <p><strong>Email&nbsp;:</strong> <a href="management@teneytwaskaduwa.lk">
        reservations@teneytwaskaduwa.lk</a></p>
         <h3>Follow Us</h3>
      <p>
        <a href="#">Facebook</a> &nbsp;|&nbsp;
        <a href="#">Instagram</a> &nbsp;|&nbsp;
        <a href="#">Tripadvisor</a>
      </p>
    </footer>
  </div>
</main>
</body>
</html>
