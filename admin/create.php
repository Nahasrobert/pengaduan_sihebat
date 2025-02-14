<?php
$title = "Tambah User";
include '../layouts/header.php';
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Tambah Admin</h2>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- SweetAlert will be triggered based on the query parameter -->
      

        <form action="process.php" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option disabled value="">-- Silahkan Pilih Role --</option>
                
                    <option value="admin">Admin</option>
                    
                </select>
            </div>
            
            <button type="submit" name="create" class="btn btn-success">Simpan</button>
        </form>

    </div>
</div>

<?php include '../layouts/footer.php'; ?>