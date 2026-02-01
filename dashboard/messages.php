<?php
session_start();

include_once __DIR__ . '/../database/Database.php';
include_once __DIR__ . '/../classes/Donation.php';
include_once __DIR__ . '/../classes/Cause.php';

$db = new Database();
$conn = $db->getConnection();
$donationObj = new Donation($conn);

$messageObj = new Message($db);
$messages = $messageObj->getAll();
?>
<div class="admin-messages-container">
    <div class="admin-messages">


        <div class="inbox">
            <h3>Inbox</h3>
            <?php foreach ($messages as $msg): ?>
                <div class="inbox-item"
                    onclick="openMessage(
                    '<?= htmlspecialchars($msg['name']) ?>',
                    '<?= htmlspecialchars($msg['email']) ?>',
                    '<?= htmlspecialchars($msg['subject']) ?>',
                    '<?= nl2br(htmlspecialchars($msg['message'])) ?>',
                    <?= $msg['id'] ?>,
                    '<?= htmlspecialchars($msg['reply']) ?>'
                 )">
                    <div class="avatar"><?= strtoupper(substr($msg['name'], 0, 1)) ?></div>
                    <div>
                        <strong><?= htmlspecialchars($msg['name']) ?></strong>
                        <p><?= htmlspecialchars($msg['subject']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        <div class="message-view" id="messageView">
            <p class="empty">Zgjedh një mesazh për ta parë</p>
        </div>

    </div>
</div>


<div class="message-modal" id="replyModal">
    <div class="modal-content">
        <h3>Reply to User</h3>
        <form method="POST">
            <input type="hidden" name="message_id" id="replyMessageId">
            <label>Subject</label>
            <input type="text" id="replySubject" disabled>
            <label>Message</label>
            <textarea name="reply" required></textarea>
            <div class="modal-actions">
                <button type="button" onclick="closeModal()">Cancel</button>
                <button type="submit" name="send_reply">Send Reply</button>
            </div>
        </form>
    </div>
</div>