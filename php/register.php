<?php
require('DBconnection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Reza Museum</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>

    <header>
        <h1>Reza Museum Registration</h1>
        <nav>
        <a href="index.html">Home</a>

        </nav>
    </header>

    <section class="form-container">
        <form action="process_register.php" method="post">
            <h2>Create Your Account</h2>

            <p>Please fill in the following information to register.</p>

            <div class="form-section">
                <h3>Personal Information</h3>

                <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Enter your first name" required />
                </div>

                <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" required />
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required />
                </div>
            </div>

            <div class="form-section">
                <h3>Contact Information</h3>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email address" required />
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" placeholder="Enter your full address" rows="5" required></textarea>
                </div>
            </div>

            <div class="form-section">
                <h3>Account Security</h3>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a secure password" required />
                </div>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn">Register Now</button>
            </div>

            <p>By registering, you agree to our Terms and Conditions<.</p>
        </form>
    </section>



</body>
</html>

