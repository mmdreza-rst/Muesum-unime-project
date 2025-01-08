<?php
require('DBconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Get the current date for the booking
    $booking_date = date('Y-m-d'); // Format: YYYY-MM-DD
    
   

    // Modify the SQL query to include the booking date
    $sql = "INSERT INTO book_reservation (name, email, phone, message, booking_date) 
            VALUES ('$name', '$email', '$phone',  '$message', '$booking_date')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
            alert('Successfully booked in Reza Museum!');
            window.location.href='bookings.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
