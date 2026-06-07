<!-- server connection -->
 <?php
  include('../server.php');
?>

<!-- counting -->
<?php
    // counts total books in library
    $query_books = "SELECT SUM(quantity) AS total_books FROM books";
    $result_books = $con->query($query_books);
    $row_books = $result_books->fetch_assoc();
    $total_books = $row_books['total_books'];

    // counts total book borrow
    $query_borrow = "SELECT COUNT(*) AS total_borrow FROM borrowtable WHERE remarks = 'Active'";
    $result_borrow = $con->query($query_borrow);
    $row_borrow = $result_borrow->fetch_assoc();
    $total_borrow = $row_borrow['total_borrow'];

    // count total users
    $query_student = "SELECT COUNT(*) AS total_student FROM users WHERE role = 'user'";
    $result_student = $con->query($query_student);
    $row_student = $result_student->fetch_assoc();
    $total_student = $row_student['total_student'];

    // counts pending request
    $query_pending = "SELECT COUNT(*) AS total_pending FROM borrowtable WHERE remarks = 'Pending'";
    $result_pending = $con->query($query_pending);
    $row_pending = $result_pending->fetch_assoc();
    $total_pending = $row_pending['total_pending'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
  </head>
  <body>
    <div class="heading">
      <h1>Library Management System</h1>
    </div>
    <div class="container">

      <!-- including side bar -->
      <?php include('sideBar.php');?>
    
      <div class="dashboard">
        <h1>Dashboard</h1>
        <div class="cards">

          <div class="card">
            <h2><?php echo $total_books;?></h2>
            <p>Total books in library</p>
          </div>

          <div class="card">
            <h2><?php echo $total_borrow;?></h2>
            <p>Book borrowed</p>
          </div>

          <div class="card">
            <h2><?php echo $total_student?></h2>
            <p>Total Student</p>
          </div>

          <div class="card">
            <h2><?php echo $total_pending?></h2>
            <p>Pending Books</p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
