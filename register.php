<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (full_name, email, phone_number, password, role, created_at) 
            VALUES ('$full_name', '$email', '$phone_number', '$password', 'customer', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Registration successful! <a href='login.php'>Login here</a></p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav>
        <div class="container">
            <a href="index.php">Home</a>
            <a href="pages/services.php">Services</a>
            <a href="booking.php">Book a Room</a>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        </div>
    </nav>

    <div class="container">
        <h2>Register</h2>
        <form method="POST">
            <label>Full Name:</label>
            <input type="text" name="full_name" required><br>
            <label>Email:</label>
            <input type="email" name="email" required><br>
            <label>Phone Number:</label>
            <input type="text" name="phone_number" required><br>
            <label>Password:</label>
            <input type="password" name="password" required><br>
            <button type="submit">Register</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Luxury Hotel. All Rights Reserved.</p>
    </footer>
</body>
</html>
