<?php
include '../config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data pegawai berdasarkan ID
$result = $conn->query("SELECT tbl_pegawai.*, tbl_perangkat_daerah.nama_perangkat_daerah FROM tbl_pegawai 
JOIN tbl_perangkat_daerah ON tbl_pegawai.id_perangkat_daerah = tbl_perangkat_daerah.id_perangkat_daerah  
WHERE id_pegawai = $id");

$user = $result->fetch_assoc();

// Ambil semua perangkat daerah
$perangkat_daerah = $conn->query("SELECT * FROM tbl_perangkat_daerah");

include '../layouts/header.php';
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Ubah Data Pegawai</h2>
                </div>
            </div>
        </div>
        
        <form action="process_pegawai.php" method="POST">
            <input type="hidden" name="id_pegawai" value="<?= $user['id_pegawai'] ?>">
            
            <div class="form-group">
                <label>Nama Pegawai</label>
                <input type="text" name="nama" class="form-control" 
                    value="<?= htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="form-group">
                <label>NIP/NRP</label>
                <input type="text" name="nip_nrp" class="form-control" 
                    value="<?= htmlspecialchars($user['nip_nrp'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="form-group">
                <label>No Telepon</label>
                <input type="text" name="nomor_telpon" class="form-control" 
                    value="<?= htmlspecialchars($user['nomor_telpon'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>

            <div class="form-group">
                <label>Nama Perangkat Daerah</label>
                <select name="id_perangkat_daerah" class="form-control" required>
                    <option value="">-- Pilih Perangkat Daerah --</option>
                    <?php while ($row = $perangkat_daerah->fetch_assoc()) { ?>
                        <option value="<?= $row['id_perangkat_daerah']; ?>" 
                            <?= ($user['id_perangkat_daerah'] == $row['id_perangkat_daerah']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($row['nama_perangkat_daerah'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" name="update" class="btn btn-warning">Update</button>
        </form>
    </div>
</div>

<?php include '../layouts/footer.php'; ?>
