<?php
session_start();
$currentPage = 'causes';

include_once './database/Database.php';
include_once './classes/Category.php';
include_once './classes/CategoryDAO.php';
include_once './classes/Cause.php';



$database = new Database();
$pdo = $database->getConnection();



$categoryDAO = new CategoryDAO($pdo);
$allCategories = $categoryDAO->getAll();

$categoryId = isset($_GET['id']) ? $_GET['id'] : ($allCategories[0]->getId() ?? 1);
$selectedCategory = $categoryDAO->getById($categoryId);

$causes = Cause::getByCategory($pdo, $categoryId);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Causes</title>
  <link rel="stylesheet" href="./styles/header_footer.css">
  <link rel="stylesheet" href="./styles/style.css">
  <link rel="stylesheet" href="./styles/causes-bycategory.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

</head>

<body>
  <?php include('components/navigation.php') ?>

  <!-- Intro -->
  <section class="causes-wrapper">
    <div class="causes-intro">
      <div class="causes-intro-text">
        <h1>Discover <?= htmlspecialchars($selectedCategory->getName() ?? 'Fundraisers') ?></h1>
        <p>Give help, give hope - donate or start a fundraiser to help a loved one.</p>
        <div><a href="fundraise.php" class="start-btn">Start Your Fundraiser</a></div>
      </div>
      <div class="causes-intro-image">
        <i class="fa-solid <?= htmlspecialchars($selectedCategory->getIcon()) ?>" style=" font-size:200px;color:#01715d;"></i>
        <!-- <i class="<?= htmlspecialchars($selectedCategory->getIcon() ?? 'fa fa-question') ?>" style="font-size:80px;color:#01715d;"></i> -->

        <!-- <img src="<?= htmlspecialchars($selectedCategory->getIcon() ?? 'https://i.pinimg.com/736x/dc/97/dc/dc97dcba38c3476817f9e5568e1b7037.jpg') ?>" alt="Intro"> -->
      </div>
    </div>
  </section>

  <!-- Browse Causes -->
  <section class="causes-browse-section">
    <div class="causes-header">
      <h2 class="section-title">Browse Fundraisers</h2>
    </div>

    <div class="causes">
      <div class="causes-list">
        <?php
        if (count($causes) > 0) {
          foreach ($causes as $cause) {
            echo $cause->render();
          }
        } else {
          echo "<p>No fundraisers found in this category.</p>";
        }
        ?>
      </div>
    </div>
  </section>

  <?php include('components/footer.php') ?>

  <script src="./js/donate.js"></script>
  <script src="./js/main.js"></script>
</body>

</html>