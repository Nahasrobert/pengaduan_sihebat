<?php
include '../config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data profil berdasarkan ID
$result = $conn->query("SELECT * FROM tbl_profil WHERE id_profil = $id");
$user = $result->fetch_assoc();

include '../layouts/header.php';
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Ubah Data Profil</h2>
                </div>
            </div>
        </div>
        
        <form action="process_profil.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_profil" value="<?= $user['id_profil'] ?>">

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" 
            value="<?= htmlspecialchars($user['nama'], ENT_QUOTES, 'UTF-8') ?>" required>
    </div>

    <div class="form-group">
        <label>Visi</label>
        <input type="text" name="visi" class="form-control" 
            value="<?= htmlspecialchars($user['visi'], ENT_QUOTES, 'UTF-8') ?>" required>
    </div>

    <div class="form-group">
        <label>Misi</label>
        <input type="text" name="misi" class="form-control" 
            value="<?= htmlspecialchars($user['misi'], ENT_QUOTES, 'UTF-8') ?>" required>
    </div>

    <!-- Upload Perwali -->
    <div class="form-group">
        <label>Perwali (PDF)</label>
        <input type="file" name="perwali" class="form-control" accept="application/pdf">
        <small>File saat ini: <a href="../uploads/<?= $user['perwali'] ?>" target="_blank"><?= $user['perwali'] ?></a></small>
    </div>

    <!-- Upload SOP -->
    <div class="form-group">
        <label>SOP (PDF)</label>
        <input type="file" name="sop" class="form-control" accept="application/pdf">
        <small>File saat ini: <a href="../uploads/<?= $user['sop'] ?>" target="_blank"><?= $user['sop'] ?></a></small>
    </div>

    <!-- Upload Manual Book -->
    <div class="form-group">
        <label>Manual Book (PDF)</label>
        <input type="file" name="manual_book" class="form-control" accept="application/pdf">
        <small>File saat ini: <a href="../uploads/<?= $user['manual_book'] ?>" target="_blank"><?= $user['manual_book'] ?></a></small>
    </div>
    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="keterangan" class="form-control" 
            value="<?= htmlspecialchars($user['keterangan'], ENT_QUOTES, 'UTF-8') ?>" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control" 
            value="<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>" required>
    </div>

    <div class="form-group">
        <label>Nomor HP</label>
        <input type="text" name="nomor_hp" class="form-control" 
            value="<?= htmlspecialchars($user['nomor_hp'], ENT_QUOTES, 'UTF-8') ?>" required>
    </div>

    <button type="submit" name="update" class="btn btn-warning">Update</button>
</form>

    </div>
</div>

<?php include '../layouts/footer.php'; ?>
