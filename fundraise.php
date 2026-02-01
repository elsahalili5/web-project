<?php
session_start();

$currentPage = 'fundraise';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once './database/Database.php';
require_once './classes/User.php';
require_once './classes/CategoryDAO.php';
require_once './classes/Cause.php';

if (!User::isLoggedIn()) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['user']['id'];

$db = new Database();
$pdo = $db->getConnection();

$categoryDAO = new CategoryDAO($pdo);
$categories = $categoryDAO->getAll();

$success = false;
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $category_id  = intval($_POST['category_id'] ?? 0);
  $title        = trim($_POST['title'] ?? '');
  $description  = trim($_POST['description'] ?? '');
  $goal_amount  = floatval($_POST['goal_amount'] ?? 0);
  $image        = trim($_POST['image'] ?? 'default.jpg');

  if (
    $category_id > 0 &&
    $title !== '' &&
    $description !== '' &&
    $goal_amount > 0
  ) {
    try {
      $added = Cause::add(
        $pdo,
        $user_id,
        $category_id,
        $title,
        $description,
        $goal_amount,
        $image
      );

      if ($added) {
        $success = true;
      } else {
        $errorMessage = "Failed to create fundraiser.";
      }
    } catch (PDOException $e) {
      $errorMessage = "Database error: " . $e->getMessage();
    }
  } else {
    $errorMessage = "Please fill all required fields correctly.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Start a Fundraiser</title>
  <link rel="stylesheet" href="./styles/header_footer.css" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/fundraise.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>
  <?php include('components/navigation.php'); ?>

  <div class="success-step" id="successScreen" style="<?= $success ? 'display:flex' : 'display:none' ?>">
    <div class="success-content">
      <h1>
        Congratulations!<br />
        Your Fundraiser Has Been Created
      </h1>

      <p>
        Your fundraiser is now awaiting admin approval. Once approved, it will go live
        and you can start raising funds. Thank you for taking action and making a difference!
      </p>

      <a href="my-fundraisers.php" class="btn-green">View Your Fundraiser</a>
    </div>
  </div>

  <div class="fundraise-section" style="<?= $success ? 'display:none' : '' ?>">
    <div class="left">
      <div>
        <h1 id="leftTitle" class="left-title">Start a Fundraiser</h1>
        <p id="leftDescription" class="left-description">What best describes why you're fundraising?</p>
      </div>
    </div>

    <div class="right">
      <?php if ($errorMessage): ?>
        <div class="error-message" style="color:red; margin-bottom:15px;">
          <?= htmlspecialchars($errorMessage) ?>
        </div>
      <?php endif; ?>

      <form id="fundraiserForm" class="fundraise-form" method="POST">
        <div class="step active-step">
          <div class="categories">
            <?php foreach ($categories as $cat): ?>
              <div class="category" data-id="<?= $cat->getId() ?>"><?= htmlspecialchars($cat->getName()) ?></div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="step">
          <h2 style="margin-bottom: 20px">Who are you fundraising for?</h2>
          <div class="card">
            <div class="icon"><span class="material-symbols-outlined">person_heart</span></div>
            <div><strong>Yourself</strong>
              <p>Funds go to you</p>
            </div>
          </div>
          <div class="card">
            <div class="icon"><span class="material-symbols-outlined">family_restroom</span></div>
            <div><strong>Someone else</strong>
              <p>Invite a beneficiary</p>
            </div>
          </div>
        </div>
        <div class="step">
          <h2>Set your goal amount</h2>
          <input class="amount" type="number" name="goal_amount" placeholder="Amount (€)" required />
        </div>

        <div class="step">
          <h2 class="step-title">Add a fundraiser title</h2>
          <input class="fundraiser-title" id="fundraiser-title" type="text" name="title" placeholder="Donate to help..." required />
        </div>

        <div class="step step-text">
          <h2 class="step-title">Tell your story</h2>
          <div class="form-group">
            <textarea name="description" maxlength="1000" rows="4" placeholder="Explain why you need funds..." required></textarea>
            <div class="char-count"><span id="titleCount">0</span>/1000</div>
          </div>
        </div>

        <div class="step">
          <h2>Add a cover photo</h2>
          <div class="upload">Click to upload an image</div>
          <input type="hidden" name="image" id="selectedImage" value="default.jpg" />
        </div>

        <input type="hidden" name="category_id" id="selectedCategory" value="<?= $categories[0]->getId() ?>">

        <div class="actions">
          <button type="button" class="back">←</button>
          <button class="btn-green" id="nextBtn" type="button">Continue</button>
          <button type="submit" id="submitBtn" class="btn-green" hidden>Launch Fundraiser</button>
        </div>
      </form>
    </div>
  </div>

  <?php include('components/footer.php'); ?>

  <script src="./js/donate.js"></script>
  <script src="./js/main.js"></script>
  <script src="./js/fundraise.js"></script>

  <script>
    document.addEventListener("click", (e) => {
      if (e.target.classList.contains("category")) {
        document.getElementById("selectedCategory").value = e.target.dataset.id;
        e.target.parentElement.querySelectorAll('.category').forEach(cat => cat.classList.remove('active-step'));
        e.target.classList.add('active-step');
      }
    });
  </script>
</body>

</html>