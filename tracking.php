<?php
$title = 'Tracking Pengaduan';
include 'header.php';
include 'config.php';

$pengaduan = null;

if (isset($_GET['nomor_pengaduan'])) {
    $nomor_pengaduan = $_GET['nomor_pengaduan'];

    // Ambil data pengaduan
    $query = "SELECT * FROM tbl_pengaduan WHERE nomor_pengaduan = '$nomor_pengaduan'";
    $result = $conn->query($query);
    $pengaduan = $result->fetch_assoc();
}
?>

<section id="hero" class="hero section dark-background">
    <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">
    <div class="container d-flex flex-column align-items-center">
        <div class="container">
            <h2>Cek Status Pengaduan</h2>
            <form action="hasil_pengaduan.php" method="GET">
                <div class="mb-3">
                    <label class="form-label">Masukkan Nomor Pengaduan</label>
                    <input type="text" name="nomor_pengaduan" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Cek Status</button>
            </form>
        </div>
    </div>
</section>


<?php include('footer.php'); ?>