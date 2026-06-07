<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us - Our Library</title>
    <link rel="stylesheet" href="about.css" />
    <!-- link for icon -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <!-- link for font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto&family=Playfair+Display&family=Poppins&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/about.css" />
  </head>

  <body>
    <!-- Navigation Bar -->
      <?php include('navigation.php'); ?>
    <!-- End of navigation bar -->
    <div class="container">
      
      <!-- About Us Section -->
      <div class="about-us">
        <div class="heading">
          <h1>About Us</h1>
        </div>
        <h2>Welcome to Our Library!</h2>
        <p>
          We are a hub of knowledge, education, and culture that serves our
          community by providing access to an extensive collection of books,
          resources, and services. Our mission is to foster lifelong learning,
          support research, and offer a space for inspiration and creativity.
        </p>

        <h2>Our Mission</h2>
        <p>
          Our mission is to provide free and equal access to knowledge and
          information for all. We believe in the power of books and education to
          change lives, and we are committed to creating an inclusive and
          welcoming space for everyone in our community.
        </p>

        <h2>What We Offer</h2>
        <ul>
          <li>
            Extensive Collection: Over 10,000 books, magazines, and digital
            resources.
          </li>
          <li>
            Children's Section: A vibrant area dedicated to young readers with a
            vast collection of books and activities.
          </li>
          <li>
            Study and Research Areas: Comfortable spaces for study, research,
            and group discussions.
          </li>
          <li>
            Workshops & Events: Regular workshops, storytelling sessions, author
            talks, and more.
          </li>
        </ul>

        <h2>Meet Our Team</h2>
        <p>
          Our dedicated team of librarians and staff members are passionate
          about helping you find the information you need and creating a
          positive experience for every visitor. Feel free to reach out to any
          of our friendly staff for assistance.
        </p>

        <div class="staff-profiles">
          <div class="staff">
            <img src="image/logo.png" alt="Library Staff" />
            <h3>Mam</h3>
            <p>Head Librarian</p>
          </div>
         
          <div class="staff">
            <img src="image/logo.png" alt="Library Staff" />
            <h3>Ronil Maharjan</h3>
            <p>Developer</p>
          </div>
        </div>
      </div>
    </div>
    <!-- End of about us section -->
     
    <!-- Contact Us section -->
    <div id="contact">
      <?php include('contactUs.php'); ?>
    </div>
    <!-- End of contact us section -->

    <!-- Footer Section -->
    <?php include('footer.html'); ?>
    <!-- End of footer section -->
  </body>
</html>
