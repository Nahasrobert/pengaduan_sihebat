<?php
$title = "Tambah User";
include '../layouts/header.php';
include '../config.php';
$result = $conn->query("SELECT * FROM tbl_profil");
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Tambah Profil</h2>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- SweetAlert will be triggered based on the query parameter -->
      

        <form action="process_profil.php" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Visi</label>
        <input type="text" name="visi" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Misi</label>
        <input type="text" name="misi" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Perwali (PDF)</label>
        <input type="file" name="perwali" class="form-control" accept="application/pdf" required>
    </div>
    <div class="form-group">
        <label>SOP (PDF)</label>
        <input type="file" name="sop" class="form-control" accept="application/pdf" required>
    </div>
    <div class="form-group">
        <label>Manual Book (PDF)</label>
        <input type="file" name="manual_book" class="form-control" accept="application/pdf" required>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Nomor HP</label>
        <input type="text" name="nomor_hp" class="form-control" required>
    </div>
    <button type="submit" name="create" class="btn btn-success">Simpan</button>
</form>


    </div>
</div>

<?php include '../layouts/footer.php'; ?>