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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passport_no = strtolower(trim($_POST['passport_no']));
    $password_input = $_POST['password'] ?? '';

    $sql = "SELECT * FROM foreign_guests WHERE TRIM(LOWER(passport_no)) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $passport_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password_input, $user['password'])) {
            // Set session variables
            $_SESSION['passport_no'] = $user['passport_no'];
            $_SESSION['full_name'] = $user['full_name'];

            // Redirect to home page
            header("Location: homePage.php");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "User not found. Please check your passport number.";
    }

    $stmt->close();
    $conn->close();
}
?>
