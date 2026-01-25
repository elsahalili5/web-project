  <div class="header-container">
      <header>
          <div class="container">
              <nav class="navbar">
                  <div class="logo">
                      <a
                          href="home.html
            ">
                          <img class="default_logo" src="./images/logo2.png" alt="" />
                      </a>
                  </div>

                  <div class="hamburger" id="menu-toggle">
                      <i class="fas fa-bars"></i>
                  </div>
                  <div class="left-nav" id="menu-item">

                      <ul>
                          <li><a href="home.php" class="<?php echo ($currentPage == 'home') ? 'active' : '' ?>">Home</a></li>
                          <li><a href="about.php" class="<?php echo ($currentPage == 'about') ? 'active' : '' ?>">About</a></li>
                          <li><a href="causes.php" class="<?php echo ($currentPage == 'causes') ? 'active' : '' ?>">Causes</a></li>
                          <li><a href="fundraise.php" class="<?php echo ($currentPage == 'fundraise') ? 'active' : '' ?>">Fundraise</a></li>
                          <li><a href="contact.php" class="<?php echo ($currentPage == 'contact') ? 'active' : '' ?>">Contact</a></li>
                          <li class="mobile-only">
                              <a href="./login.php" class="btn-green">Sign Up</a>
                          </li>
                      </ul>

                  </div>

                  <div class="right-nav" id="menu-item-right">
                      <a href="./login.php" class="btn-green">Sign Up</a>

                  </div>
              </nav>
          </div>
      </header>
  </div>