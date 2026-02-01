<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include_once './database/Database.php';
include_once './classes/User.php';

$db = new Database();
$connection = $db->getConnection();
$user = new User($connection);
$signupError = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $user->register($name, $surname, $email, $password);

    if ($result === true) {
      header("Location: login.php");
      exit;
    } else {
      $signupError = $result;
    }
  }

  if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->login($email, $password)) {
      header("Location: home.php");
      exit;
    } else {
      $signinError = "Invalid login credentials!";
    }
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <link href="styles/login.css" rel="stylesheet" />
  <link href="styles/style.css" rel="stylesheet" />
</head>

<body>
  <div class="container" id="container">

    <!-- Signup formmm -->
    <div class="form-container sign-up-container">
      <form action="login.php" method="POST">
        <div id="result" class="result"
          style="color:red; visibility:<?php echo $signupError ? 'visible' : 'hidden'; ?>">
          <p id="result-p"><?php echo htmlspecialchars($signupError); ?></p>
        </div>
        <input
          id="inputFirstName"
          name="name"
          type="text"
          placeholder="First Name" />
        <input
          id="inputLastName"
          name="surname"
          type="text"
          placeholder="Last Name" />
        <input
          id="signupEmail"
          name="email"
          type="text"
          placeholder="Email" />
        <input
          id="signupPassword"
          name="password"
          type="password"
          placeholder="Create a password" />

        <input
          class="button btn-green"
          type="submit"
          name="signup"
          value="Sign Up" />
      </form>
    </div>


    <!-- Login form -->
    <div class="form-container sign-in-container">
      <form class="signin-form" action="login.php" method="POST">
        <h1 class="sign-in">Sign in here</h1>

        <div id="signin-result" class="signin-result"
          style="color:red; visibility:<?php echo !empty($signinError) ? 'visible' : 'hidden'; ?>">
          <p id="signin-result-p">
            <?php echo isset($signinError) ? htmlspecialchars($signinError) : ''; ?>
          </p>
        </div>

        <input
          id="signinEmail"
          name="email"
          type="email"
          placeholder="name@example.com" />
        <input
          id="signinPassword"
          name="password"
          type="password"
          placeholder="Password" />

        <input
          class="button btn-green"
          type="submit"
          name="signin"
          value="Sign in" />

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