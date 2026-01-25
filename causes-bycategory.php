<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./styles/header_footer.css" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/causes-bycategory.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <?php include('layout/navigation.php') ?>

  <section class="causes-wrapper">
    <div class="causes-intro">
      <div class="causes-intro-text">
        <h1>Discover medical <br />fundraisers</h1>
        <p>
          Give help, give hope - donate or start a fundraiser to help a loved
          one.
        </p>
        <div>
          <a href="fundraise.html" class="start-btn">Start Your Fundraiser</a>
        </div>
      </div>
      <div class="causes-intro-image">
        <img
          src="https://i.pinimg.com/736x/dc/97/dc/dc97dcba38c3476817f9e5568e1b7037.jpg" />
      </div>
    </div>
  </section>

  <section class="causes-browse-section">
    <div class="causes-header">
      <h2 class="section-title">Browse medical fundraisers</h2>
    </div>

    <div class="causes">
      <div class="causes-list">
        <a href="cause-details.html">
          <div class="cause-card">
            <div class="card-image">
              <img
                src="https://images.gofundme.com/nLnMdFjvwlR0jNeqxabZCmmIRmg=/720x405/https://d2g8igdw686xgo.cloudfront.net/97509371_1765262773517765_r.jpg" />
            </div>
            <div class="card-content">
              <h3 class="card-title">
                Support Sienna’s Recovery From a Rare Brain Condition
              </h3>
              <p class="card-description">
                Hello, we’re Gary and Angelina, and we have two beautiful
                daughters: Adriana, 7, and our youngest, Sienna..
              </p>
              <div class="progress-container">
                <div class="progress" style="width: 32%"></div>
              </div>
              <p class="fund-status">
                $42,774/<span class="goal">$50,000</span>
              </p>
            </div>
          </div>
        </a>

        <div class="cause-card">
          <div class="card-image">
            <img
              src="https://i.pinimg.com/1200x/23/90/83/239083288b913d29c5d68224865a16db.jpg"
              alt="Child cancer patient in hospital bed" />
          </div>
          <div class="card-content">
            <h3 class="card-title">Help children fight cancer</h3>
            <p class="card-description">
              Make a difference in the lives of children battling cancer by
              supporting charitabl...
            </p>
            <div class="progress-container">
              <div class="progress" style="width: 46%"></div>
            </div>
            <p class="fund-status">
              $42,774/<span class="goal">$90,000</span>
            </p>
          </div>
        </div>

        <div class="cause-card">
          <div class="card-image">
            <img
              src="https://i.pinimg.com/1200x/37/ac/7e/37ac7efdfef8f4d8aff459783d49bf8a.jpg" />
          </div>
          <div class="card-content">
            <h3 class="card-title">Help John fight chronic illness</h3>
            <p class="card-description">
              John is battling a long-term illness and needs financial support
              for ongoing treatment and medication...
            </p>
            <div class="progress-container">
              <div class="progress" style="width: 40%"></div>
            </div>
            <p class="fund-status">
              $8,000/<span class="goal">$20,000</span>
            </p>
          </div>
        </div>
        <div class="cause-card">
          <div class="card-image">
            <img
              src="https://i.pinimg.com/736x/7a/e3/69/7ae3694ca7fa17245862448520ad9d49.jpg" />
          </div>
          <div class="card-content">
            <h3 class="card-title">
              My Sister Is 26 — the NHS Has Given up on her. We Haven’t!
            </h3>
            <p class="card-description">
              My sister Beatriz is 26, and I’m sharing her story because she’s
              too exhausted...
            </p>
            <div class="progress-container">
              <div class="progress" style="width: 50%"></div>
            </div>
            <p class="fund-status">
              $5,000/<span class="goal">$10,000</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include('layout/footer.php') ?>

</body>
<script src="./js/donate.js"></script>
<script src="./js/main.js"></script>

</html>