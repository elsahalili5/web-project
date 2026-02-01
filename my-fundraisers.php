<?php
session_start();
$currentPage = 'myfundraisers';

include_once './database/Database.php';
include_once './classes/User.php';
include_once './classes/Cause.php';
include_once './classes/Donation.php';

if (!User::isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user']['id'];

$db = new Database();
$pdo = $db->getConnection();

$causes = Cause::getByUser($pdo, $user_id);
$donationObj = new Donation($pdo);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Fundraisers</title>
    <link rel="stylesheet" href="./styles/header_footer.css">
    <link rel="stylesheet" href="./styles/myfundraisers.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
    <?php include('components/navigation.php'); ?>

    <div class="myfundraiser-container">

        <h1 class="page-title">My Fundraisers</h1>

        <?php if (empty($causes)): ?>
            <p style="text-align:center; color:#6b7280;">You have not created any fundraisers yet.</p>
        <?php else: ?>
            <?php foreach ($causes as $cause):
                $progress = ($cause->getGoalAmount() > 0) ? min(($cause->getRaisedAmount() / $cause->getGoalAmount()) * 100, 100) : 0;
                $allDonations = $donationObj->getByCause($cause->getId());
                $totalDonors = count($allDonations);
            ?>
                <div class="fundraiser-card">
                    <div class="fundraiser-left">
                        <img src="<?= htmlspecialchars($cause->getImage()) ?>" alt="<?= htmlspecialchars($cause->getTitle()) ?>">
                        <div class="fundraiser-info">
                            <h3><?= htmlspecialchars($cause->getTitle()) ?></h3>
                            <p><?= nl2br(htmlspecialchars($cause->getDescription())) ?></p>
                        </div>
                    </div>

                    <div class="fundraiser-right">
                        <div class="fundraiser-stats">
                            <div class="raised">€<?= number_format($cause->getRaisedAmount(), 2) ?> raised</div>
                            <div class="goal">Goal: €<?= number_format($cause->getGoalAmount(), 2) ?></div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: <?= $progress ?>%;"></div>
                            </div>
                        </div>

                        <div class="status">
                            <span class="material-symbols-outlined"><?= $cause->getStatus() === 'approved' ? 'check_circle' : 'hourglass_top' ?></span>
                            <span><?= ucfirst($cause->getStatus()) ?></span>
                        </div>



                        <div class="donors-clean">
                            <h4>Recent donors (<?= $totalDonors ?>)</h4>
                            <?php foreach ($allDonations as $donor): ?>
                                <div class="donor-card-clean">
                                    <div class="donor-icon-clean"><i class="fas fa-user-circle"></i></div>
                                    <div class="donor-info-clean">
                                        <div class="donor-name-clean"><?= htmlspecialchars($donor['first_name'] . ' ' . $donor['last_name']) ?></div>
                                        <div class="donor-amount-clean">€<?= number_format($donor['amount'], 2) ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>

    <?php include('components/footer.php'); ?>
</body>

</html>