<?php
  // including server
  include('../server.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Returned Books</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="css/returnBooks.css">
  </head>
  <body>
    <div class="heading">
      <h1>Library Management System</h1>
    </div>
    
    <div class="container">
      <!-- including side bar -->
      <?php include('sideBar.php');?>

      <div class="returnedBookTable">
        <h1>Returned Books</h1>

        <!-- serach bar -->
        <div class="search-container">
        <form method="post">
          <input
            type="text"
            name="search"
            id="search-input"
            placeholder="Enter student name"
            required
          />
          <button name="submit" id="search-btn">
            <i class="fas fa-search"></i>
          </button>
        </form>
        </div>
      <!-- end of search bar -->

        <table border="1" cellspacing="0" cellpadding="5">
          <thead>
            <tr>
              <th>Book Image</th>
              <th>Book Name</th>
              <th>Borrower Name</th>
              <th>Borrower Contact</th>
              <th>Borrow Date</th>
              <th>Return Date</th>
              <th>Remark</th>
              <th>Action</th>
            </tr>
          </thead>
          
          <?php
            // Collecting pending requests from multiple tables
            $sql = "
              SELECT 
                borrowtable.id AS borrow_id, 
                books.image AS book_image,
                books.name AS book_name,
                users.name AS borrower_name,
                users.number AS borrower_contact,
                borrowtable.borrow_date, 
                borrowtable.return_date, 
                borrowtable.remarks
              FROM 
                borrowtable
              JOIN 
                books 
              ON 
                borrowtable.name = books.name
              JOIN 
                users 
              ON 
                borrowtable.u_id = users.u_id
              WHERE 
                borrowtable.remarks = 'Returned'
              ORDER BY 
                borrowtable.id DESC";

            $res = mysqli_query($con, $sql);

            if (!$res) {
              echo "Error: " . mysqli_error($con);
              exit;
            }

            while ($row = mysqli_fetch_assoc($res)) {
          ?>
          <tbody>
            <tr>
              <!-- Displaying data from the query -->
              <td><img id="image" src="<?php echo './../books_image/'.$row['book_image']; ?>" alt="Book Image" width="50" height="50"></td>
              <td><?php echo $row['book_name']; ?></td>
              <td><?php echo $row['borrower_name']; ?></td>
              <td><?php echo $row['borrower_contact']; ?></td>
              <td><?php echo $row['borrow_date']; ?></td>
              <td><?php echo $row['return_date']; ?></td>
              <td>
                <?php 
                  if($row['remarks'] == 'Returned'){
                  echo "<span style='color: #20C997; font-weight: bold; font-size: 1.3rem'>Returned</span>";
                  } 
                ?>
              </td>
              <td>
                <div class="deleteBtn">
                  <form method="POST" action="">
                    <input type="hidden" name="id" value="<?php echo $row['borrow_id']; ?>" />
                    <button type="submit" name="status" value="Returned">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
          </tbody>
          <?php
            }
          ?>
        </table>
      </div>
    </div>
  </body>
</html>
