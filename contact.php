<?php
session_start();
include_once './database/Database.php';
include_once './classes/Message.php';
include_once './classes/User.php';

$db = new Database();
$conn = $db->getConnection();
$messageObj = new Message($conn);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['user']['id'] ?? null;
  $name = $_POST['name'] ?? '';
  $email = $_POST['email'] ?? '';
  $subject = $_POST['subject'] ?? '';
  $message = $_POST['message'] ?? '';

  if ($user_id) {
    $messageObj->add($user_id, $name, $email, $subject, $message);
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Page</title>
  <link rel="stylesheet" href="./styles/header_footer.css">
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/contact.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
  <?php include('components/navigation.php'); ?>

  <div class="container">
    <div class="contact-us">
      <section class="contact-container">
        <div class="contact-inner">

          <div class="form-box">
            <p class="label-title">— CONTACT US</p>
            <h2>One Message. <span> One step closer to helping </span></h2>

            <div class="result"></div>

            <form id="contact-form" method="POST" action="">
              <div class="form-group">
                <label>Your Name *</label>
                <input type="text" class="form-input" id="name" name="name" placeholder="John Doe">
              </div>
              <div class="form-group">
                <label>Email *</label>
                <input class="form-input" id="email" name="email" placeholder="example@gmail.com">
              </div>
              <div class="form-group">
                <label>Subject *</label>
                <input type="text" class="form-input" id="subject" name="subject" placeholder="Enter Subject">
              </div>
              <div class="form-group">
                <label>Your Message *</label>
                <textarea class="form-input" id="message" name="message" rows="6" placeholder="Type here..."></textarea>
              </div>

              <button class="send-btn" type="submit">
                <i class="fas fa-paper-plane"></i> Send Message
              </button>
            </form>
          </div>

          <div class="info-box">
            <h3>Address</h3>
            <p>UBT Dukagjini</p>
            <hr>
            <h3>Contact</h3>
            <p>Phone: 044 110 220</p>
            <p>Email: heart@gmail.com</p>
            <hr>
            <h3>Working Hours</h3>
            <p>Mon - Fri: 10:00 - 20:00</p>
            <p>Sat - Sun: 11:00 - 18:00</p>
            <hr>
            <h3>Social Media</h3>
            <div class="social-links">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>

        </div>
      </section>
    </div>
  </div>

  <?php include('components/footer.php'); ?>


  <script src="./js/contact.js"></script>

</body>

</html>