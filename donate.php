<?php
$currentPage = 'causes';
session_start();
include_once __DIR__ . '/database/Database.php';
include_once __DIR__ . '/classes/Donation.php';

$database = new Database();
$conn = $database->getConnection();

$donation = new Donation($conn);
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [
    'cause_id' => 1,
    'user_email' => trim($_POST['email']),
    'first_name' => trim($_POST['firstName']),
    'last_name' => trim($_POST['lastName']),
    'amount' => floatval($_POST['amount']),
    'payment_method' => 'Card',
    'payment_status' => 'Pending',
    'anonymous' => isset($_POST['anonymous']) ? 1 : 0
  ];

  if ($donation->create($data)) {
    $message = "Thank you! Your donation has been recorded.";
  } else {
    $message = "Error! Donation could not be recorded.";
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./styles/header_footer.css" />
  <link rel="stylesheet" href="./styles/style.css" />
  <link rel="stylesheet" href="./styles/donate.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
</head>

<body>
  <?php include('components/navigation.php') ?>


  <section class="donate-section">
    <div class="donation-container">
      <p class="cause-title">
        Support Sienna's Recovery From a Rare Brain Condition❤️
      </p>
      <p class="subtitle">Still €153,801 to go. Help us build momentum.</p>
      <form method="post" id="donationForm">
        <div class="amount-result"></div>

        <h3 class="amount-title">Amount</h3>

        <div class="amount">
          <span>€</span>
          <input type="number" id="amountInput" name="amount" min="0" />
        </div>

        <h3 class="payment-title">Payment method</h3>
        <div class="payment-section">
          <div class="payment-method">
            <i class="fa-regular fa-credit-card"></i>
            <p>Credit or debit</p>
          </div>

          <div class="result"></div>

          <div class="card-form">
            <input placeholder="Email address" name="email" class="full" />

            <div class="row">
              <input type="text" placeholder="First name" name="firstName" />
              <input type="text" placeholder="Last name" name="lastName" />
            </div>
            <div class=" anonymous-checkbox">
              <input type="checkbox" id="anonymous" name="anonymous" class="anonymous" value="1" class="checkbox-input">
              <label for="anonymous" class="checkbox-label">
                Don’t display my name publicly on the fundraiser.
              </label>
            </div>


            <input
              type="text"
              placeholder="Card number"
              name="cardNumber"
              class="full"
              pattern="\d{13,19}" />

            <div class="row">
              <input type="month" placeholder="MM / YY" name="expireDate" />
              <input
                type="number"
                placeholder="CVV"
                name="cvv"
                min="100"
                max="999" />
            </div>

            <input
              type="text"
              placeholder="Name on card"
              name="cardName"
              class="full" />

            <div class="row">
              <select name="country">
                <option>Kosovo</option>
              </select>
              <input
                type="number"
                placeholder="Postal code"
                name="postalCode" />
            </div>
          </div>
        </div>

        <div class="total">
          <p>Your donation <span id="donationTotal">€0.00</span></p>
        </div>
        <button class="donate-btn" type="submit">Donate now</button>
      </form>
    </div>
  </section>
  <?php include('components/footer.php') ?>

  <script src="./js/donate.js"></script>
  <script src="./js/main.js"></script>
</body>

</html>