<?php
include '../config.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tbl_perangkat_daerah WHERE id_perangkat_daerah = $id");
$user = $result->fetch_assoc();
include '../layouts/header.php';
?>


<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Ubah Data Instansi</h2>
                </div>
            </div>
        </div>
        <form action="process_instansi.php" method="POST">
            <input type="hidden" name="id_perangkat_daerah" value="<?= $user['id_perangkat_daerah'] ?>">
            <div class="form-group">
                <label>Nama Instansi</label>
                <input type="text" name="nama_perangkat_daerah" class="form-control" value="<?= $user['nama_perangkat_daerah'] ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
        </form>

    </div>
</div>
</div>
</div>
<?php include '../layouts/footer.php'; ?>