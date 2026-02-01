<?php
include_once __DIR__ . '/../database/Database.php';
include_once __DIR__ . '/../classes/Cause.php';
include_once __DIR__ . '/../classes/User.php';

$database = new Database();
$connection = $database->getConnection();

$message = '';

if (isset($_POST['confirm_delete'])) {
    $causeId = (int)$_POST['delete_id'];

    $stmt = $connection->prepare("DELETE FROM causes WHERE id = ?");
    $stmt->execute([$causeId]);

    $message = "Cause deleted successfully!";
}

if (isset($_POST['change_status'])) {
    $causeId = (int)$_POST['cause_id'];
    $newStatus = $_POST['new_status'];

    if (in_array($newStatus, ['approved', 'rejected', 'pending'])) {
        $stmt = $connection->prepare("UPDATE causes SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $causeId]);
        $message = "Cause status updated successfully!";
    } else {
        $message = "Invalid status!";
    }
}

$allCauses = Cause::getAllCauses($connection);
$userObj = new User($connection);
?>

<div class="table-box">
    <div class="table-header">
        <h2>Causes</h2>
        <button class="btn-primary" onclick="openModal('addCauseModal')">
            <i class="fa fa-plus"></i> Add Cause
        </button>
    </div>

    <?php if ($message): ?>
        <p style="margin-bottom:12px;color:rgb(6,95,70);font-weight:500">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php endif; ?>

    <table class="custom-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>User</th>
                <th>Category</th>
                <th>Raised / Goal</th>
                <th>Status</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($allCauses as $i => $c): ?>
                <?php
                $user = $userObj->getUserById($c->getUserId());
                $userName = $user ? $user['name'] . ' ' . $user['surname'] : 'Unknown';
                $status = $c->getStatus();

                $statusClass = match ($status) {
                    'approved' => 'status approved',
                    'rejected' => 'status rejected',
                    default => 'status pending',
                };

                $statusIcon = match ($status) {
                    'approved' => 'fa-check-circle',
                    'rejected' => 'fa-times-circle',
                    default => 'fa-clock',
                };
                ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($c->getTitle()) ?></td>
                    <td><?= htmlspecialchars($userName) ?></td>
                    <td><?= htmlspecialchars($c->getCategoryId()) ?></td>
                    <td>
                        $<?= number_format($c->getRaisedAmount()) ?> / $<?= number_format($c->getGoalAmount()) ?>
                    </td>

                    <td>
                        <span class="<?= $statusClass ?>">
                            <i class="fa <?= $statusIcon ?>"></i>
                            <?= ucfirst($status) ?>
                        </span>
                    </td>

                    <td><?= ($c->getCreatedAt()) ?></td>

                    <td class="actions">
                        <form method="POST" style="display:inline">
                            <input type="hidden" name="edit_id" value="<?= $c->getId() ?>">
                            <button class="action-btn edit" title="Edit">
                                <i class="fa fa-pen"></i>
                            </button>
                        </form>

                        <form method="POST" style="display:inline">
                            <input type="hidden" name="cause_id" value="<?= $c->getId() ?>">
                            <select class="status-select" name="new_status" onchange="this.form.submit()">
                                <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="approved" <?= $status === 'approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="rejected" <?= $status === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                            </select>
                            <input type="hidden" name="change_status" value="1">
                        </form>

                        <button
                            type="button"
                            class="action-btn delete"
                            title="Delete"
                            onclick="openDeleteModal(<?= $c->getId() ?>)">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fa fa-trash"></i>
        </div>
        <h4>Delete Cause</h4>
        <p>Are you sure you want to delete this cause?</p>
        <form method="POST">
            <input type="hidden" name="delete_id" id="deleteCauseId">
            <div class="modal-buttons">
                <button type="button" class="cancel-btn" onclick="closeModal('deleteModal')">Cancel</button>
                <button class="delete-btn" name="confirm_delete">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).style.display = 'flex';
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    function openDeleteModal(id) {
        document.getElementById('deleteCauseId').value = id;
        document.getElementById('deleteModal').style.display = 'flex';
    }

    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target === modal) modal.style.display = 'none';
        });
    });
</script>

<style>
    .status-select {
        padding: 5px 10px;
        border-radius: 6px;
        border: none;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
    }
</style>