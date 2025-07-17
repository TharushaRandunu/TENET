<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "hotel");

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $department = $_POST['department'];

    $stmt = $conn->prepare("INSERT INTO staff_users (username, email, password, department) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $department);

    if ($stmt->execute()) {
        echo "Staff registered successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Staff</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
    <form method="POST">
        <h2>Staff Registration</h2>
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Department:</label><br>
        <select name="department" required>
            <option value="Housekeeping">Housekeeping</option>
            <option value="Maintenance">Maintenance</option>
            <option value="Manager">Manager</option>Kitchen
            <option value="Kitchen">Kitchen</option>
        </select><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
