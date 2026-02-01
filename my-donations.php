<?php
session_start();
$currentPage = 'mydonations';

include_once './database/Database.php';
include_once './classes/User.php';
include_once './classes/Donation.php';
include_once './classes/Cause.php';

if (!User::isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$user_email = $_SESSION['user']['email'];

$db = new Database();
$pdo = $db->getConnection();

$donationObj = new Donation($pdo);
$myDonations = $donationObj->getByUser($user_email);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Donations</title>

    <link rel="stylesheet" href="./styles/header_footer.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/my-donations.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


</head>

<body>

    <?php include('components/navigation.php'); ?>
    <div class="container">
        <div class="main-banner">

            <div class="my-donations-container">
                <h1 class="page-title">My Donations</h1>

                <?php if (empty($myDonations)): ?>
                    <div class="no-donations">
                        <i class="fas fa-heart-broken" style="font-size:2rem;color:#ccc;"></i>
                        <p>You haven't made any donations yet.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($myDonations as $donation):
                        $cause = Cause::getById($pdo, $donation['cause_id']);
                        if (!$cause) continue; // në rast se kauza u fshi
                    ?>
                        <div class="donation-card">
                            <div class="donation-left">
                                <img src="<?= htmlspecialchars($cause->image) ?>" alt="<?= htmlspecialchars($cause->title) ?>">
                                <div class="donation-info">
                                    <h4><?= htmlspecialchars($cause->title) ?></h4>
                                    <p>
                                        <?= $donation['anonymous'] ? '<span class="anonymous">Anonymous</span>' : htmlspecialchars($donation['first_name'] . ' ' . $donation['last_name']) ?>
                                    </p>
                                    <p style="font-size:0.8rem;color:#888;">
                                        <?= date('M d, Y', strtotime($donation['donated_at'])) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="donation-right">
                                <div class="amount">€<?= number_format($donation['amount'], 2) ?></div>
                                <div class="status">
                                    <i class="fas fa-heart"></i> <?= ucfirst($donation['payment_status']) ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>


    <?php include('components/footer.php'); ?>

</body>

</html>