<?php
session_start();  

require('DBconnection.php');

// Check if the session variable for the user's email is set
if (!isset($_SESSION['email'])) {
    echo "You must log in to view this page.";
    exit();  

$email = $_SESSION['email'];

// Handle Delete Booking Request
if (isset($_GET['delete_booking_id'])) {
    $booking_id = $_GET['delete_booking_id'];
    $delete_query = "DELETE FROM book_reservation WHERE id = $booking_id AND email = '$email'";
    if (mysqli_query($conn, $delete_query)) {
        header('Location: bookings.php');  
        exit();
    } else {
        echo "Error deleting booking: " . mysqli_error($conn);
    }
}

// Handle Edit Booking Request
if (isset($_GET['edit_booking_id'])) {
    $booking_id = $_GET['edit_booking_id'];
    $query = "SELECT * FROM book_reservation WHERE id = $booking_id AND email = '$email'";
    $result = mysqli_query($conn, $query);
    $booking = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
       

        $update_query = "UPDATE book_reservation SET 
                         name='$name', 
                         phone='$phone', 
                        
                         WHERE id = $booking_id AND email = '$email'";
                         
        if (mysqli_query($conn, $update_query)) {
            header('Location: bookings.php');
            exit();
        } else {
            echo "Error updating booking: " . mysqli_error($conn);
        }
    }
}


$sql = "SELECT * FROM book_reservation WHERE email='$email'";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bookings</title>
    <link rel="stylesheet" href="css/bookings.css">
</head>
<body>
    <header>
        <h1>Reza Museum - Bookings</h1>
        <nav>
            <a href="bookings.php">Bookings</a>
            <a href="user_dashboard.php">Home</a>
        </nav>
    </header>

    <h1>Your booking information is here</h1>

    <div class="booking-list">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='booking-item'>
                        <div><strong>Name:</strong> {$row['name']}</div>
                        <div><strong>Email:</strong> {$row['email']}</div>
                        <div><strong>Phone:</strong> {$row['phone']}</div>
                       
                        <div><strong>Booking Date:</strong> {$row['booking_date']}</div>
                        <div class='actions'>
                            <a href='bookings.php?edit_booking_id={$row['id']}#edit-section' class='btn'>Edit</a>
                            <a href='bookings.php?delete_booking_id={$row['id']}' class='btn delete-btn'>Delete</a>
                        </div>
                    </div>";
            }
        } else {
            echo "<div class='booking-item'>No bookings found</div>";
        }
        ?>
    </div>

    <?php if (isset($_GET['edit_booking_id'])): ?>
    <section id="edit-section">
        <h2>Edit Booking</h2>
        <form action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $booking['name']; ?>" required>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?php echo $booking['phone']; ?>" required>

           

            <button type="submit" class="btn">Update</button>
        </form>
    </section>
    <?php endif; ?>

    <script src="js/script.js"></script>
</body>
</html>
