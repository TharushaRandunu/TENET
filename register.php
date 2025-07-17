<?php
function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
    return substr(str_shuffle($chars), 0, $length);
}

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "hotel";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $passport_no = $_POST['passport_no'] ?? null;
    $full_name   = $_POST['full_name'] ?? null;
    $email       = $_POST['email'] ?? null;
    $country     = $_POST['country'] ?? null;
    $phone       = $_POST['phone'] ?? null;

    if (!$passport_no || !$full_name || !$email || !$country) {
        die("Please fill all required fields.");
    }

    $generatedPassword = generatePassword();
    $hashedPassword = password_hash($generatedPassword, PASSWORD_DEFAULT);

    $sql = "INSERT INTO foreign_guests (passport_no, full_name, email, country, phone, password)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $passport_no, $full_name, $email, $country, $phone, $hashedPassword);

    if ($stmt->execute()) {
        echo "Registration successful!<br>";
        echo "Your generated password is: <strong>$generatedPassword</strong><br>";
        echo "<a href='login.html'>Click here to Login</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
