<?php
include '../config.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tbl_admin WHERE id_admin = $id");
$user = $result->fetch_assoc();
include '../layouts/header.php';
?>


<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Ubah Data Admin</h2>
                </div>
            </div>
        </div>
        <form action="process.php" method="POST">
            <input type="hidden" name="id_admin" value="<?= $user['id_admin'] ?>">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
        </form>

    </div>
</div>
</div>
</div>
<?php include '../layouts/footer.php'; ?>