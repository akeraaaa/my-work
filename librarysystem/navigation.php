<?php
  session_start();
  include('server.php');
?>

<head>
  <link
      href="https://fonts.googleapis.com/css2?family=Roboto&family=Playfair+Display&family=Poppins&display=swap"
      rel="stylesheet"
    />
  <link rel="stylesheet" href="css/navigation.css" />
  <link rel="stylesheet" href="https://fontawesome.com/icons/user?f=classic&s=regular" />
</head>
<!-- navigation bar section -->
<div class="nav">
  <div class="nav-img">
    <a href="index.php"><img src="image/logo.png" alt="" /></a>
  </div>
  <div class="hamburger">
    <div></div>
    <div></div>
    <div></div>
  </div>
  <ul>
    <li><a id="nav-element" href="index.php">Home</a></li>
    <li><a id="nav-element" href="about.php">About Us</a></li>
    <li><a id="nav-element" href="explore.php">Explore</a></li>
    <li><a id="nav-element" href="#contact">Contact Us</a></li>

    <?php if(!isset($_SESSION['user_name'])):?>

    <!-- if user is not logged in, show login button -->
     <li><a id="login" href="login.php">Login</a></li>
      
    
  </ul>
  <!-- if user is logged in, show user detail -->
    <?php else: ?>
      <!-- <button id="notification"> <i class="fa-solid fa-bell"> </i></button> -->
      <button id="user"> <i class="fa-regular fa-user"></i> </button>
    <?php endif; ?>
</div>

<!-- notification icon section -->
<div class="notification">
  <h2>Notification</h2>
  <ul>
    <li>Book request has been submited</li>
    <li>Book request has been submited</li>
    <li>Book request has been submited</li>
  </ul>
</div>
<!-- end of notification icon section -->

<!-- if user click user icon -->
<div class="user-detail">
  <h2><?php echo $_SESSION['user_name']?></h2>
  <p><?php echo $_SESSION['user_email']?></p>
    <div class="detail">
      <ul>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="detail.php">My Detail</a></li>
        <li><a href="payment.php">Pay Due Amount</a></li>
        <li><a href="changePassword.php">Change Password</a></li>
      </ul>
      <button id="logout" onclick="window.location.href='logout.php';">Logout&#129058;</button>
   </div>
</div>


<script src="js/navigation.js"></script>

<!-- End of navigation section -->
