<?php


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard UI</title>
    <link rel="stylesheet" href="../styles/style.css" />
    <link rel="stylesheet" href="../styles/dashboard.css" />
    <link rel="stylesheet" href="../styles/dbhome.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="dashboard">

            <?php include 'sidebar.php'; ?>
            <main class="main">
                <?php include 'header.php'; ?>

                <div class="content">
                    <?php
                    $page = $_GET['page'] ?? 'dashboard_home';
                    $allowed_pages = ['dashboard_home', 'users', 'causes', 'donations', 'messages', 'categories'];

                    if (in_array($page, $allowed_pages)) {
                        include "$page.php";
                    } else {
                        echo "<h2>Page not found!</h2>";
                    }

                    ?>
                </div>
            </main>

        </div>
    </div>
</body>

</html>