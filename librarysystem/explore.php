<!-- connecting to server -->
<?php
 include('server.php');

  // sql query to select all books from database
  $sql = 'Select * From books';
  $res = mysqli_query($con, $sql); // $con from server.php
  if(!$res){
    echo "No book available";
  }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Explore Books</title>
    <link rel="stylesheet" href="css/explore.css" />
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
    <!-- Navigatoin bar -->
    <?php 
      include('navigation.php'); 
      ?>
    <!-- End of navigation section -->
     <!-- Fetching data from database -->
        <?php 
          if(isset($_POST['submit'])){
            $search=$_POST['search'];
            $query = "select * from books where name like '%$search%' or author like '%$search%'";
            $result = mysqli_query($con, $query);
            if($result){
              if(mysqli_num_rows($result)>0){               
                while($detail = mysqli_fetch_assoc($result)){ ?>
                  <div class="book">
                    <div class="book-img">
                      <img src="<?php echo './books_image/'.$detail['image'];?>" alt="" />
                    </div>
                    <div class="book-content">
                      <h2><?php echo $detail['name'];?></h2>
                      <p id="author">
                        <b>Author : </b
                        ><?php echo $detail['author'];?>
                      </p>
                      <p>
                        <b>Description:</b>
                        <?php echo $detail['description'];?>
                      </p>
                      <a href="book.php?id=<?php echo $detail['id'] ?>">View item details &#x2192;</a>
                    </div>
                  </div>

    <div class="container">
      <!-- Serach section -->
      <div class="search-container">
        <form method="post">
          <input
            type="text"
            name="search"
            id="search-input"
            placeholder="Search Book by Name"
            required
          />
          <button name="submit" id="search-btn">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </div>
      <div class="books">
       
          <?php
                }
              }else{
                  echo '<h2 style=color:red; width:200px; >Book not found</h2>';
              }
            }
          }?>
      </div>
      <!-- End of serach section -->
 <!-- category button section -->
      <div class="category">
        <h1 id="items">
          <span id="head">Browse </span>Through Book Categories Here
        </h1>
        <div class="category-button">
          <button class="active" data-name="all">All</button>
          <button data-name="Fiction">Fiction</button>
          <button data-name="Motivational">Motivational</button>
          <button data-name="Psychological">Psychological</button>
          <button data-name="Story">Story</button>
          <button data-name="Text Book">Text book</button>
        </div>
      </div>
      <!-- End of category section -->

      <!-- Books section -->
      <div class="books">
        <!-- Fetching data from database -->
        <?php 
        while($book = mysqli_fetch_array($res)){
        ?>

        <div data-name="<?php echo $book['category'];?>" class="book">
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
              <b>Description:</b>
              <?php echo $book['description'];?>
            </p>
            <a href="book.php?id=<?php echo $book['id'] ?>">View item details &#x2192;</a>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
      <!-- End of book section -->
     
 <!-- Contact Us section -->
      <div id="contact">
        <?php 
         include ('contactUs.php');
         ?>
      </div>
      <!-- End of contact us section -->

      <!-- Footer section -->
      <div class="footer">
        <?php
       include('footer.html');
       ?></div>
      <!-- End of footer section -->
    </div>
    <script src="js/explore.js"></script>
  </body>
</html>

     
