<?php
include_once __DIR__ . '/../database/Database.php';
include_once __DIR__ . '/../classes/Category.php';
include_once __DIR__ . '/../classes/CategoryDAO.php';

$database = new Database();
$connection = $database->getConnection();
$categoryDAO = new CategoryDAO($connection);

$message = '';

if (isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $icon = $_POST['icon'];

    $stmt = $connection->prepare("INSERT INTO categories (name, icon) VALUES (?, ?)");
    $stmt->execute([$name, $icon]);
    $message = "Category added successfully!";
}

if (isset($_POST['edit_category'])) {
    $id = (int)$_POST['id'];
    $name = $_POST['name'];
    $icon = $_POST['icon'];

    $stmt = $connection->prepare("UPDATE categories SET name=?, icon=? WHERE id=?");
    $stmt->execute([$name, $icon, $id]);
    $message = "Category updated successfully!";
}

if (isset($_POST['delete_category'])) {
    $id = (int)$_POST['id'];
    $stmt = $connection->prepare("DELETE FROM categories WHERE id=?");
    $stmt->execute([$id]);
    $message = "Category deleted successfully!";
}

$allCategories = $categoryDAO->getAll();
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<div class="table-box">
    <div class="table-header">
        <h2>Categories</h2>
        <button class="btn-primary" onclick="openModal('addModal')"><i class="fa fa-plus"></i> Add Category</button>
    </div>

    <?php if ($message): ?>
        <p style="margin-bottom:12px;color:rgb(6,95,70);font-weight:500"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <table class="custom-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Icon</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allCategories as $i => $cat): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><i class="fa-solid <?= htmlspecialchars($cat->getIcon()) ?>"></i></td>
                    <td><?= htmlspecialchars($cat->getName()) ?></td>
                    <td>
                        <button class="action-btn edit" onclick="openEditModal(<?= $cat->getId() ?>,'<?= htmlspecialchars($cat->getName()) ?>','<?= htmlspecialchars($cat->getIcon()) ?>')"><i class="fa fa-pen"></i></button>
                        <button class="action-btn delete" onclick="openDeleteModal(<?= $cat->getId() ?>)"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div id="addModal" class="modal add-user-modal">
    <div class="modal-content">
        <h4>Add Category</h4>
        <form method="POST">
            <div class="form-group">
                <label for="add_name">Category Name</label>
                <input type="text" id="add_name" name="name" placeholder="Category Name" required>
            </div>
            <div class="form-group">
                <label for="add_icon">Icon class</label>
                <input type="text" id="add_icon" name="icon" placeholder="fa-heart-pulse" required>
            </div>
            <div class="modal-buttons">
                <button type="button" class="cancel-btn" onclick="closeModal('addModal')">Cancel</button>
                <button type="submit" name="add_category" class="btn-primary">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="editModal" class="modal edit-user-modal">
    <div class="modal-content">
        <h4>Edit Category</h4>
        <form method="POST">
            <input type="hidden" name="id" id="edit_id">
            <div class="form-group">
                <label for="edit_name">Category Name</label>
                <input type="text" id="edit_name" name="name" required>
            </div>
            <div class="form-group">
                <label for="edit_icon">Icon class</label>
                <input type="text" id="edit_icon" name="icon" required>
            </div>
            <div class="modal-buttons">
                <button type="button" class="cancel-btn" onclick="closeModal('editModal')">Cancel</button>
                <button type="submit" name="edit_category" class="btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
<div id="deleteModal" class="modal delete-user-modal">
    <div class="modal-content">
        <h4>Delete Category</h4>
        <p>Are you sure?</p>
        <form method="POST">
            <input type="hidden" name="id" id="delete_id">
            <div class="modal-buttons">
                <button type="button" class="cancel-btn" onclick="closeModal('deleteModal')">Cancel</button>
                <button type="submit" name="delete_category" class="delete-btn">Delete</button>
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

    function openEditModal(id, name, icon) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_icon').value = icon;
        openModal('editModal');
    }

    function openDeleteModal(id) {
        document.getElementById('delete_id').value = id;
        openModal('deleteModal');
    }

    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', e => {
            if (e.target === modal) modal.style.display = 'none';
        });
    });
</script>