<?php
session_start();
$currentPage = 'mymessages';

include_once './database/Database.php';
include_once './classes/User.php';
include_once './classes/Message.php';

if (!User::isLoggedIn()) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user']['id'];
$db = new Database();
$pdo = $db->getConnection();
$messageObj = new Message($pdo);

$adminReplies = $messageObj->getRepliesForUser($userId);

$selectedId = $_GET['message_id'] ?? ($adminReplies[0]['id'] ?? null);
$currentMsg = null;
if ($selectedId) {
    $currentMsg = $messageObj->getReplyByIdAndUser($selectedId, $userId);
}

if (isset($_GET['delete_id'])) {
    $idToDelete = $_GET['delete_id'];
    $messageObj->delete($idToDelete);
    header("Location: my-messages.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Messages</title>
    <link rel="stylesheet" href="./styles/header_footer.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/message.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <?php include('components/navigation.php'); ?>

    <div class="m-container">
        <div class="messagesWrapper" style="width: 90%;">
            <div class="messagesContainer">

                <div class="messagesSidebar">
                    <div class="sidebarHeader">
                        <h3>Inbox</h3>
                    </div>
                    <div class="messageList">
                        <?php if ($adminReplies): foreach ($adminReplies as $msg): ?>
                                <div class="messageItem <?= ($selectedId == $msg['id']) ? 'active' : '' ?>"
                                    onclick="window.location.href='my-messages.php?message_id=<?= $msg['id'] ?>'">
                                    <div class="msgUserImg">A</div>
                                    <div class="msgPreview">
                                        <div class="msgHeader">
                                            <strong>Admin</strong>
                                            <span class="msgTime"><?= date('h:i A', strtotime($msg['created_at'])) ?></span>
                                        </div>
                                        <p><?= htmlspecialchars($msg['subject']) ?></p>
                                    </div>
                                </div>
                            <?php endforeach;
                        else: ?>
                            <p style="padding: 20px;">No messages from Admin yet.</p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="messageContent">
                    <?php if ($currentMsg): ?>
                        <div class="contentHeader">
                            <div class="userInfo">
                                <div class="msgUserImg">A</div>
                                <div>
                                    <h4>Admin</h4>
                                    <p style="margin-top:5px;font-weight:bold;"><?= htmlspecialchars($currentMsg['subject']) ?></p>
                                </div>
                            </div>
                            <div class="contentActions">
                                <button class="btnSave" onclick="confirmDelete(<?= $currentMsg['id'] ?>)">Delete</button>
                            </div>
                        </div>

                        <div class="msgBody chatBody">
                            <div class="chatRow left">
                                <div class="chatBubble adminBubble">
                                    <?= nl2br(htmlspecialchars($currentMsg['reply'])) ?>
                                    <span class="chatTime">Admin</span>
                                </div>
                            </div>
                        </div>

                    <?php else: ?>
                        <div style="padding:40px; text-align:center;">
                            <h3>No messages from Admin yet</h3>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <?php include('components/footer.php'); ?>

    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this message?")) {
                window.location.href = "my-messages.php?delete_id=" + id;
            }
        }
    </script>
</body>

</html>