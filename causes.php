<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$currentPage = 'causes';

include_once './database/Database.php';
include_once './classes/Category.php';
include_once './classes/CategoryDAO.php';

$database = new Database();
$pdo = $database->getConnection();

$categoryDAO = new CategoryDAO($pdo);

$categories = $categoryDAO->getAll();

?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Browse Causes</title>
  <link rel="stylesheet" href="./styles/header_footer.css" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/causes.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <?php include('components/navigation.php') ?>

  <section class="causes-container">
    <div class="causes-intro">
      <h1 class="title">Browse fundraisers<br />by category</h1>
      <p class="subtitle">Support a Cause Close to Your Heart</p>
      <a href="fundraise.php" class="start-btn">Start Your Fundraiser</a>
    </div>

    <div class="categories">
      <?php
      foreach ($categories as $cat) {
        echo $cat->render();
      }
      ?>
    </div>
  </section>

  <?php include('components/footer.php') ?>

  <script src="./js/donate.js"></script>
  <script src="./js/main.js"></script>
</body>

</html>