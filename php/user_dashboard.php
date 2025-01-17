<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


require('DBconnection.php');



// Fetch user-specific data if needed
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Welcome to Museum</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Bootstrap CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">

   <!-- Google Fonts Link -->
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&family=Oswald:wght@300;400;500&family=Playfair+Display&display=swap" rel="stylesheet">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">
   <script src="https://kit.fontawesome.com/0e905df789.js" crossorigin="anonymous"></script>

   <style>
      html {
         scroll-behavior: smooth;
      }

      section {
         padding-top: 60px;
         margin-top: -60px;
      }

      .header {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         background-color: #1F3A59;
         z-index: 1000;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }
   </style>
</head>
<body>

<!-- Header Section -->
<header class="header fixed-top">
   <div class="container">
      <div class="row align-items-center justify-content-between">
         <a href="#home" class="logo">Museum</a>
         <nav class="nav">
            <a href="#home">Home</a>
            <a href=bookings.php>bookings</a>
            <a href="#about">About</a>
            <a href="#Our_features">Our Features</a>
            <a href="#attraction">Attractions</a>
            <a href="logout.php">Logout</a>
         </nav>
         <a href="#reserve" class="link-btn">Make Reservation</a>
      </div>
   </div>
</header>

<!-- Home Section -->
<section class="home" id="home">
   <div class="container">
      <div class="row min-vh-100 align-items-center">
         <div class="content text-center text-md-left">
            <h3>Discover the Grand and Glorious!</h3>
            <p>Step into a realm of marvels where size and splendor come alive. From colossal monuments to exquisite artifacts, explore history's grandest creations and uncover stories as vast as the treasures themselves.</p>
         </div>
      </div>
   </div>
</section>

<!-- About Section -->
<section class="about" id="about">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-md-6 image">
            <img src="images/1.jpg" class="w-100" alt="About Image">
         </div>
         <div class="col-md-6 content">
            <span>About Us</span>
            <h3>Museum Reza</h3>
            <p>We are dedicated to showcasing the world’s most awe-inspiring wonders. From monumental achievements to exquisite artifacts, we celebrate human creativity and history. Our mission is to inspire, educate, and immerse visitors in the grandeur of past masterpieces.</p>
         </div>
      </div>
   </div>
</section>

<!-- Features Section -->
<section class="Our_features" id="Our_features">
   <h1 class="heading">Our Features</h1>
   <div class="circle-container">
      <div class="circle">
         <i class="fa-solid fa-scroll"></i>
         <h3>Extensive Collections</h3>
         <p>Explore a wide range of artifacts, from ancient relics to modern masterpieces.</p>
      </div>
      <div class="circle">
         <i class="fa-solid fa-desktop"></i>
         <h3>Interactive Exhibits</h3>
         <p>Engage with history through touchscreens, virtual tours, and hands-on displays.</p>
      </div>
      <div class="circle">
         <i class="fa-solid fa-person-chalkboard"></i>
         <h3>Guided Tours</h3>
         <p>Learn fascinating stories behind the exhibits with our expert guides.</p>
      </div>
      <div class="circle">
         <i class="fa-solid fa-book-open"></i>
         <h3>Educational Workshops</h3>
         <p>Participate in classes and activities for all ages.</p>
      </div>
      <div class="circle">
         <i class="fa-solid fa-mug-hot"></i>
         <h3>Café & Gift Shop</h3>
         <p>Relax with a coffee or find unique souvenirs inspired by our collection.</p>
      </div>
      <div class="circle">
         <i class="fa-solid fa-calendar"></i>
         <h3>Event Spaces</h3>
         <p>Host memorable events in our stunning historical venue.</p>
      </div>
   </div>
</section>

<!-- Process Section -->
<section class="process">
   <div class="steps-container">
      <div class="step">
         <i class="fa-solid fa-user-plus"></i>
         <h3>Get Ready</h3>
         <p>Prepare for an unforgettable experience with your group!</p>
      </div>
      <div class="step">
         <i class="fa-solid fa-globe"></i>
         <h3>Visit Our Website</h3>
         <p>Browse exhibits and pick the one that sparks your interest the most.</p>
      </div>
      <div class="step">
         <i class="fa-solid fa-calendar-check"></i>
         <h3>Make a Reservation</h3>
         <p>Book your spot online and choose your preferred time and date.</p>
      </div>
      <div class="step">
         <i class="fa-solid fa-door-open"></i>
         <h3>Grab Your Stuff & Come</h3>
         <p>Pack your excitement, grab your friends, and enjoy the adventure!</p>
      </div>
   </div>
</section>

<!-- Attraction Section -->
<section class="attraction" id="attraction">
   <h1 class="heading">Attractions</h1>
   <div class="attractions-container">
      <div class="attraction">
         <i class="fa-solid fa-monument"></i>
         <h3>Ancient Artifacts</h3>
         <p>Step into the world of history and explore artifacts from ancient civilizations.</p>
      </div>
      <div class="attraction">
         <i class="fa-solid fa-palette"></i>
         <h3>Masterpiece Exhibits</h3>
         <p>Admire the finest works of art, from classical paintings to modern masterpieces.</p>
      </div>
      <div class="attraction">
         <i class="fa-solid fa-robot"></i>
         <h3>Innovative Technology</h3>
         <p>Experience cutting-edge technology with VR and interactive exhibits.</p>
      </div>
   </div>
</section>

<!-- Reservation Section -->
<section class="reserve" id="reserve">
   <div class="row">
      <form action="book_reservation.php" method="POST">
         <h3 class="heading">Make Reservation</h3>
         <input type="text" name="name" placeholder="Your Name" class="box" required>
         <input type="number" name="phone" placeholder="Your Phone Number" class="box" required>
         <input type="email" name="email" placeholder="Your Email" class="box" required>
         <input type="date" name="reservation_date" class="box" required>
         <textarea name="message" placeholder="Message (Optional)" class="box"></textarea>
         <input type="submit" value="Reserve Now" class="btn">
      </form>
   </div>
</section>


<!-- Footer Section -->
<section class="footer">
   <div class="box-container container">
      <div class="box">
         <i class="fas fa-phone"></i>
         <h3>Phone Number</h3>
         <p>+39-5461-45345</p>
         <p>+39-4537-43745</p>
      </div>
      <div class="box">
         <i class="fas fa-map-marker-alt"></i>
         <h3>Our Address</h3>
         <p>Italy, Messina - Via Scilla</p>
      </div>
      <div class="box">
         <i class="fas fa-clock"></i>
         <h3>Opening Hours</h3>
         <p>8:00am to 8:00pm</p>
      </div>
      <div class="box">
         <i class="fas fa-envelope"></i>
         <h3>Email Address</h3>
         <p>rezamuseum.reza@gmail.com</p>
      </div>
   </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>
