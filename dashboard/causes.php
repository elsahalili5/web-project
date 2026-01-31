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
        <p style="margin-bottom:12px;color:red">
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allCauses as $i => $c): ?>
                <?php
                $user = $userObj->getUserById($c->getUserId()); // You need a getUserById method
                $userName = $user ? $user['name'] . ' ' . $user['surname'] : 'Unknown';
                ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($c->getTitle()) ?></td>
                    <td><?= htmlspecialchars($userName) ?></td>
                    <td><?= htmlspecialchars($c->getCategoryId()) ?></td>
                    <td>$<?= $c->getRaisedAmount() ?> / $<?= $c->getGoalAmount() ?></td>
                    <td><?= htmlspecialchars($c->getStatus()) ?></td>
                    <td><?= date('d/m/Y', strtotime($c->getCreatedAt())) ?></td>
                    <td>
                        <form method="POST" style="display:inline">
                            <input type="hidden" name="edit_id" value="<?= $c->getId() ?>">
                            <button class="action-btn edit" name="edit_cause">
                                <i class="fa fa-pen"></i>
                            </button>
                        </form>
                        <button type="button"
                            class="action-btn delete"
                            onclick="openDeleteModal(<?= $c->getId() ?>)">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fa fa-trash"></i>
        </div>
        <h4>Delete Cause</h4>
        <p>Are you sure you want to delete this cause?</p>
        <form method="POST">
            <input type="hidden" name="delete_id" id="deleteUserId">
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
        document.getElementById('deleteUserId').value = id;
        document.getElementById('deleteModal').style.display = 'flex';
    }

    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target === modal) modal.style.display = 'none';
        });
    });
</script>