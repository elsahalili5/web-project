<?php
include_once __DIR__ . '/../database/Database.php';
include_once __DIR__ . '/../classes/Donation.php';

$database = new Database();
$connection = $database->getConnection();

$donationObj = new Donation($connection);
$allDonations = $donationObj->getAll();

// Fshirja
if (isset($_POST['confirm_delete']) && isset($_POST['delete_id'])) {
    $deleteId = intval($_POST['delete_id']);

    if ($donationObj->delete($deleteId)) {
        $message = "Donation deleted successfully.";
    } else {
        $message = "Error deleting donation.";
    }

    $allDonations = $donationObj->getAll();
}

// Shtimi i donacionit (opsional)
if (isset($_POST['add_donation'])) {
    $data = [
        'cause_id' => $_POST['cause_id'],
        'user_email' => $_POST['user_email'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'amount' => $_POST['amount'],
        'payment_method' => $_POST['payment_method'],
        'payment_status' => $_POST['payment_status'],
        'anonymous' => isset($_POST['anonymous']) ? 1 : 0
    ];

    if ($donationObj->create($data)) {
        $message = "Donation added successfully!";
        $allDonations = $donationObj->getAll();
        echo "<script>document.getElementById('add-donation-modal').style.display='none';</script>";
    } else {
        $message = "Error adding donation.";
    }
}
?>

<div class="table-box">
    <div class="table-header">
        <h2>Donations</h2>
        <button id="addDonationBtn" class="btn-primary">
            <i class="fa-solid fa-plus"></i> Add Donation
        </button>
        <?php if (isset($message)): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
    </div>

    <table class="custom-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Cause ID</th>
                <th>User Email</th>
                <th>Full Name</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Anonymous</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allDonations as $index => $d): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $d['cause_id'] ?></td>
                    <td><?= $d['user_email'] ?></td>
                    <td><?= $d['first_name'] . ' ' . $d['last_name'] ?></td>
                    <td>€<?= $d['amount'] ?></td>
                    <td><?= $d['payment_method'] ?></td>
                    <td><?= $d['payment_status'] ?></td>
                    <td><?= $d['anonymous'] ? 'Yes' : 'No' ?></td>
                    <td><?= date('d/m/Y', strtotime($d['donated_at'])) ?></td>
                    <td>
                        <button type="button" class="action-btn delete" data-id="<?= $d['id'] ?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Modal Fshirje -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <i class="fa-solid fa-triangle-exclamation modal-icon"></i>
            <h4>Are you sure you want to delete this donation?</h4>
            <p>This action cannot be undone.</p>
            <form method="POST" action="">
                <input type="hidden" name="delete_id" id="delete_id" value="">
                <div class="modal-buttons">
                    <button type="submit" name="confirm_delete" class="delete-btn">Delete</button>
                    <button type="button" class="cancel-btn" id="cancelDelete">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Shtimi (Opsional) -->
    <div id="add-donation-modal" class="add-user-modal">
        <div class="add-user-modal-content">
            <h4>Add New Donation</h4>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="cause_id">Cause ID</label>
                    <input type="number" name="cause_id" id="cause_id" required>
                </div>
                <div class="form-group">
                    <label for="user_email">User Email</label>
                    <input type="email" name="user_email" id="user_email" required>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name">
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" id="amount" required>
                </div>
                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <input type="text" name="payment_method" id="payment_method">
                </div>
                <div class="form-group">
                    <label for="payment_status">Payment Status</label>
                    <input type="text" name="payment_status" id="payment_status" value="Pending">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="anonymous" id="anonymous">
                    <label for="anonymous">Anonymous</label>
                </div>
                <div class="modal-buttons">
                    <button type="submit" name="add_donation" class="btn-primary">Add Donation</button>
                    <button type="button" class="cancel-btn" id="cancelAdd">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const deleteModal = document.getElementById('deleteModal');
    const deleteButtons = document.querySelectorAll('.action-btn.delete');
    const cancelBtn = document.getElementById('cancelDelete');
    const deleteIdInput = document.getElementById('delete_id');

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            deleteIdInput.value = btn.getAttribute('data-id');
            deleteModal.style.display = 'flex';
        });
    });

    cancelBtn.addEventListener('click', () => deleteModal.style.display = 'none');
    window.addEventListener('click', e => {
        if (e.target === deleteModal) deleteModal.style.display = 'none';
    });

    const addBtn = document.getElementById('addDonationBtn');
    const addModal = document.getElementById('add-donation-modal');
    const cancelAdd = document.getElementById('cancelAdd');

    addBtn.addEventListener('click', () => addModal.style.display = 'flex');