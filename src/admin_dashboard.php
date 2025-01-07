<?php
session_start();
require('DBconnection.php');

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.html');
    exit();
}

if (isset($_GET['delete_user_id'])) {
    $user_id = $_GET['delete_user_id'];
    $query = "DELETE FROM users WHERE id = $user_id";
    mysqli_query($conn, $query);

    $appointment_query = "DELETE FROM book_reservation WHERE email = (SELECT email FROM users WHERE id = $user_id)";
    mysqli_query($conn, $appointment_query);

    header('Location: admin_dashboard.php#users');
    exit();
}

if (isset($_GET['delete_appointment_id'])) {
    $appointment_id = $_GET['delete_appointment_id'];
    $query = "DELETE FROM book_reservation WHERE id = $appointment_id";
    mysqli_query($conn, $query);

    header('Location: admin_dashboard.php#book_reservation');
    exit();
}

if (isset($_GET['edit_user_id'])) {
    $user_id = $_GET['edit_user_id'];
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstname = $_POST['firstname'];
       
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $update_query = "UPDATE users SET firstname='$firstname', lastname='$lastname', phone='$phone', address='$address' WHERE id = $user_id";
        if (mysqli_query($conn, $update_query)) {
            header('Location: admin_dashboard.php#users');
            exit();
        } else {
            echo "Error updating user: " . mysqli_error($conn);
        }
    }
}

if (isset($_GET['edit_appointment_id'])) {
    $appointment_id = $_GET['edit_appointment_id'];
    $query = "SELECT * FROM book_reservation WHERE id = $appointment_id";
    $result = mysqli_query($conn, $query);
    $appointment = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
       

        $update_query = "UPDATE book_reservation SET name='$name', phone='$phone' WHERE id = $appointment_id";
        if (mysqli_query($conn, $update_query)) {
            header('Location: admin_dashboard.php#book_reservation');
            exit();
        } else {
            echo "Error updating appointment: " . mysqli_error($conn);
        }
    }
}

// Query to fetch users
$user_query = "SELECT * FROM users";
$user_result = mysqli_query($conn, $user_query);

// Query to fetch book_reservation by joining on email
$appointment_query = "
    SELECT book_reservation.*, CONCAT(users.firstname, ' ', users.lastname) AS user_name 
    FROM book_reservation 
    LEFT JOIN users ON book_reservation.email = users.email";
$appointment_result = mysqli_query($conn, $appointment_query);

// Query to fetch login history
$login_query = "
    SELECT user_logins.*, CONCAT(users.firstname, ' ', users.lastname) AS user_name 
    FROM user_logins 
    LEFT JOIN users ON user_logins.user_id = users.id
    ORDER BY login_time DESC";
$login_result = mysqli_query($conn, $login_query);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Museum system</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>

<header>
    <h1> Reza Museum - Admin page</h1>
    <nav>
        <a href="#users">Users</a>
        <a href="#book_reservation">Booking</a>
        <a href="#logins"> History</a>
        
        <a href="logout.php" class="logout">out</a>
    </nav>
</header>

<section class="admin-dashboard" id="users">
    <h2>Users</h2>
    <div class="box-container">
        <?php while ($row = mysqli_fetch_assoc($user_result)): ?>
        <div class="box user-box">
            <h3><?php echo $row['firstname'] . ' '  . $row['lastname']; ?></h3>
            <p>Email: <?php echo $row['email']; ?></p>
            <p>Phone Number: <?php echo $row['phone']; ?></p>
            <p>Address: <?php echo $row['address']; ?></p>
            <a href="admin_dashboard.php?edit_user_id=<?php echo $row['id']; ?>#edit-section" class="btn">Edit</a>
            <a href="admin_dashboard.php?delete_user_id=<?php echo $row['id']; ?>" class="btn delete-btn">Delete</a>
        </div>
        <?php endwhile; ?>
    </div>
</section>

<section class="admin-dashboard" id="book_reservation">
    <h2>Booking</h2>
    <div class="box-container">
        <?php while ($row = mysqli_fetch_assoc($appointment_result)): ?>
        <div class="box appointment-box">
            <h3>Bookingt ID: <?php echo $row['id']; ?></h3>
            <p>Name: <?php echo $row['name']; ?></p>
            <p>Email: <?php echo $row['email']; ?></p>
            <p>Phone: <?php echo $row['phone']; ?></p>
            <p>Booking Date: <?php echo $row['booking_date']; ?></p>
     
            <p>User: <?php echo isset($row['user_name']) ? $row['user_name'] : 'Unknown'; ?></p>
            <a href="admin_dashboard.php?edit_appointment_id=<?php echo $row['id']; ?>#edit-section" class="btn">Edit</a>
            <a href="admin_dashboard.php?delete_appointment_id=<?php echo $row['id']; ?>" class="btn delete-btn">Cancel</a>
        </div>
        <?php endwhile; ?>
    </div>
</section>

<section class="admin-dashboard" id="logins">
    <h2>Login History</h2>
    <div class="box-container">
        <?php while ($row = mysqli_fetch_assoc($login_result)): ?>
        <div class="box login-box">
            <h3><?php echo $row['user_name']; ?></h3>
            <p>Login Time: <?php echo $row['login_time']; ?></p>
        </div>
        <?php endwhile; ?>
    </div>
</section>

<section  class="admin-dashboard" id="edit-section">
    <?php if (isset($_GET['edit_user_id'])): ?>
    <h2>Edit User</h2>
    <form action="" method="POST">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" value="<?php echo $user['firstname']; ?>" required>
        
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" value="<?php echo $user['lastname']; ?>" required>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" readonly>
        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $user['address']; ?>" required>
        <button type="submit" class="btn">Update</button>
    </form>
    <?php endif; ?>

    <?php if (isset($_GET['edit_appointment_id'])): ?>
    <h2>Edit Booking</h2>
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $appointment['name']; ?>" required>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $appointment['email']; ?>" readonly>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $appointment['phone']; ?>" required>
        <label for="appointment_date">Booking Date:</label>
        <input type="date" name="appointment_date" value="<?php echo $appointment['appointment_date']; ?>" required>
        <label for="appointment_time">Booking Time:</label>
        <input type="time" name="appointment_time" value="<?php echo $appointment['appointment_time']; ?>">
        <button type="submit" class="btn">Update</button>
    </form>
    <?php endif; ?>
</section>

<script src="js/script.js"></script>

</body>
</html>

