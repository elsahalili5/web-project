<?php
include_once __DIR__ . '/../database/Database.php';
include_once __DIR__ . '/../classes/User.php';

$database = new Database();
$connection = $database->getConnection();

$user = new User($connection);
$allUsers = $user->getAllUsers();
if (isset($_POST['confirm_delete']) && isset($_POST['delete_id'])) {
    $deleteId = intval($_POST['delete_id']);

    if ($user->deleteUser($deleteId)) {
        $message = "User deleted successfully.";
    } else {
        $message = "Error deleting user.";
    }

    $allUsers = $user->getAllUsers();
}
if (isset($_POST['add_user'])) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $result = $user->register($name, $surname, $email, $password);

    if ($result === true) {
        $message = "User added successfully!";
        // Rifresko listen e user-ave
        $allUsers = $user->getAllUsers();
        // Mbyll modal-in automatikisht
        echo "<script>document.getElementById('add-user-modal').style.display='none';</script>";
    } else {
        $message = $result; // shfaq gabimet
    }
}

?>
<div class="table-box">
    <div class="table-header">
        <h2>Users</h2>
        <button id="addUserBtn" class="btn-primary">
            <i class="fa-solid fa-plus"></i> Add User
        </button>
        <?php if (isset($message)): ?>
            <div class="message">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
    </div>

    <table class="custom-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allUsers as $index => $u): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $u['name'] . ' ' . $u['surname'] ?></td>
                    <td><?= $u['email'] ?></td>
                    <td><?= date('d/m/Y', strtotime($u['created_at'])) ?></td>
                    <td>
                        <button class="action-btn edit"> <i class="fa-solid fa-pen"></i> </button>
                        <button type="button" class="action-btn delete" data-userid="<?= $u['id'] ?>">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>



    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <i class="fa-solid fa-triangle-exclamation modal-icon"></i>
            <h4>Are you sure you want to delete this user?</h4>

            <p>
                This action cannot be undone.</p>
            <form method="POST" action="">
                <input type="hidden" name="delete_id" id="delete_id" value="">
                <div class="modal-buttons">
                    <button type="submit" name="confirm_delete" class="delete-btn">Delete</button>
                    <button type="button" class="cancel-btn" id="cancelDelete">Cancel</button>
                </div>
            </form>
        </div>
    </div>



    <div id="addUserModal" class="add-user-modal">
        <div class="add-user-modal-content">
            <h4>Add New User</h4>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="surname">Last Name</label>
                    <input type="text" name="surname" id="surname" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="modal-buttons">
                    <button type="submit" name="add_user" class="btn-primary">Add User</button>
                    <button type="button" class="cancel-btn" id="cancelAdd">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('deleteModal');
    const deleteButtons = document.querySelectorAll('.action-btn.delete');
    const cancelBtn = document.getElementById('cancelDelete');
    const deleteIdInput = document.getElementById('delete_id');

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const userId = btn.getAttribute('data-userid');
            deleteIdInput.value = userId;
            modal.style.display = 'flex';
        });
    });
    cancelBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });



    const addUserBtn = document.getElementById('addUserBtn');
    const addUserModal = document.getElementById('addUserModal');
    const cancelAdd = document.getElementById('cancelAdd');

    addUserBtn.addEventListener('click', () => {
        addUserModal.style.display = 'flex';
    });

    cancelAdd.addEventListener('click', () => {
        addUserModal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === addUserModal) {
            addUserModal.style.display = 'none';
        }
    });
</script>