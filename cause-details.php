<?php
session_start();
$currentPage = 'causes';

include_once './database/Database.php';
include_once './classes/Cause.php';
include_once './classes/Donation.php';

$database = new Database();
$pdo = $database->getConnection();





$causeId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$donationObj = new Donation($pdo);
$allDonations = $donationObj->getByCause($causeId);
$totalDonors = count($allDonations);
$donorText = $totalDonors === 1 ? 'person has made a donation' : 'people have made a donation';




$cause = Cause::getById($pdo, $causeId);
if (!$cause) {
  echo "Cause not found!";
  exit;
}

$progress = ($cause->goal_amount > 0)
  ? ($cause->raised_amount / $cause->goal_amount) * 100
  : 0;

$progress = min($progress, 100);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($cause->title) ?></title>

  <link rel="stylesheet" href="./styles/header_footer.css" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/cause-details.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=finance_mode" />
</head>

<body>

  <?php include('components/navigation.php') ?>
  <div class="container">
    <div class="cause-details">

      <div class="cause-title">
        <?= htmlspecialchars($cause->title) ?>
      </div>

      <div class="cause-detail-page">

        <div class="cause-left">
          <div class="cause-image">
            <img src="<?= htmlspecialchars($cause->image) ?>" alt="<?= htmlspecialchars($cause->title) ?>">
          </div>

          <div class="cause-text">
            <?= nl2br(htmlspecialchars($cause->description)) ?>
          </div>
        </div>

        <div class="donation-container">
          <div>

            <div class="amount">€<?= $cause->raised_amount ?> raised</div>
            <div class="goal">of €<?= $cause->goal_amount ?></div>
            <button class="btn btn-share">Share</button>

            <a href="donate.php?cause_id=<?= $cause->id ?>" class="btn btn-green">
              Donate now
            </a>

            <div class="recent-donations">
              <div class="recent-donations">
                <div class="donations-progress">
                  <div class="donation-progress-icon">
                    <span class="material-symbols-outlined">finance_mode</span>
                  </div>
                  <?php

                  ?>
                  <h4><?= $totalDonors ?> <?= $donorText ?></h4>

                </div>

                <?php foreach ($allDonations as $donationItem): ?>
                  <div class="donor">
                    <div class="donor-icon">
                      <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <div class="donor-info">

                      <div class="donor-name">
                        <?= $donationItem['anonymous'] ? 'Anonymous' : htmlspecialchars($donationItem['first_name'] . ' ' . $donationItem['last_name']) ?>
                      </div>
                      <div class="donor-amount">
                        €<?= number_format($donationItem['amount'], 2) ?> · Recent donation
                      </div>

                    </div>
                  </div>
                <?php endforeach; ?>
              </div>


            </div>
          </div>


          <div class="donation-buttons">
            <button>See all</button>
            <button>See top</button>
          </div>

        </div>
      </div>
    </div>
  </div>


  <?php include('components/footer.php') ?>



  <script src="./js/donate.js"></script>
  <script src="./js/main.js"></script>
</body>

</html>