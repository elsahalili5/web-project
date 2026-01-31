<?php
include_once __DIR__ . '/../database/Database.php';
include_once __DIR__ . '/../classes/User.php';

$database = new Database();
$connection = $database->getConnection();
$user = new User($connection);

$message = '';
if (isset($_POST['confirm_delete'])) {
    $user->deleteUser((int)$_POST['delete_id']);
    $message = "User deleted successfully!";
}

if (isset($_POST['add_user'])) {
    $name = trim($_POST['name']);
    $surname = trim($_POST['surname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    if ($name && $surname && $email && $password && $role) {
        $res = $user->register($name, $surname, $email, $password, $role);
        if ($res === true) {
            $message = "User added successfully!";
        } else {
            $message = "Error: " . $res;
        }
    } else {
        $message = "All fields including role are required!";
    }
}

if (isset($_POST['edit_user'])) {
    $editUser = [
        'id' => $_POST['edit_id'],
        'name' => $_POST['edit_name'],
        'surname' => $_POST['edit_surname'],
        'email' => $_POST['edit_email'],
        'role' => $_POST['edit_role'] ?? ''
    ];
}

if (isset($_POST['update_user'])) {
    $name = trim($_POST['update_name']);
    $surname = trim($_POST['update_surname']);
    $email = trim($_POST['update_email']);
    $role = trim($_POST['update_role']);

    if ($name && $surname && $email && $role) {
        $res = $user->updateUser((int)$_POST['update_user_id'], $name, $surname, $email, $role);
        $message = $res ? "User updated successfully!" : "Error: Failed to update user.";
    } else {
        $message = "All fields are required!";
    }
}

$allUsers = $user->getAllUsers();
?>

<div class="table-box">

    <div class="table-header">
        <h2>Users</h2>
        <button class="btn-primary" onclick="openModal('addUserModal')">
            <i class="fa fa-plus"></i> Add User
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
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allUsers as $i => $u): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($u['name'] . ' ' . $u['surname']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['role']) ?></td>
                    <td><?= date('d/m/Y', strtotime($u['created_at'])) ?></td>
                    <td>
                        <form method="POST" style="display:inline">
                            <input type="hidden" name="edit_id" value="<?= $u['id'] ?>">
                            <input type="hidden" name="edit_name" value="<?= htmlspecialchars($u['name']) ?>">
                            <input type="hidden" name="edit_surname" value="<?= htmlspecialchars($u['surname']) ?>">
                            <input type="hidden" name="edit_email" value="<?= htmlspecialchars($u['email']) ?>">
                            <input type="hidden" name="edit_role" value="<?= htmlspecialchars($u['role']) ?>">
                            <button class="action-btn edit" name="edit_user">
                                <i class="fa fa-pen"></i>
                            </button>
                        </form>
                        <button type="button"
                            class="action-btn delete"
                            onclick="openDeleteModal(<?= $u['id'] ?>)">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div id="addUserModal" class="modal add-user-modal">
    <div class="modal-content">
        <h4>Add New User</h4>
        <form method="POST">
            <div class="form-group">
                <label>First name</label>
                <input name="name" required>
            </div>
            <div class="form-group">
                <label>Last name</label>
                <input name="surname" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="modal-buttons">
                <button type="button" class="cancel-btn" onclick="closeModal('addUserModal')">Cancel</button>
                <button class="btn-primary" name="add_user">Add</button>
            </div>
        </form>
    </div>
</div>

<?php if (isset($editUser)): ?>
    <div id="editUserModal" class="modal edit-user-modal" style="display:flex">
        <div class="modal-content">
            <h4>Edit User</h4>
            <form method="POST">
                <input type="hidden" name="update_user_id" value="<?= $editUser['id'] ?>">
                <div class="form-group">
                    <label>First name</label>
                    <input name="update_name" value="<?= htmlspecialchars($editUser['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Last name</label>
                    <input name="update_surname" value="<?= htmlspecialchars($editUser['surname']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="update_email" value="<?= htmlspecialchars($editUser['email']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="update_role" required>
                        <option value="">Select Role</option>
                        <option value="admin" <?= $editUser['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="editor" <?= $editUser['role'] == 'editor' ? 'selected' : '' ?>>Editor</option>
                        <option value="user" <?= $editUser['role'] == 'user' ? 'selected' : '' ?>>User</option>
                    </select>
                </div>
                <div class="modal-buttons">
                    <button type="button" class="cancel-btn" onclick="closeModal('editUserModal')">Cancel</button>
                    <button class="btn-primary" name="update_user">Update</button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<!-- Delete User Modal -->
<div id="deleteModal" class="modal delete-user-modal">
    <div class="modal-content">
        <div class="modal-icon">
            <i class="fa fa-trash"></i>
        </div>
        <h4>Delete User</h4>
        <p>Are you sure you want to delete this user?</p>
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
        openModal('deleteModal');
    }
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>