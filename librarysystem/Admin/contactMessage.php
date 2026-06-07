<?php
  // including server
  include('../server.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Message</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="css/contactMessage.css">
  </head>
  <body>
    <div class="heading">
      <h1>Library Management System</h1>
    </div>
    
    <div class="container">
      <!-- including side bar -->
      <?php include('sideBar.php');?>

      <div class="contactMessageTable">
        <h1>Contact Message</h1>

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
              <th>Name</th>
              <th>Email</th>
              <th>Message</th>
              <th>Action</th>
            </tr>
          </thead>
          
          <?php
            // Collecting pending requests from multiple tables
            $sql = "Select * From contact_table";

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
                
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['message']; ?></td>

              <td>
                <div class="deleteBtn">
                  <form method="GET" action="deleteMessage.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                    <button type="submit" name="delete">Delete</button>
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