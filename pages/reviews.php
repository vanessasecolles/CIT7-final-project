<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'];
    $user_id = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO reviews (room_id, user_id, rating, comment) 
            VALUES ('$room_id', '$user_id', '$rating', '$comment')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Thank you for your review!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}
?>

<form method="POST">
    <input type="hidden" name="room_id" value="<?php echo $_GET['room_id']; ?>">
    <label for="rating">Rating (1-5):</label>
    <input type="number" name="rating" min="1" max="5" required>
    <label for="comment">Comment:</label>
    <textarea name="comment" rows="5" required></textarea>
    <button type="submit">Submit Review</button>
</form>
