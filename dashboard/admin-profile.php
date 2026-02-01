<?php
session_start();

include_once __DIR__ . '/../database/Database.php';
include_once __DIR__ . '/../classes/User.php';

$db = new Database();
$conn = $db->getConnection();
$userObj = new User($conn);

$adminId = $_SESSION['user']['id'];
$admin = $userObj->getUserById($adminId);

$message = '';
$success = false;

if (isset($_POST['update_profile'])) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);

    if ($name && $surname && $email) {
        $res = $userObj->updateUser($adminId, $name, $surname, $email);

        if ($res) {
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['surname'] = $surname;
            $_SESSION['user']['email'] = $email;

            $success = true;
            $message = "Profile updated successfully!";
        } else {
            $message = "Failed to update profile.";
        }
    } else {
        $message = "All fields are required!";
    }
}
?>


<div class="profile-container">
    <div class="profile-header">
        <h1>My Profile</h1>
    </div>

    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <form method="POST" class="profile-form" style="max-width:500px; margin:0 auto;">
        <div style="display:flex; gap:15px; margin-bottom:20px;">
            <div style="flex:1;">
                <label for="name">First Name</label>
                <input id="name" name="name" value="<?= htmlspecialchars($admin['name']) ?>" required>
            </div>
            <div style="flex:1;">
                <label for="surname">Last Name</label>
                <input id="surname" name="surname" value="<?= htmlspecialchars($admin['surname']) ?>" required>
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($admin['email']) ?>" required>
        </div>

        <button name="update_profile">Save Changes</button>
    </form>
</div>