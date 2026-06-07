<?php
include('server.php');
?>

<!-- include navigation -->
 <?php
    include('navigation.php');

    // to count books total book borrowed
    $user_id = $_SESSION['user_id'];

    $query = "SELECT COUNT(*) AS total_books_borrowed FROM borrowtable WHERE u_id = $user_id";
    $result = $con->query($query);
    $row = $result->fetch_assoc();
    $total_books_borrowed = $row['total_books_borrowed'];
    
    // to count active borrowed books
    $query = "SELECT COUNT(*) AS total_active_books FROM borrowtable WHERE u_id = $user_id AND remarks = 'Active'";
    $result = $con->query($query);
    $row = $result->fetch_assoc();

    $total_active_books = $row['total_active_books'];

    // to count pending fines
    $query = "SELECT SUM(fine_amount) AS total_pending_fines FROM borrowtable WHERE u_id = $user_id AND remarks = 'Active'";
    $result = $con->query($query);
    $row = $result->fetch_assoc();
    $total_pending_fines = $row['total_pending_fines'];
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Library Management system</title>
    <!-- link for icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <!-- link for font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto&family=Playfair+Display&family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/profile.css" />
  </head>
  <body>
    <div class="profile-container">
      <!-- Header Section -->
      <header class="profile-header">
        <h1 class="profile-name"><?php echo $_SESSION['user_name']?></h1>
        <p class="profile-role">Student</p>
      </header>

      <!-- Account Details -->
      <section class="profile-info">
        <h2>Account Details</h2>
        <ul>
          <li><strong>User Name:</strong> <?php echo $_SESSION['user_name']?></li>
          <li><strong>Email:</strong> <?php echo $_SESSION['user_email']?></li>
        </ul>
      </section>

      <!-- Activity Overview -->
      <section class="activity-overview">
        <h2>Activity Overview</h2>
        <div class="activity-stats">
          <div class="stat">
            <h3><?php echo $total_books_borrowed; ?></h3>
            <p>Books Borrowed</p>
          </div>
          <div class="stat">
            <h3><?php echo $total_active_books; ?></h3>
            <p>Active Loans</p>
          </div>
          <div class="stat">
            <h3><?php echo $total_pending_fines; ?></h3>
            <p>Pending Fines</p>
          </div>
        </div>
      </section>
    </div>

    <!-- include contact us -->
    <?php include('contactUs.php');?>

    <!-- include footer -->
    <?php include('footer.html')?>

  </body>
</html>
