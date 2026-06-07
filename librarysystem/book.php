<!-- connecting to server -->
<?php
  include('server.php');

  // sql query to select the book from database
  $book_id = $_GET['id'];
  
  $sql = "Select * from books Where id = '$book_id'";
  $stmt = $con->prepare($sql);
  $stmt->execute();

  // Get the result
  $result = $stmt->get_result();
  $book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Explore Books</title>
    <link rel="stylesheet" href="css/book.css" />
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
  </head>
  <body>
    <!-- Navigation section -->
     <?php 
     include('navigation.php');
     ?>
     <!-- End of navigation section -->
    
     <div class="container">
       <!-- Book detail section -->
      <div class="book-detail">
        <div class="book-img">
          <img src="<?php echo './books_image/'.$book['image'];?>" alt="">
        </div>
        <div class="contain">
          <h2><?php echo $book['name'];?></h2>
            <p id="author">
              <b>Author : </b
              ><?php echo $book['author']?>
            </p>
            <p>
              <b>Description:</b>
               <?php echo $book['description']?>
            </p>
            <p>
              <b>Book remaining in library:</b>
              <?php echo $book['quantity']?>
              </p>
            <!-- Borrow button with condition based on login status -->
            <?php if(isset($_SESSION['user_id'])):?>
              <button id="borrow">Borrow &#x2192;</button>
            <?php else: ?>
              <button onclick="window.location.href='login.php';" id="borrow">Login to Borrow &#x2192;</button>
            <?php endif; ?>
        </div>
      </div>
      <!-- End of book detail section -->

      <!-- Borrow book form section -->
       <div id="borrowForm" class="form-container">
        <form action="borrow.php" method="POST">
          <h2>Please Enter The Date Of Borrow And Retuen</h2>

          <label for="book_title">Book Title:</label>
          <input type="text" name="book_title" id="bookTitle" placeholder="Enter book title" readonly value="<?php echo $book['name']?>">

          <label for="borrow_date">Borrow Date:</label>
          <input type="date" id="borrow_date" name="borrow_date">

          <label for="return_date">Return Date:</label>
          <input type="date" id="return_date" name="return_date" >

          <div class="button">
            <button type="button" onclick="window.location.href='book.php?id=<?php echo $book['id'] ?>';" id="cancleForm">Cancle</button>
            <button type="submit">Submit</button>
          </div>
        </form>
       </div>
      <!-- End of borrow book form section -->

    </div>
    <!-- Contact us section -->
    <div class="contact">
      <?php
      include('contactUs.php');
      ?>
    </div>
    <!-- End of contact us section -->

    <!-- Footer section -->
     <div class="footer">
      <?php
      include('footer.html');
      ?>
     </div>
     <!-- End of footer section -->
    <script src="js/borrow.js"></script>
  </body>
</html>
