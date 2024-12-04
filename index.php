<?php
// Include database connection
include 'includes/db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Hotel - Home</title>
    <!-- Link to CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="container">
            <a href="index.php">Home</a>
            <a href="pages/services.php">Services</a>
            <a href="booking.php">Book a Room</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-overlay">
            <h1>Top Hotel in Baguio for Your Next Vacation</h1>
            <p>Experience unparalleled comfort and elegance.</p>
            <blockquote>"Travel not to escape life, but for life not to escape you."</blockquote>
            <form class="search-bar">
 
                <div class="form-group">
                    <label for="checkin">Check In</label>
                    <input type="date" id="checkin" value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="form-group">
                    <label for="checkout">Check Out</label>
                    <input type="date" id="checkout" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                </div>
                <button type="submit">Search</button>
            </form>
            <a href="booking.php" class="manage-link">Manage Reservations</a>
        </div>
    </section>

    <!-- Informational Section -->
    <section class="info-section">
        <h2>Explore Baguio. Travel and Stay with Us.</h2>
        <p>
            Discover the wonders of Baguio with top Luxury Hotels, your gateway to unforgettable travel experiences.
            Relax in sophistication or the joy of family-friendly stays. Soak up the sun at a beachfront resort or sip cocktails poolside with friends.
            Dive into the clear waters of the Caribbean, or savor the world's cuisines at top foodie destinations. 
            Whatever your adventure, Luxury Hotels has you covered.
        </p>
    </section>

    <!-- Room Categories -->
    <div class="container">
        <h2>Our Rooms</h2>
        <?php
        // Fetch available rooms
        $sql = "SELECT * FROM rooms WHERE status = 'available'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='room'>";
                echo "<img src='images/" . $row['image'] . "' alt='Room Image'>";
                echo "<div class='room-details'>";
                echo "<h3>" . $row['room_type'] . "</h3>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p><strong>Price: $" . $row['price'] . "/night</strong></p>";
                echo "<h4>Amenities:</h4>";
                echo "<ul>";
                echo "<li>Free WiFi</li>";
                echo "<li>24/7 Room Service</li>";
                echo "<li>Flat-Screen TV</li>";
                echo "<li>Air Conditioning</li>";
                echo "<li>Luxury Bedding</li>";
                echo "</ul>";
                echo "<a href='booking.php?room_id=" . $row['room_id'] . "' class='button'>Book Now</a>";

                // Fetch reviews for the room
                $sql_reviews = "SELECT * FROM reviews WHERE room_id = " . $row['room_id'];
                $reviews = $conn->query($sql_reviews);

                if ($reviews->num_rows > 0) {
                    echo "<div class='reviews'>";
                    echo "<h4>Reviews:</h4>";
                    while ($review = $reviews->fetch_assoc()) {
                        echo "<div class='review'>";
                        echo "<p><strong>Rating:</strong> " . $review['rating'] . "/5</p>";
                        echo "<p>" . $review['comment'] . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>No reviews yet.</p>";
                }

                echo "</div>"; // Close room details div
                echo "</div>"; // Close room div
            }
        } else {
            echo "<p>No available rooms at the moment.</p>";
        }
        ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Luxury Hotel. All Rights Reserved.</p>
    </footer>
</body>
</html>
