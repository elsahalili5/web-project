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
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    />
  </head>
  <body>
    <div class="header-container">
      <header>
        <div class="container">
          <nav class="navbar">
            <div class="logo">
              <a
                href="home.html
            "
              >
                <img class="default_logo" src="./images/logo2.png" alt="" />
              </a>
            </div>

            <div class="hamburger" id="menu-toggle">
              <i class="fas fa-bars"></i>
            </div>
            <div class="left-nav" id="menu-item">
              <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="causes.html" class="active">Causes</a></li>
                <li><a href="fundraise.html">Fundraise</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li class="mobile-only">
                  <a href="login.html" class="btn-green">Sign Up</a>
                </li>
              </ul>
            </div>

            <div class="right-nav" id="menu-item-right">
              <a href="login.html" class="btn-green">Sign Up</a>
            </div>
          </nav>
        </div>
      </header>
    </div>
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
            src="https://i.pinimg.com/736x/dc/97/dc/dc97dcba38c3476817f9e5568e1b7037.jpg"
          />
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
                  src="https://images.gofundme.com/nLnMdFjvwlR0jNeqxabZCmmIRmg=/720x405/https://d2g8igdw686xgo.cloudfront.net/97509371_1765262773517765_r.jpg"
                />
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
                alt="Child cancer patient in hospital bed"
              />
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
                src="https://i.pinimg.com/1200x/37/ac/7e/37ac7efdfef8f4d8aff459783d49bf8a.jpg"
              />
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
                src="https://i.pinimg.com/736x/7a/e3/69/7ae3694ca7fa17245862448520ad9d49.jpg"
              />
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
    <footer>
      <div class="container">
        <div class="footer">
          <div class="footer-left">
            <div class="logo">
              <img src="./images/logo2.png" alt="" />
            </div>
          </div>
          <div class="footer-right">
            <ul>
              <li>
                <a href="#" class="icon-link"
                  ><i class="fab fa-facebook-f"></i
                ></a>
              </li>

              <li>
                <a href="#" class="icon-link"><i class="fab fa-twitter"></i></a>
              </li>

              <li>
                <a href="#" class="icon-link"
                  ><i class="fab fa-instagram"></i
                ></a>
              </li>

              <li>
                <a href="#" class="icon-link"
                  ><i class="fab fa-linkedin-in"></i
                ></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div></div>
      <div class="footer-copyright">
        <p>
          Copyright &copy; 2025 Elsa Halili & Eriona Bunjaku. All Rights
          Reserved
        </p>
      </div>
    </footer>
  </body>
  <script src="./js/donate.js"></script>
  <script src="./js/main.js"></script>
</html>
