<?php
  include('server.php');
  if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM users WHERE u_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap");

      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: "Montserrat", sans-serif;
      }
      .contact-container {
        background: linear-gradient(45deg, #3c3d37, #4a4b44);
        padding: 50px 20px;
        box-sizing: border-box;
      }
      .contact-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
      }
      .contact-info-card {
        background: rgba(255, 255, 255, 0.05);
        padding: 2rem;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        transition: transform 0.3s ease;
      }
      .contact-info-card:hover {
        transform: translateY(-10px);
      }
      .contact-info {
        margin-top: 30px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        padding: 10px;
      }
      .contact-form {
        background: rgba(255, 255, 255, 0.1);
        padding: 2rem;
        border-radius: 15px;
        backdrop-filter: blur(10px);
        color: white;
      }
      .contact-form h2 {
        margin-bottom: 20px;
      }
      .contact-form input,
      .contact-form textarea {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: none;
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 1rem;
      }
      .contact-form input::placeholder,
      .contact-form textarea::placeholder {
        color: white;
        opacity: 1;
        
      }
      .submit-btn {
        background: #6256ca;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        cursor: pointer;
        transition: background 0.3s ease;
      }
      .submit-btn:hover {
        background: #4f44b6;
      }
      @media (max-width: 768px) {
        .contact-wrapper {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </head>
  <body>
    <div class="contact-container">
      <div class="contact-wrapper">
        <div class="contact-info-card">
          <h1>Contact Us</h1>
          <div class="contact-info">
            <p><i class="fas fa-map-marker-alt"></i> Kathmandu, Balkumari</p>
            <p><i class="fas fa-phone"></i> 01-623748</p>
            <p><i class="fas fa-envelope"></i> ncitlibrary@gmail.com</p>
            <p><i class="fas fa-clock"></i> Mon-Fri, 9:00 AM - 4:00 PM</p>
          </div>
        </div>

        <div class="contact-form">
          <h2>Send us a message</h2>
          <form action="contact.php" method="POST">
             <?php if(isset($_SESSION['user_id'])):?>
              <input type="text" name="name" readonly value="<?php echo $user['name']?>"/>

              <input
              type="name"
              name="email"
              readonly
              value="<?php echo $user['email']?>"
              />
            <?php else: ?>
              <input type="text" name="name" placeholder="Your Name" required/>

              <input
              type="email"
              name="email"
              placeholder="Your Email"
              required
              />
            <?php endif; ?>
            <textarea
              rows="5"
              name="message"
              placeholder="Your Message"
              required
            ></textarea>
            <button type="submit" class="submit-btn">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
