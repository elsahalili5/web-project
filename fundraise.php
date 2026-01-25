<?php
$currentPage = 'fundraise';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./styles/header_footer.css" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/fundraise.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>

<body>
  <?php include('layout/navigation.php') ?>

  <div class="fundraise-section">
    <div class="left">
      <div>
        <h1 id="leftTitle" class="left-title"></h1>
        <p id="leftDescription" class="left-description">
          What best describes why you're fundraising?
        </p>
      </div>
    </div>
    <div class="right">
      <form id="fundraiserForm" class="fundraise-form">
        <div class="step active-step">
          <div class="categories">
            <div class="category">Medical</div>
            <div class="category">Memorial</div>
            <div class="category">Emergency</div>
            <div class="category">Charity</div>
            <div class="category">Education</div>
            <div class="category">Animal</div>
            <div class="category">Enviroment</div>
            <div class="category">Arts</div>
            <div class="category">Sports</div>
            <div class="category">Technology</div>
            <div class="category">Community</div>
            <div class="category">Family</div>
            <div class="category">Research</div>
            <div class="category">Travel</div>
            <div class="category">Food</div>
          </div>
        </div>

        <div class="step">
          <h2 style="margin-bottom: 20px">Who are you fundraising for?</h2>

          <div class="card">
            <div class="icon">
              <span class="material-symbols-outlined"> person_heart </span>
            </div>
            <div>
              <strong>Yourself</strong>
              <p>Funds go to you</p>
            </div>
          </div>

          <div class="card">
            <div class="icon">
              <span class="material-symbols-outlined"> family_restroom </span>
            </div>
            <div>
              <strong>Someone else</strong>
              <p>Invite a beneficiary</p>
            </div>
          </div>
        </div>

        <div class="step">
          <h2>Set your goal amount</h2>
          <input class="amount" type="number" placeholder="Amount (€)" />
        </div>

        <div class="step">
          <h2 class="step-title">Add a fundraiser title</h2>
          <input
            class="fundraiser-title"
            id="fundraiser-title"
            type="text"
            placeholder="Donate to help..." />
        </div>

        <div class="step step-text">
          <h2 class="step-title">Tell your story</h2>
          <div class="form-group">
            <textarea
              maxlength="60"
              rows="2"
              placeholder="Donate to help..."></textarea>
            <div class="char-count"><span id="titleCount">0</span>/60</div>
          </div>
        </div>

        <div class="step">
          <h2>Add a cover photo</h2>
          <div class="upload">Click to upload an image</div>
        </div>

        <div class="step review-step">
          <div class="review-card">
            <div class="review-row"><strong>Cover</strong></div>
            <div class="media-preview"></div>
          </div>
          <div class="review-card">
            <div class="review-row"><strong>Title</strong></div>
            <p id="reviewTitle">—</p>
          </div>
          <div class="review-card">
            <div class="review-row"><strong>Story</strong></div>
            <p id="reviewStory">-</p>
          </div>
          <div class="review-card">
            <div class="review-row"><strong>Fundraising goal</strong></div>
            <p id="reviewGoal">—</p>
          </div>
          <div class="review-card">
            <div class="review-row"><strong>Category</strong></div>
            <p id="reviewCategory">—</p>
          </div>
        </div>

        <div class="actions">
          <button type="button" class="back">←</button>
          <button class="btn-green" id="nextBtn">Continue</button>
          <button type="submit" id="submitBtn" class="btn-green" hidden>
            Launch Fundraiser
          </button>
        </div>
      </form>
    </div>
  </div>
  <div class="success-step" id="successScreen">
    <div class="success-content">
      <h1>
        Congratulations!<br />
        Your Fundraiser is Live
      </h1>

      <p>
        You're making a difference! Your campaign is now active, and every
        effort counts towards creating real impact. Get ready to inspire and
        empower others to support your cause.
      </p>

      <a
        href="new-cause.php
        "
        class="btn-white">View Your Fundraiser</a>
    </div>
  </div>

  <?php include('layout/footer.php') ?>

</body>
<script src="./js/donate.js"></script>
<script src="./js/main.js"></script>
<script src="./js/fundraise.js"></script>

</html>