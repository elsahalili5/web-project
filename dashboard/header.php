<?php
session_start();
include_once __DIR__ . '/../database/Database.php';
include_once __DIR__ . '/../classes/User.php';

$database = new Database();
$connection = $database->getConnection();
$user = new User($connection);
?>

<div class="header">

    <div class="header-left">
        <div class="page-title">
            <h1>Dashboard</h1>
        </div>
    </div>
    <div class="header-right">

        <div class="profile">
            <div class="profile-pic">A</div>
            <div class="profile-info">
                <a href="dashboard.php?page=admin-profile"
                    class="<?= ($_GET['page'] ?? '') === 'admin-profile' ? 'active' : '' ?>">


                    <?= htmlspecialchars(User::getFullName()) ?>

                    <span><?= htmlspecialchars($_SESSION['user']['email']) ?></span>
                </a>

                </a>
            </div>
        </div>
    </div>
</div>