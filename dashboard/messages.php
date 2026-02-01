<?php
session_start();

include_once __DIR__ . '/../database/Database.php';
include_once __DIR__ . '/../classes/Message.php';

$db = new Database();
$conn = $db->getConnection();
$messageObj = new Message($conn);

$messages = $messageObj->getAll();
$selectedId = $_GET['message_id'] ?? ($messages[0]['id'] ?? null);

$currentMsg = null;
if ($selectedId) {
    $currentMsg = $messageObj->getById($selectedId);
}

if (isset($_POST['replySubmit'])) {
    $admin_id = $_SESSION['user']['id'] ?? 1;
    $receiver_id = $currentMsg['user_id'] ?? null;
    $subject = $_POST['subject'];
    $reply_text = $_POST['reply_text'];

    if (!empty($reply_text) && $receiver_id) {
        if ($messageObj->reply($currentMsg['id'], $reply_text)) {
            echo "<script>alert('Reply sent successfully!'); window.location.href='?page=messages&message_id={$currentMsg['id']}';</script>";
        } else {
            echo "<script>alert('Something went wrong!');</script>";
        }
    } else {
        echo "<script>alert('Please write a message!');</script>";
    }
}

if (isset($_GET['delete_id'])) {
    $idToDelete = $_GET['delete_id'];
    if ($messageObj->delete($idToDelete)) {
        echo "<script>alert('Message deleted!'); window.location.href='?page=messages';</script>";
    } else {
        echo "<script>alert('Something went wrong!');</script>";
    }
}
?>


<div class="messagesWrapper">
    <div class="messagesContainer">
        <div class="messagesSidebar">
            <div class="sidebarHeader">
                <h3>Inbox</h3>
            </div>
            <div class="messageList">
                <?php if ($messages): foreach ($messages as $msg): ?>
                        <div class="messageItem <?= ($selectedId == $msg['id']) ? 'active' : '' ?> <?= ($msg['reply'] == '' ? 'unread' : '') ?>"
                            onclick="window.location.href='?page=messages&message_id=<?= $msg['id'] ?>'">

                            <div class="msgUserImg">
                                <?= strtoupper(substr($msg['name'], 0, 1)) ?>
                            </div>
                            <div class="msgPreview">
                                <div class="msgHeader">
                                    <strong><?= htmlspecialchars($msg['name']) ?></strong>
                                    <span class="msgTime"><?= date('h:i A', strtotime($msg['created_at'])) ?></span>
                                </div>
                                <p><?= htmlspecialchars($msg['subject']) ?></p>
                            </div>
                        </div>
                    <?php endforeach;
                else: ?>
                    <p style="padding: 20px;">There is no message.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="messageContent">
            <?php if ($currentMsg): ?>
                <div class="contentHeader">
                    <div class="userInfo">
                        <div class="msgUserImg"><?= strtoupper(substr($currentMsg['name'], 0, 1)) ?></div>
                        <div>
                            <h4><?= htmlspecialchars($currentMsg['name']) ?></h4>
                            <small><?= htmlspecialchars($currentMsg['email']) ?></small>
                            <p style="margin-top:5px;font-weight:bold;"><?= htmlspecialchars($currentMsg['subject']) ?></p>
                        </div>
                    </div>
                    <div class="contentActions">
                        <button class="btnSave" onclick="openReplyModal()">Reply</button>
                        <button class="btnSave" onclick="confirmDelete(<?= $currentMsg['id'] ?>)">Delete</button>
                    </div>
                </div>
                <div class="msgBody chatBody">

                    <div class="chatRow left">
                        <div class="chatBubble userBubble">
                            <?= nl2br(htmlspecialchars($currentMsg['message'])) ?>
                            <span class="chatTime">
                                <?= date('H:i', strtotime($currentMsg['created_at'])) ?>
                            </span>
                        </div>
                    </div>

                    <?php if (!empty($currentMsg['reply'])): ?>
                        <div class="chatRow right">
                            <div class="chatBubble adminBubble">
                                <?= nl2br(htmlspecialchars($currentMsg['reply'])) ?>
                                <span class="chatTime">Admin</span>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

            <?php else: ?>
                <div style="padding:40px; text-align:center;">
                    <h3>Choose a message to read</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="replyModal" class="modal">
    <div class="modalContent">
        <div class="modalHeader">
            <h3>Reply to: <?= htmlspecialchars($currentMsg['name'] ?? '') ?></h3>
            <span class="closeBtn" onclick="closeReplyModal()">×</span>
        </div>
        <form method="POST">
            <div class="formGrid">
                <input type="hidden" name="message_id" value="<?= $currentMsg['id'] ?? '' ?>">
                <div class="inputGroup fullWidth">
                    <label>Subject</label>
                    <input type="text" name="subject" value="Re: <?= htmlspecialchars($currentMsg['subject'] ?? '') ?>">
                </div>
                <div class="inputGroup fullWidth">
                    <label>Message</label>
                    <textarea name="reply_text" rows="6" placeholder="Type your reply here..." style="width:100%; border:1px solid #ddd; border-radius:8px; padding:10px;"></textarea>
                </div>
            </div>
            <div class="modalFooter">
                <button type="button" class="btnCancel" onclick="closeReplyModal()">Cancel</button>
                <button type="submit" name="replySubmit" class="btnSave">Send Reply</button>
            </div>
        </form>
    </div>
</div>

<script>
    const replyModal = document.getElementById("replyModal");

    function openReplyModal() {
        replyModal.style.display = "flex";
    }

    function closeReplyModal() {
        replyModal.style.display = "none";
    }

    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this message?")) {
            window.location.href = "?page=messages&delete_id=" + id;
        }
    }

    window.onclick = function(event) {
        if (event.target == replyModal) {
            closeReplyModal();
        }
    }
</script>