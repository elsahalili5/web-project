<?php
$currentPage = 'causes';
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>

  <link rel="stylesheet" href="./styles/header_footer.css" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/causes.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <?php include('components/navigation.php') ?>


  <section class="causes-container">
    <div class="causes-intro">
      <h1 class="title">
        Browse fundraisers<br />
        by category
      </h1>
      <p class="subtitle">Support a Cause Close to Your Heart</p>
      <a href="fundraise.php" class="start-btn">Start Your Fundraiser</a>
    </div>

    <div class="categories">
      <div class="category">
        <a href="causes-bycategory.php">
          <div class="cause-container">
            <i class="fa-solid fa-heart-pulse"></i>
          </div>
          <span>Medical</span>
        </a>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-cake-candles"></i>
        </div>
        <span>Memorial</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-kit-medical"></i>
        </div>
        <span>Emergency</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-ribbon"></i>
        </div>
        <span>Charity</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <span>Education</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-dog"></i>
        </div>
        <span>Animal</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-tree"></i>
        </div>
        <span>Environment</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-paint-brush"></i>
        </div>
        <span>Arts</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-futbol"></i>
        </div>
        <span>Sports</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-laptop-code"></i>
        </div>
        <span>Technology</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-people-group"></i>
        </div>
        <span>Community</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-users"></i>
        </div>
        <span>Family</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-microscope"></i>
        </div>
        <span>Research</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-plane-departure"></i>
        </div>
        <span>Travel</span>
      </div>

      <div class="category">
        <div class="cause-container">
          <i class="fa-solid fa-utensils"></i>
        </div>
        <span>Food</span>
      </div>
    </div>
  </section>

  <?php include('layout/footer.php') ?>


  <script src="./js/donate.js"></script>
  <script src="./js/main.js"></script>
</body>

</html>