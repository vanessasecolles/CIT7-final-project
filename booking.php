<?php
include 'includes/db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotel - Booking</title>
    <!-- Link to the external CSS file -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <a href="index.php">Home</a>
        <a href="pages/services.php">Services</a>
        <a href="booking.php">Book a Room</a>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    </nav>

    <!-- Booking Form -->
    <div class="container">
        <h2>Book Your Stay</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $room_id = $_POST['room_id'];
            $user_id = $_SESSION['user_id'];
            $check_in_date = $_POST['check_in_date'];
            $check_out_date = $_POST['check_out_date'];
            $guests = $_POST['guests'];

            // Calculate total price
            $sql = "SELECT price FROM rooms WHERE room_id = $room_id";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $price_per_night = $row['price'];
            $total_price = $price_per_night * ((strtotime($check_out_date) - strtotime($check_in_date)) / (60 * 60 * 24));

            // Insert booking into database
            $sql = "INSERT INTO bookings (user_id, room_id, check_in_date, check_out_date, guests, total_price, status, created_at) 
                    VALUES ('$user_id', '$room_id', '$check_in_date', '$check_out_date', '$guests', '$total_price', 'pending', NOW())";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Booking successful!</p>";
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        } else {
            $room_id = $_GET['room_id'];
            echo "<form method='POST'>";
            echo "<input type='hidden' name='room_id' value='$room_id'>";
            echo "<label>Check-In Date:</label><input type='date' name='check_in_date' required><br>";
            echo "<label>Check-Out Date:</label><input type='date' name='check_out_date' required><br>";
            echo "<label>Number of Guests:</label><input type='number' name='guests' required><br>";
            echo "<button type='submit'>Confirm Booking</button>";
            echo "</form>";
        }
        ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Luxury Hotel. All Rights Reserved.</p>
    </footer>
</body>
</html>
