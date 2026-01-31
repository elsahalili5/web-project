<aside class="sidebar">

    <div class="logo">
        <img class="default_logo" src="../images/logo2.png" alt="Logo" />
    </div>



    <div class="menu-title">MENU</div>
    <div class="menu">
        <a href="dashboard.php?page=dashboard_home" class="<?= ($_GET['page'] ?? '') === 'dashboard_home' ? 'active' : '' ?>">
            <i class="fa-solid fa-table-columns"></i> Dashboard
        </a>
        <a href="dashboard.php?page=users" class="<?= ($_GET['page'] ?? '') === 'users' ? 'active' : '' ?>">
            <i class="fa-solid fa-users"></i> Users
        </a>
        <a href="dashboard.php?page=donations" class="<?= ($_GET['page'] ?? '') === 'donations' ? 'active' : '' ?>">
            <i class="fas fa-hand-holding-heart"></i>
            Donations
        </a>
        <a href="dashboard.php?page=causes" class="<?= ($_GET['page'] ?? '') === 'causes' ? 'active' : '' ?>">
            <i class="fas fa-bullhorn"></i>



            Causes
        </a>
        <a href="dashboard.php?page=categories" class="<?= ($_GET['page'] ?? '') === 'categories' ? 'active' : '' ?>">
            <i class="fa-solid fa-chart-line"></i> Categories
        </a>
        <a href="dashboard.php?page=messages" class="<?= ($_GET['page'] ?? '') === 'messages' ? 'active' : '' ?>">
            <i class="fa-regular fa-envelope"></i> Messages
        </a>
    </div>

    <div class="menu-title" style="margin-top:30px;">GENERAL</div>
    <div class="menu">
        <a href="#"><i class="fa-solid fa-gear"></i> Settings</a>
        <a href="#"><i class="fa-regular fa-circle-question"></i> Help</a>
        <a href="../logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
    </div>
</aside>