<?php
$title = "Tambah User";
include '../layouts/header.php';
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Tambah Instansi</h2>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- SweetAlert will be triggered based on the query parameter -->
      

        <form action="process_instansi.php" method="POST">
            <div class="form-group">
                <label>Nama Instansi</label>
                <input type="text" name="nama_perangkat_daerah" class="form-control" required>
            </div>
            
            <button type="submit" name="create" class="btn btn-success">Simpan</button>
        </form>

    </div>
</div>

<?php include '../layouts/footer.php'; ?>