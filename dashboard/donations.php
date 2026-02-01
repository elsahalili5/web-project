<?php
include_once __DIR__ . '/../database/Database.php';
include_once __DIR__ . '/../classes/Donation.php';

$db = new Database();
$conn = $db->getConnection();
$donationObj = new Donation($conn);

$message = "";

if (isset($_POST['confirm_delete'])) {
    $donationObj->delete((int)$_POST['delete_id']);
    $message = "Donation deleted successfully!";
}

if (isset($_POST['edit_donation'])) {
    $editDonation = $_POST;
}

if (isset($_POST['update_donation'])) {
    $data = [
        'id' => $_POST['update_id'],
        'cause_id' => $_POST['update_cause_id'],
        'user_email' => $_POST['update_user_email'],
        'first_name' => $_POST['update_first_name'],
        'last_name' => $_POST['update_last_name'],
        'amount' => $_POST['update_amount'],
        'payment_method' => $_POST['update_payment_method'],
        'payment_status' => $_POST['update_payment_status'],
        'anonymous' => isset($_POST['update_anonymous']) ? 1 : 0
    ];

    if ($donationObj->update($data)) {
        $message = "Donation updated successfully!";
    }
}

$allDonations = $donationObj->getAll();
?>

<div class="table-box">
    <div class="table-header">
        <h2>Donations</h2>

    </div>

    <?php if ($message): ?>
        <p style="margin-bottom:10px;color:green"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <table class="custom-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Cause</th>
                <th>Email</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Anonymous</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allDonations as $i => $d): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($d['cause_id']) ?></td>
                    <td><?= htmlspecialchars($d['user_email']) ?></td>
                    <td><?= htmlspecialchars($d['first_name'] . ' ' . $d['last_name']) ?></td>
                    <td>€<?= number_format($d['amount'], 2) ?></td>
                    <td><?= htmlspecialchars($d['payment_status']) ?></td>
                    <td><?= $d['anonymous'] ? 'Yes' : 'No' ?></td>
                    <td><?= date('d/m/Y', strtotime($d['donated_at'])) ?></td>

                    <td>
                        <form method="POST" style="display:inline">
                            <?php foreach ($d as $k => $v): ?>
                                <input type="hidden" name="edit_<?= $k ?>" value="<?= htmlspecialchars($v) ?>">
                            <?php endforeach; ?>
                            <button class="action-btn edit" name="edit_donation">
                                <i class="fa fa-pen"></i>
                            </button>
                        </form>

                        <button class="action-btn delete"
                            onclick="openDeleteModal(<?= $d['id'] ?>)">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if (isset($editDonation)): ?>
    <div id="editDonationModal" class="modal edit-user-modal" style="display:flex">
        <div class="modal-content">
            <h4>Edit Donation</h4>

            <form method="POST">
                <input type="hidden" name="update_id" value="<?= $editDonation['edit_id'] ?>">
                <input type="hidden" name="update_cause_id" value="<?= $editDonation['edit_cause_id'] ?>">
                <input type="hidden" name="update_user_email" value="<?= $editDonation['edit_user_email'] ?>">
                <input type="hidden" name="update_first_name" value="<?= $editDonation['edit_first_name'] ?>">
                <input type="hidden" name="update_last_name" value="<?= $editDonation['edit_last_name'] ?>">
                <input type="hidden" name="update_anonymous" value="<?= $editDonation['edit_anonymous'] ?>">
                <input type="hidden" name="update_payment_method" value="<?= $editDonation['edit_payment_method'] ?>">

                <div class="form-group">
                    <label>Cause ID</label>
                    <input value="<?= $editDonation['edit_cause_id'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Donor Email</label>
                    <input value="<?= $editDonation['edit_user_email'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Donor Name</label>
                    <input value="<?= $editDonation['edit_first_name'] . ' ' . $editDonation['edit_last_name'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Anonymous</label>
                    <input value="<?= $editDonation['edit_anonymous'] ? 'Yes' : 'No' ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Amount (€)</label>
                    <input type="number" step="0.01" name="update_amount" value="<?= $editDonation['edit_amount'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Payment Method</label>
                    <input name="update_payment_method" value="<?= $editDonation['edit_payment_method'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label>Payment Status</label>
                    <select name="update_payment_status" required>
                        <option value="pending" <?= $editDonation['edit_payment_status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="successful" <?= $editDonation['edit_payment_status'] == 'successful' ? 'selected' : '' ?>>Successful</option>
                        <option value="failed" <?= $editDonation['edit_payment_status'] == 'failed' ? 'selected' : '' ?>>Failed</option>
                    </select>
                </div>

                <div class="modal-buttons">
                    <button type="button" class="cancel-btn" onclick="closeModal('editDonationModal')">Cancel</button>
                    <button class="btn-primary" name="update_donation">Update</button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>


<div id="deleteModal" class="modal delete-user-modal">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fa fa-trash"></i>
        </div>

        <h4>Delete Donation</h4>
        <p>Are you sure you want to delete this donation?</p>

        <form method="POST">
            <input type="hidden" name="delete_id" id="deleteDonationId">

            <div class="modal-buttons">
                <button type="button" class="cancel-btn"
                    onclick="closeModal('deleteModal')">
                    Cancel
                </button>
                <button class="delete-btn" name="confirm_delete">
                    Delete
                </button>
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
        document.getElementById('deleteDonationId').value = id;
        openModal('deleteModal');
    }
    document.querySelectorAll('.modal').forEach(m => {
        m.addEventListener('click', e => {
            if (e.target === m) m.style.display = 'none';
        });
    });
</script>