<?php
$title = 'Home Pengaduan SiHebat';
include 'header.php';
include 'config.php';

// Ambil daftar pegawai dan perangkat daerah dari database
$pegawaiQuery = $conn->query("SELECT tbl_pegawai.*,tbl_perangkat_daerah.* from tbl_pegawai
join tbl_perangkat_daerah on tbl_pegawai.id_perangkat_daerah = tbl_perangkat_daerah.id_perangkat_daerah ");
$perangkatQuery = $conn->query("SELECT id_perangkat_daerah, nama_perangkat_daerah FROM tbl_perangkat_daerah");
?>

<!-- Hero Section -->
<section id="hero" class="hero section dark-background">
    <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">
    <div class="container d-flex flex-column align-items-center">
        <h2 data-aos="fade-up" data-aos-delay="100">Form Pengaduan</h2>
    </div>
</section>

<!-- Form Pengaduan -->
<section id="contact" class="contact section">


    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <form action="proses_pengaduan.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nama Pegawai</label>
                <select name="id_pegawai" class="form-control" required>
                    <option value="">-- Pilih Pegawai --</option>
                    <?php while ($row = $pegawaiQuery->fetch_assoc()) { ?>
                        <option value="<?= $row['id_pegawai'] ?>"><?= $row['nama'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Perangkat Daerah</label>
                <select name="id_perangkat_daerah" class="form-control" required>
                    <option value="">-- Pilih Perangkat Daerah --</option>
                    <?php while ($row = $perangkatQuery->fetch_assoc()) { ?>
                        <option value="<?= $row['id_perangkat_daerah'] ?>"><?= $row['nama_perangkat_daerah'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Plat</label>
                <input type="text" name="no_plat" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul Pengaduan</label>
                <input type="text" name="judul_pengaduan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Bukti</label>
                <input type="file" name="foto_bukti" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
        </form>
    </div>
</section>

<?php include('footer.php'); ?>