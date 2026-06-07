<?php
include('server.php');

?>
<!-- navigation section -->
<?php 
  include('navigation.php');
  $user_id = $_SESSION['user_id'];
?>
<!-- End of navigation section -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Detail</title>
    <!-- link for icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <!-- link for font -->
    <link rel="stylesheet" href="css/detail.css">
  </head>
  <body>
    <!-- User detail table section -->
    <div class="detail_table">
      <table border="1" cellspacing="0" cellpadding="5">
        <thead>
          <tr>
            <th>Book Image</th>
            <th>Book Name</th>
            <th>Book Author</th>
            <th>Borrow Date</th>
            <th>Return Date</th>
            <th>Remark</th>
            <th>Days Remaining</th>
            <th>Pending Amount</th>
            <th>Cancle Request</th>
          </tr>
        </thead>
        <?php
        // SQL query to get data where book names match in both tables
            $sql = "
            SELECT 
                books.image AS 'Book Image',
                books.name AS 'Book Name',
                books.author AS 'Book Author',
                borrowtable.borrow_date AS 'Borrow Date',
                borrowtable.return_date AS 'Return Date',
                borrowtable.remarks AS 'Remarks',
                borrowtable.id AS 'Borrow id',
                DATEDIFF(borrowtable.return_date, CURDATE()) AS days_remaining
            FROM 
                books
            JOIN 
                borrowtable
            ON 
                books.name = borrowtable.name
            WHERE 
                borrowtable.u_id = $user_id
            ORDER BY 
                borrowtable.id DESC
            ";
            $res = mysqli_query($con, $sql);

            if (!$res) {
              // Handle query failure
              echo "Error: " . mysqli_error($con);
              exit;
            }

            while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <tbody>
          <tr>
            <td><img id="image" src="<?php echo './books_image/'.$row['Book Image'];?>" alt="" /></td>
            <td><?php echo $row['Book Name'];?></td>
            <td><?php echo $row['Book Author'];?></td>
            <td><?php echo $row['Borrow Date'];?></td>
            <td><?php echo $row['Return Date'];?></td>
            <td>
              <?php 
              if($row['Remarks'] == "Pending"){
                echo "<span style='color: yellow; font-weight: bold; font-size: 1.2rem'>Pending</span>";
              }elseif($row['Remarks'] == "Active"){
                echo "<span style='color: green; font-weight: bold; font-size: 1.3rem'>Active</span>";
              }elseif($row['Remarks'] == 'Rejected'){
                echo "<span style='color: red; font-weight: bold; font-size: 1.2rem'>Rejected</span>";
              }elseif($row['Remarks'] == 'Returned'){
                echo "<span style='color: #20C997; font-weight: bold; font-size: 1.2rem'>Returned</span>";
              }
              ?>
            </td>
            <td>
               <?php 
               if($row['Remarks'] == 'Pending'){
                echo "Awaiting admin approval";
               }elseif($row['Remarks'] == 'Returned'){
                echo "Book has been reutrned";
               }elseif($row['Remarks'] == 'Rejected'){
                echo "Request has been rejected";
               }else{
                  if ($row['days_remaining'] > 0) {
                  // Future date: Days remaining
                  echo $row['days_remaining'] . " days remaining";
                  } else {
                      // Overdue date: Convert to positive days
                      echo "<span style='color: red;'>Overdue by " . abs($row['days_remaining']) . " days</span>";
                  }
                }
                ?>
            </td>
            <td>
              <?php
              if($row['Remarks'] == 'Returned' || $row['Remarks'] == 'Pending' || $row['Remarks'] == 'Rejected') {
                echo "0";
              } else {
                if ($row['days_remaining'] < 0) {
                  // Calculate fine - Rs.5 per day
                  $overdue_days = abs($row['days_remaining']);
                  $fine_amount = $overdue_days * 5;
                                                   
                  echo "<span class='overdue-amount'>Rs. " . $fine_amount . "</span>";
                } else {
                  echo "0";
                }
              }
              ?>
            </td>
            <td>
              <?php 
              if($row['Remarks'] == 'Pending' || $row['Remarks'] == 'Rejected'){
              ?>
              <!-- Form for Cancel -->
              <form method="POST" action="cancleRequest.php">
                <!-- Hidden input to store the row's unique ID -->
                <input type="hidden" name="id" value="<?php echo $row['Borrow id']; ?>" />             
                <button id="cancle" type="submit" name="cancel">Cancel</button>
              </form>

              <?php 
              }else{
                echo "<span style= 'color: gray;'> Not Allowed</span>";
              }
              ?>
            </td>
          </tr>
        </tbody>
        <?php 
          }
        ?>
      </table>
    </div>
    <!-- end of user detail table section -->

    <!-- Contact us section -->
      <div id="contact">
        <?php 
        include ('contactUs.php');
        ?>
      </div>
      <!-- End of contact us section -->

      <!-- Footer sectoin -->
      <div class="footer">
        <?php
        include('footer.html');
        ?>
      </div>
      <!-- End of footer section -->
    </div>
  </body>
</html>
