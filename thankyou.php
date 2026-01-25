<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./styles/header_footer.css" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/thankyou-card.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <?php include('components/navigation.php') ?>


  <div class="main-banner">
    <div class="thankyou-section">
      <h1 class="thankyou-message">Thank You For Donating!</h1>
      <p class="thankyou-text">
        Your generosity brings hope and a brighter future
      </p>
      <p class="thankyou-text">We truly appreciate heartfelt support.</p>
    </div>
  </div>

  <?php include('layout/footer.php') ?>

</body>
<script src="./js/donate.js"></script>
<script src="./js/main.js"></script>

</html>