<?php
include 'includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_id = $_POST['room_id'];
    $user_id = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO reviews (room_id, user_id, rating, comment, created_at) 
            VALUES ('$room_id', '$user_id', '$rating', '$comment', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Thank you for your review!</p>";
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
    <title>Add Review</title>
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
        <h2>Leave a Review</h2>
        <form method="POST">
            <input type="hidden" name="room_id" value="<?php echo $_GET['room_id']; ?>">
            <label>Rating (1-5):</label>
            <input type="number" name="rating" min="1" max="5" required><br>
            <label>Comment:</label>
            <textarea name="comment" rows="5" required></textarea><br>
            <button type="submit">Submit Review</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Luxury Hotel. All Rights Reserved.</p>
    </footer>
</body>
</html>
