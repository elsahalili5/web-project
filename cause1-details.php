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
  <?php include('layout/navigation.php') ?>

  <div class="container">
    <div class="cause-details">
      <div class="cause-title">Help for children education</div>

      <div class="cause-detail-page">
        <div class="cause-left">
          <div class="cause-image">
            <img
              src="https://i.pinimg.com/1200x/0b/52/7c/0b527cae2b0718c7c38f477a0ca99cf8.jpg" />
          </div>

          <div class="cause-text">
            Empower children through charity by providing access to quality
            education, books, school supplies, and safe, supportive learning
            environments. Across the world, millions of children are unable to
            attend school due to poverty, conflict, displacement, and lack of
            basic resources. Without education, these children face limited
            opportunities and an uncertain future. Your support helps open
            classroom doors, protect childhood dreams, and give every child a
            chance to learn, grow, and succeed.
          </div>
        </div>

        <div class="donation-container">
          <div class="amount">€15,874</div>
          <div class="goal">of 50,000K</div>
          <div class="donations-count">2.5K donations</div>

          <button class="btn btn-share">Share</button>
          <a href="donate.html" class="btn btn-green">Donate now</a>

          <div class="recent-donations">
            <div class="donations-progress">
              <div class="donation-progress-icon">
                <span class="material-symbols-outlined"> finance_mode </span>
              </div>
              <h4>566 people have just made a donation</h4>
            </div>

            <div class="donor">
              <div class="donor-icon">
                <i class="fas fa-hand-holding-heart"></i>
              </div>
              <div class="donor-info">
                <div class="donor-name">Elsa Halili</div>
                <div class="donor-amount">€50 · Recent donation</div>
              </div>
            </div>

            <div class="donor">
              <div class="donor-icon">
                <i class="fas fa-hand-holding-heart"></i>
              </div>
              <div class="donor-info">
                <div class="donor-name">Anonymous</div>
                <div class="donor-amount">€5,000 · Top donation</div>
              </div>
            </div>

            <div class="donor">
              <div class="donor-icon">
                <i class="fas fa-hand-holding-heart"></i>
              </div>
              <div class="donor-info">
                <div class="donor-name">Eriona Bunjaku</div>
                <div class="donor-amount">€100 · 1 hr</div>
              </div>
            </div>

            <div class="donor">
              <div class="donor-icon">
                <i class="fas fa-hand-holding-heart"></i>
              </div>
              <div class="donor-info">
                <div class="donor-name">Genita Halili</div>
                <div class="donor-amount">€30 · 2 hrs</div>
              </div>
            </div>

            <div class="donor">
              <div class="donor-icon">
                <i class="fas fa-hand-holding-heart"></i>
              </div>
              <div class="donor-info">
                <div class="donor-name">Gentrit Halili</div>
                <div class="donor-amount">€25 · 56 mins</div>
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