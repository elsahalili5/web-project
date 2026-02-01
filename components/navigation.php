<?php
require_once "./classes/User.php";
include_once './database/Database.php';
include_once './classes/Message.php';

$userName = '';
$replyCount = 0;

if (User::isLoggedIn()) {
    $userName = User::getFullName();

    if (!User::isAdmin()) {
        $db = new Database();
        $pdo = $db->getConnection();
        $messageObj = new Message($pdo);
        $userId = $_SESSION['user']['id'];
        $adminReplies = $messageObj->getRepliesForUser($userId);
        $replyCount = count($adminReplies);
    }
}
?>
<div class="header-container">
    <header>
        <div class="container">
            <nav class="navbar">
                <div class="logo">
                    <a href="home.php">
                        <img class="default_logo" src="./images/logo2.png" alt="Logo" />
                    </a>
                </div>

                <div class="hamburger" id="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>

                <div class="left-nav" id="menu-item">
                    <ul>
                        <li class="mobile-only">
                            <?php if (User::isLoggedIn()): ?>
                                <ul>
                                    <li><span class="user-name"><?= htmlspecialchars($userName) ?></span></li>
                                    <li><a href="my-fundraisers.php">My fundraisers</a></li>
                                    <li><a href="my-donations.php">My donations</a></li>
                                </ul>
                            <?php endif; ?>
                        </li>

                        <li><a href="home.php" class="<?= ($currentPage == 'home') ? 'active' : '' ?>">Home</a></li>
                        <li><a href="about.php" class="<?= ($currentPage == 'about') ? 'active' : '' ?>">About</a></li>
                        <li><a href="causes.php" class="<?= ($currentPage == 'causes') ? 'active' : '' ?>">Causes</a></li>
                        <li><a href="fundraise.php" class="<?= ($currentPage == 'fundraise') ? 'active' : '' ?>">Fundraise</a></li>
                        <?php if (User::isLoggedIn() && !User::isAdmin()): ?>
                            <li><a href="contact.php" class="<?= ($currentPage == 'contact') ? 'active' : '' ?>">Contact</a></li>
                        <?php endif; ?>

                        <li class="mobile-only">
                            <?php if (User::isLoggedIn()): ?>
                                <ul>
                                    <li><a href="./logout.php" class="btn-green">Sign out</a></li>
                                </ul>
                            <?php else: ?>
                                <a href="login.php" class="btn-green">Sign Up</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>

                <div class="right-nav" id="menu-item-right">

                    <?php if (User::isLoggedIn()): ?>
                        <?php if (!User::isAdmin()): ?>
                            <button class="icon-btn message-btn" title="Messages">
                                <a href="my-messages.php" style="position: relative;">
                                    <i class="fa-regular fa-envelope"></i>
                                    <?php if ($replyCount > 0): ?>
                                        <span class="badge" style="
                                         
                                        ">
                                            <?= $replyCount ?>
                                        </span>
                                    <?php endif; ?>
                                </a>
                            </button>
                        <?php endif; ?>

                        <!-- Dropdown user -->
                        <div class="user-dropdown">
                            <div class="dropdown-toggle">
                                <span class="user-icon-circle">
                                    <i class="fa-regular fa-user"></i>
                                </span>
                                <span class="user-name"><?= htmlspecialchars($userName) ?></span>
                                <i class="fa-solid fa-chevron-down arrow"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <?php if (!User::isAdmin()): ?>
                                    <li><a href="profile.php">Profile</a></li>
                                    <li><a href="my-fundraisers.php">My fundraisers</a></li>
                                    <li><a href="my-donations.php">My donations</a></li>
                                <?php else: ?>
                                    <li><a href="dashboard.php">Go to Dashboard</a></li>
                                <?php endif; ?>
                                <li><a href="./logout.php" class="btn-red">Sign out</a></li>
                            </ul>
                        </div>

                    <?php else: ?>
                        <a href="login.php" class="btn-green">Sign Up</a>
                    <?php endif; ?>

                </div>
            </nav>
        </div>
    </header>
</div>

<script>
    const toggle = document.querySelector('.dropdown-toggle');
    const menu = document.querySelector('.dropdown-menu');
    const arrow = document.querySelector('.arrow');

    toggle.addEventListener('click', e => {
        e.stopPropagation();
        const isOpen = menu.style.display === 'block';
        menu.style.display = isOpen ? 'none' : 'block';
        arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
    });

    document.addEventListener('click', () => {
        menu.style.display = 'none';
        arrow.style.transform = 'rotate(0deg)';
    });
</script>