<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "hotel");

    $email = $_POST['email'];
    $password_input = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM staff_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $staff = $result->fetch_assoc();

        if (password_verify($password_input, $staff['password'])) {
            $_SESSION['staff_id'] = $staff['id'];
            $_SESSION['username'] = $staff['username'];
            $_SESSION['department'] = $staff['department'];

            // Redirect to department page
            switch ($staff['department']) {
                case 'Housekeeping':
                    header("Location: housekeeping_requests.php");
                    break;
                case 'Maintenance':
                    header("Location: maintenance_requests.php");
                    break;
                case 'Manager':
                    header("Location: view_service_requests.php");
                    break;
                case 'Kitchen':
                    header("Location: update-food-orders.php");
                    break;
            }
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "No staff found with that email.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Login</title>
    
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>
<body>
    
    <form method="POST">
        <h2>Staff Login</h2>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
