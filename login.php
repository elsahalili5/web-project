<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="styles/login.css" rel="stylesheet" />
    <link href="styles/style.css" rel="stylesheet" />
  </head>

  <body>
    <div class="container" id="container">
      <div class="form-container sign-up-container">
        <form method="post">
          <div id="result" class="result">
            <p id="result-p"></p>
          </div>

          <input
            id="inputFirstName"
            name="inputFirstName"
            type="text"
            placeholder="First Name"
          />
          <input
            id="inputLastName"
            name="inputLastName"
            type="text"
            placeholder="Last Name"
          />
          <input
            id="signupEmail"
            name="inputEmail"
            type="text"
            placeholder="Email"
          />
          <input
            id="signupPassword"
            name="inputPassword"
            type="password"
            placeholder="Create a password"
          />

          <input
            class="button btn-green"
            type="submit"
            name="submit"
            value="Sign Up"
          />
        </form>
      </div>

      <div class="form-container sign-in-container">
        <form class="signin-form" method="POST">
          <h1 class="sign-in">Sign in</h1>
          <div id="signin-result" class="signin-result">
            <p id="signin-result-p"></p>
          </div>

          <input
            id="signinEmail"
            name="inputEmail"
            type="email"
            placeholder="name@example.com"
          />
          <input
            id="signinPassword"
            name="inputPassword"
            type="password"
            placeholder="Password"
          />

          <input
            class="button btn-green"
            type="submit"
            name="submit"
            value="Sign in"
          />
        </form>
        <form>
          <button type="submit" class="btn-green">Login</button>
        </form>
      </div>
      <div class="wrapper">
        <div class="section">
          <div class="section-panel section-left">
            <h1>Welcome Back!</h1>
            <p>
              To keep connected with us please login with your personal info!
            </p>
            <button class="ghost" id="signIn">Sign In</button>
          </div>
          <div class="section-panel section-right">
            <h1>Start Your Journey.</h1>

            <p>Join the heart of giving!</p>

            <button class="ghost" id="signUp">Sign Up</button>
          </div>
        </div>
      </div>
    </div>

    <script src="./js/register.js"></script>
  </body>
</html>
