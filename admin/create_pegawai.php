<?php
$title = "Tambah User";
include '../layouts/header.php';
include '../config.php';
$result = $conn->query("SELECT * FROM tbl_perangkat_daerah");
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Tambah Pegawai</h2>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- SweetAlert will be triggered based on the query parameter -->
      

        <form action="process_pegawai.php" method="POST">
            <div class="form-group">
                <label>Nama Pegawai</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nip/Nrp</label>
                <input type="text" name="nip_nrp" class="form-control" required>
            </div>
           <div class="form-group">
                <label>No Telepon</label>
                <input type="text" name="nomor_telpon" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nama Instansi</label>
                <select class="form-control" name="id_perangkat_daerah" id="pilihan">
    <option value="">-- Pilih --</option>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id_perangkat_daerah'] . "'>" . $row['nama_perangkat_daerah'] . "</option>";
    }
    ?>
</select>
            </div>
            
            
            <button type="submit" name="create" class="btn btn-success">Simpan</button>
        </form>

    </div>
</div>

<?php include '../layouts/footer.php'; ?>