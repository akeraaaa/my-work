<!-- conneting to server -->
<?php
 include('server.php');

  // sql query to select 6 books from database
  $sql = 'Select * From books Limit 6';
  $res = mysqli_query($con, $sql); 
  if(!$res){
    echo "No book available";
  }
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
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <!-- navigation bar section -->
    <?php
    include('navigation.php');
    ?>
    <!-- End of navigation section -->
    <div class="container">

      <!-- Image slide show section -->
      <div class="content-img">
  <div class="slides">
    <img id="slide" class="active" src="image/background.jpg" alt="" />
    <img id="slide" src="image/background1.jpg" alt="" />
    <img id="slide" src="image/background2.jpg" alt="" />
    <img id="slide" src="image/background3.jpg" alt="" />
    
  <div class="content">
    <h1>knowledge is power</h1>
    <span>With knowledge, individuals can make informed decisions, solve
    problems effectively, and achieve success. It empowers people to
    adapt to change and overcome challenges in various aspects of
    life.</span>
  </div>
</div>
      <!-- End if image slide show section -->

      <!-- Categories section -->
      <div class="featured-section">
        <div class="featured-content">
          <h1>Book Categories</h1>
          <div class="category-wrapper">
            <div class="stat-item">
              <div class="stat-number">Fiction</div>
              <div class="stat-label">Novels & Stories</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">Motivational</div>
              <div class="stat-label">Self-Help Books</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">Psychological</div>
              <div class="stat-label">Mind & Behavior</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">Story Book</div>
              <div class="stat-label">Children's Literature</div>
            </div>
            <!-- <div class="stat-item">
              <div class="stat-number">Text Book</div>
              <div class="stat-label">Academic Resources</div>
            </div> -->
          </div>
        </div>
      </div>
      <!-- End of Categories section -->

      <!-- Books section -->
      <h1 id="items"><span id="head">Items</span> Currently In The Library</h1>
      <div class="books">
        <!-- Fetching data from database -->
        <?php 
        while ($book = mysqli_fetch_array($res)){
        ?>

        <div class="book">
          <div class="book-img">
            <img src="<?php echo './books_image/'.$book['image'];?>" alt="" />
          </div>
          <div class="book-content">
            <h2><?php echo $book['name'];?></h2>
            <p id="author">
              <b>Author : </b
              ><?php echo $book['author'];?>
            </p>
            <p>
              <b>Description : </b
              ><?php echo $book['description'];?>
            </p>
            <a href="book.php?id=<?php echo $book['id'] ?>">View item details &#x2192;</a>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
      <div class="explore-more">
        <button onclick="location.href='explore.php'">
          Explore more &#x2192;
        </button>
      </div>
      
      
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
    <script src="js/script.js"></script>
  </body>
</html>
