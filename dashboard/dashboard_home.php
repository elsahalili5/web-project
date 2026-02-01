<?php
include_once __DIR__ . '/../database/Database.php';
include_once __DIR__ . '/../classes/Cause.php';
include_once __DIR__ . '/../classes/User.php';
include_once __DIR__ . '/../classes/Donation.php';

$database = new Database();
$pdo = $database->getConnection();

$donation = new Donation($pdo);
$totalDonations = count($donation->getAll());

$totalAmount = $donation->getTotalAmount();

$user = new User($pdo);
$totalUsers = count($user->getAllUsers());

$activeCauses = Cause::getApprovedCount($pdo);
?>

<div class="db-home">

    <div class="dashboard-stats">
        <div class="stat-card primary">
            <div class="stat-top">
                <span>Total Donations</span>
            </div>
            <div class="stat-value"><?= $totalDonations ?></div>
            <div class="stat-desc">Increased from last month</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span>Total Money</span>
            </div>
            <div class="stat-value">$<?= number_format($totalAmount) ?></div>
            <div class="stat-desc">Total donated amount</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span>Total Users</span>
            </div>
            <div class="stat-value"><?= $totalUsers ?></div>
            <div class="stat-desc">Registered users</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span>Active Causes</span>
            </div>
            <div class="stat-value"><?= $activeCauses ?></div>
            <div class="stat-desc">Approved causes</div>
        </div>
    </div>
</div>