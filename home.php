<?php
require_once "./classes/Cause.php";
require_once "./database/Database.php";

$database = new Database();
$pdo = $database->getConnection();

// Merr të gjitha kauzat approved
$causes = Cause::getAllApprovedCauses($pdo, 5);

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./styles/header_footer.css" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/home.css" />
  <link rel="stylesheet" href="./styles/causes.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <?php include('components/navigation.php') ?>



  <section class="home-intro">
    <div class="container">

      <?php if (User::isAdmin()): ?>
        <a href="./dashboard/dashboard.php" class="btn-yellow"> Dashboard</a>
      <?php endif; ?>

      <div class="intro">

        <div class="intro-content">



          <h1 class="intro-title">
            Charity springs <br />
            from a tender <br />
            Heart.
          </h1>

          <p class="intro-description">
            The Heart: a place to give, share, and make a difference in your
            community.
          </p>
          <div class="intro-actions">
            <a href="causes.php" class="btn-green">Donate Now 💛 </a>
            <a href="https://youtu.be/v5wbODeVHC8" class="btn-watch">
              <span class="play-icon">▶</span>
              Watch video
            </a>


          </div>

        </div>

        <div class="intro-pic">
          <img src="./images/intropic3.png" alt="" />
        </div>
      </div>
    </div>
  </section>

  <section class="statistics-section">
    <div class="container">
      <div class="stats-grid">
        <div class="stat-item">
          <span class="stat-icon">
            <i class="fas fa-hand-holding-heart"></i>
          </span>
          <div class="stat-content">
            <p class="stat-number">100+</p>
            <p class="stat-label">Donation received</p>
          </div>
        </div>

        <div class="stat-item">
          <span class="stat-icon">
            <i class="fa-solid fa-dollar-sign"></i>
          </span>
          <div class="stat-content">
            <p class="stat-number">$10K</p>
            <p class="stat-label">Money donated</p>
          </div>
        </div>

        <div class="stat-item">
          <span class="stat-icon">
            <i class="fas fa-bullhorn"></i>
          </span>
          <div class="stat-content">
            <p class="stat-number">12+</p>
            <p class="stat-label">Active causes</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="our-mission">
    <div class="our-mission-container">
      <div class="our-mission-intro">
        <h1 class="our-mission-title">
          The mission & goals of our organization
        </h1>
        <p class="our-mission-description">
          How can we touch lives, spread hope, and build a better future
          through giving?
        </p>
        <a href="about.php" class="btn-green">Learn More</a>
      </div>

      <div class="our-mission-services">
        <article class="service-card">
          <div class="service-icon-container">
            <img src="./images/medical.png" class="service-icon" />
          </div>
          <h3 class="service-title">Medical service</h3>
        </article>

        <article class="service-card">
          <div class="service-icon-container">
            <img src="./images/book.png" class="service-icon" />
          </div>
          <h3 class="service-title">School Education</h3>
        </article>
        <article class="service-card right-service">
          <div class="service-icon-container">
            <img src="/images/orph.png" class="service-icon" />
          </div>
          <h3 class="service-title">Orphanage care</h3>
        </article>

        <article class="service-card">
          <div class="service-icon-container">
            <img src="./images/gift.png" alt="Food" class="service-icon" />
          </div>
          <h3 class="service-title">Gift giving</h3>
        </article>
      </div>
    </div>
  </section>

  <section class="steps-section">
    <div class="steps-header">
      <h2 class="main-title">Simple Steps to Make a Difference</h2>
      <p class="main-subtitle">
        Follow our easy process to support the causes you care about most.
      </p>
    </div>

    <div class="steps-container">
      <div class="step-item">
        <div class="step-circle">1</div>
        <h3 class="step-title">Create Your Account</h3>
        <p class="step-text">
          Sign up or log in to your personal dashboard to track your impact
          and manage your donation history securely.
        </p>
      </div>

      <div class="step-item">
        <div class="step-circle">2</div>
        <h3 class="step-title">Select a Category</h3>
        <p class="step-text">
          Browse through our diverse categories, from healthcare to education,
          to find the sector that resonates with you.
        </p>
      </div>

      <div class="step-item">
        <div class="step-circle">3</div>
        <h3 class="step-title">Choose a Cause</h3>
        <p class="step-text">
          Pick a specific fundraising campaign or individual story that you
          wish to support with your contribution.
        </p>
      </div>

      <div class="step-item">
        <div class="step-circle">4</div>
        <h3 class="step-title">Complete Donation</h3>
        <p class="step-text">
          Fill out the simple donation form, choose your payment method, and
          finalize your gift to create real change.
        </p>
      </div>
    </div>
  </section>

  <section class="causes-section">
    <div class="container">
      <div class="causes-header">
        <h2 class="home-title">Current causes</h2>
        <div>
          <a class="btn-green" href="causes.php">
            View All
            <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>

      <div class="causes-wrapper">

        <div class="causes-list">
          <?php foreach ($causes as $cause): ?>
            <div class="cause-card">
              <a href="cause-details.php?id=<?= $cause->getId() ?>">
                <div class="card-image">
                  <img src="<?= $cause->getImage() ?>" alt="<?= htmlspecialchars($cause->getTitle()) ?>" />
                </div>
                <div class="card-content">
                  <h3 class="card-title"><?= htmlspecialchars($cause->getTitle()) ?></h3>
                  <p class="card-description">
                    <?= htmlspecialchars(substr($cause->getDescription(), 0, 120)) ?>...
                  </p>
                  <div class="progress-bar-container">
                    <?php
                    $percent = ($cause->getRaisedAmount() / $cause->getGoalAmount()) * 100;
                    ?>
                    <div class="progress-bar" style="width: <?= $percent ?>%"></div>
                  </div>
                  <p class="fund-status">
                    $<?= number_format($cause->getRaisedAmount()) ?> /
                    <span class="goal">$<?= number_format($cause->getGoalAmount()) ?></span>
                  </p>
                  <p class="percentage"><?= round($percent) ?>%</p>
                </div>
              </a>
            </div>
          <?php endforeach; ?>

        </div>

      </div>
      <div class="navigation-arrows">
        <span class="arrow-btn prev-arrow">
          <i class="fas fa-arrow-left"></i>
        </span>
        <span class="arrow-btn next-arrow">
          <i class="fas fa-arrow-right"></i>
        </span>
      </div>
    </div>
  </section>

  <section class="trust-section">
    <div class="container">
      <h2 class="home-title">What Makes People Trust Us</h2>

      <div class="trust-cards">
        <div class="trust-card">
          <div class="icon-circle"><i class="fa-solid fa-lock"></i></div>
          <h3>100% Secure Payments</h3>
          <p>
            All transactions are processed with bank-level security and
            encryption.
          </p>
        </div>

        <div class="trust-card">
          <div class="icon-circle"><i class="fa-solid fa-clock"></i></div>
          <h3>Fast Withdrawals</h3>
          <p>Access funds quickly—processed within 2-3 business days.</p>
        </div>

        <div class="trust-card">
          <div class="icon-circle">
            <i class="fa-solid fa-credit-card"></i>
          </div>
          <h3>0% Platform Fee</h3>
          <p>
            We take 0% of your funds. You only pay small transaction fees - no
            surprises.
          </p>
        </div>

        <div class="trust-card">
          <div class="icon-circle">
            <i class="fa-duotone fa-solid fa-people-group"></i>
          </div>
          <h3>Dedicated Support</h3>
          <p>
            Our team is available 7 days a week to help you with your
            campaign.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="faq-section">
    <div class="container">
      <h2 class="home-title">Frequently Answered Questions</h2>
      <div class="faq-content">
        <div class="faq-list">
          <div class="faq-item">
            <div class="faq-question">
              <p>How will my donation help children in need?</p>
              <div class="plus-icon">
                <span class="plus">+</span>
              </div>
            </div>
            <div class="faq-answer">
              <p>
                Your donation helps provide school supplies, education
                support, food, and basic necessities to children from
                low-income families, giving them a better chance for a
                brighter future.
              </p>
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <p>Where does my donation go?</p>
              <div class="plus-icon">
                <span class="plus">+</span>
              </div>
            </div>
            <div class="faq-answer">
              <p>
                All donations are carefully used to support educational
                programs, school materials, meals, and essential aid for
                families facing financial difficulties.
              </p>
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <p>Is my donation safe and secure?</p>
              <div class="plus-icon">
                <span class="plus">+</span>
              </div>
            </div>
            <div class="faq-answer">
              <p>
                Yes, all donations are processed through secure and trusted
                platforms to ensure your personal and payment information is
                protected.
              </p>
            </div>
          </div>

          <div class="faq-item">
            <div class="faq-question">
              <p>Who can I contact if I have more questions?</p>
              <div class="plus-icon">
                <span class="plus">+</span>
              </div>
            </div>
            <div class="faq-answer">
              <p>
                You can reach out to us anytime through our contact page, and
                our team will be happy to assist you.
              </p>
            </div>
          </div>
        </div>

        <div class="faq-card">
          <div class="logo">
            <img class="default_logo" src="./images/logo2.png" alt="" />
          </div>

          <h3>Wanna talk before joining us ?</h3>
          <a
            class="btn-green"
            href="
            contact.php
            ">
            Get in Touch
          </a>
        </div>
      </div>
    </div>
  </section>

  <div class="container">
    <div class="last-section">
      <h1>Make someone's life by giving of yours.</h1>

      <div>
        <a href="donate.php" class="btn-yellow">Donate Now </a>
      </div>
    </div>
    <?php include('components/footer.php') ?>


</body>
<script src="./js/main.js"></script>
<script src="./js/causes.js"></script>
<script src="./js/home.js"></script>

</php>