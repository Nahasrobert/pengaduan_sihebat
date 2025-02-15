<?php
$title = 'Hasil Pengaduan';
include 'header.php';
include 'config.php';

$nomor_pengaduan = $_GET['nomor_pengaduan'] ?? null;
$pengaduan = null;

if ($nomor_pengaduan) {
    // Ambil data pengaduan
    $query = "SELECT * FROM tbl_pengaduan WHERE nomor_pengaduan = '$nomor_pengaduan'";
    $result = $conn->query($query);
    $pengaduan = $result->fetch_assoc();
}

?>

<section id="hero" class="hero section dark-background">
    <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">
    <div class="container d-flex flex-column align-items-center">
        <h2>Hasil Pengaduan</h2>

        <?php if ($pengaduan): ?>
            <table class="table table-bordered table-striped mt-3">
                <tr>
                    <th style="width: 30%;">Nomor Pengaduan</th>
                    <td><?= htmlspecialchars($pengaduan['nomor_pengaduan']) ?></td>
                </tr>
                <tr>
                    <th>Plat Kendaraan</th>
                    <td><?= htmlspecialchars($pengaduan['no_plat']) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <button class="btn 
        <?php if ($pengaduan['status'] == 'Selesai') : ?>
            btn-success
        <?php elseif ($pengaduan['status'] == 'Ditolak') : ?>
            btn-danger
        <?php else : ?>
            btn-warning
        <?php endif; ?>
    ">
                            <?= htmlspecialchars($pengaduan['status']) ?>
                        </button>
                    </td>

                </tr>
                <tr>
                    <th>Ket</th>
                    <td><?= !empty($pengaduan['ket']) ? htmlspecialchars($pengaduan['ket']) : '-' ?></td>
                </tr>

                <tr>
                    <th>Judul Pengaduan</th>
                    <td><?= htmlspecialchars($pengaduan['judul_pengaduan']) ?></td>
                </tr>
                <tr>
                    <th>Deskripsi</th>
                    <td><?= htmlspecialchars($pengaduan['deskripsi']) ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p class="text-danger mt-3"><strong>Data Tidak Ditemukan!</strong> Nomor pengaduan yang Anda masukkan tidak
                valid atau tidak ditemukan.</p>
        <?php endif; ?>

        <a href="tracking.php" class="btn btn-primary mt-3">Cek Pengaduan Lain</a>
    </div>
</section>

<?php include('footer.php'); ?>