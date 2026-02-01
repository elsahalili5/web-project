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
    <link rel="stylesheet" href="./styles/donate.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <style>
        /* Formal Profile Page */
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
            border-radius: 8px;
            padding: 30px 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header h1 {
            margin: 0;
            font-size: 1.8em;
            color: #333333;
        }

        .profile-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .profile-form label {
            font-weight: 600;
            color: #555555;
            display: block;
            margin-bottom: 5px;
        }

        .profile-form input {
            width: 100%;
            padding: 10px 12px;
            font-size: 1em;
            border-radius: 5px;
            border: 1px solid #cccccc;
        }

        .profile-form button {
            background-color: #01715d;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .profile-form button:hover {
            background-color: #014f40;
        }

        .message {
            text-align: center;
            font-weight: 500;
            color: #01715d;
        }

        @media (max-width: 500px) {
            .profile-container {
                padding: 20px;
            }
        }
    </style>
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