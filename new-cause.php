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
      <div class="cause-title">Help children fight cancer</div>

      <div class="cause-detail-page">
        <div class="cause-left">
          <div class="cause-image">
            <img
              src="https://i.pinimg.com/1200x/23/90/83/239083288b913d29c5d68224865a16db.jpg" />
          </div>

          <div class="cause-text">
            Make a difference in the lives of children battling cancer by
            supporting charitable initiatives that provide lifesaving
            treatment, emotional support, and hope for a brighter future. Your
            contribution helps cover medical care, therapy, and essential
            resources for children and their families during their toughest
            journey. Together, we can give them strength, courage, and a
            reason to believe in tomorrow.
          </div>
        </div>

        <div class="donation-container">
          <div>
            <div class="amount">€14</div>
            <div class="goal">of 20,000K</div>
            <div class="donations-count">3 donations</div>

            <div class="recent-donations">
              <div class="donations-progress">
                <div class="donation-progress-icon">
                  <span class="material-symbols-outlined">
                    finance_mode
                  </span>
                </div>
                <h4>3 people have just made a donation</h4>
              </div>

              <div class="donor">
                <div class="donor-icon">
                  <i class="fas fa-hand-holding-heart"></i>
                </div>
                <div class="donor-info">
                  <div class="donor-name">Elsa Halili</div>
                  <div class="donor-amount">€5 · Recent donation</div>
                </div>
              </div>

              <div class="donor">
                <div class="donor-icon">
                  <i class="fas fa-hand-holding-heart"></i>
                </div>
                <div class="donor-info">
                  <div class="donor-name">Anonymous</div>
                  <div class="donor-amount">€5 · Top donation</div>
                </div>
              </div>

              <div class="donor">
                <div class="donor-icon">
                  <i class="fas fa-hand-holding-heart"></i>
                </div>
                <div class="donor-info">
                  <div class="donor-name">Gentrit Halili</div>
                  <div class="donor-amount">€4 · 56 mins</div>
                </div>
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

  <?php include('layout/footer.php') ?>


  <script src="./js/donate.js"></script>
  <script src="./js/main.js"></script>
</body>

</html>