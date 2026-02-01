<?php
session_start();
$currentPage = 'profile';

include_once './database/Database.php';
include_once './classes/User.php';

if (!User::isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$db = new Database();
$pdo = $db->getConnection();
$userObj = new User($pdo);

$userId = $_SESSION['user']['id'];
$userData = $userObj->getUserById($userId);

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);

    if ($userObj->updateUser($userId, $name, $surname, $email)) {
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['surname'] = $surname;
        $_SESSION['user']['email'] = $email;
        $message = "Profile updated successfully!";
        $userData = $userObj->getUserById($userId);
    } else {
        $message = "Error updating profile!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="./styles/header_footer.css" />
    <link rel="stylesheet" href="./styles/style.css" />
    <link rel="stylesheet" href="./styles/profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

</head>

<body>

    <?php include('components/navigation.php'); ?>

    <div class="profile-container">
        <div class="profile-header">
            <h1>My Profile</h1>
        </div>

        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST" class="profile-form">
            <div>
                <label for="name">First Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($userData['name']) ?>" required>
            </div>

            <div>
                <label for="surname">Last Name</label>
                <input type="text" id="surname" name="surname" value="<?= htmlspecialchars($userData['surname']) ?>" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($userData['email']) ?>" required>
            </div>

            <button type="submit">Save Changes</button>
        </form>
    </div>

    <?php include('components/footer.php'); ?>

</body>

</html>