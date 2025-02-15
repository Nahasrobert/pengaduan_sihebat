<?php
ob_start();
$title = "Data Pengaduan";
include '../config.php';
include '../layouts/header.php';

// Proses Verifikasi Status Pengaduan
if (isset($_POST['verif_id']) && isset($_POST['status_pengaduan']) && isset($_POST['keterangan'])) {
    $id_pengaduan = $_POST['verif_id'];
    $status_pengaduan = $_POST['status_pengaduan'];
    $keterangan = $_POST['keterangan'];

    if (empty($id_pengaduan) || empty($status_pengaduan) || empty($keterangan)) {
        header("Location: pengaduan.php?error=Status dan keterangan tidak boleh kosong");
        exit();
    }

    $stmt = $conn->prepare("UPDATE tbl_pengaduan SET status = ?, ket = ? WHERE id_pengaduan = ?");
    $stmt->bind_param("sss", $status_pengaduan, $keterangan, $id_pengaduan);

    if ($stmt->execute()) {
        header("Location: pengaduan.php?success=Status berhasil diperbarui");
    } else {
        header("Location: pengaduan.php?error=Gagal memperbarui status");
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Ambil data pengaduan
$result = $conn->query("SELECT tbl_pengaduan.*, tbl_perangkat_daerah.nama_perangkat_daerah, tbl_pegawai.nama FROM tbl_pengaduan 
    JOIN tbl_perangkat_daerah ON tbl_pengaduan.id_perangkat_daerah = tbl_perangkat_daerah.id_perangkat_daerah 
    JOIN tbl_pegawai ON tbl_pengaduan.id_pegawai = tbl_pegawai.id_pegawai");
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Data Pengaduan</h2>
                </div>
            </div>
        </div>

        <?php if (isset($_GET['success']) || isset($_GET['error'])) : ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                Swal.fire({
                    title: "<?= isset($_GET['success']) ? 'Berhasil!' : 'Gagal!' ?>",
                    text: "<?= isset($_GET['success']) ? $_GET['success'] : $_GET['error'] ?>",
                    icon: "<?= isset($_GET['success']) ? 'success' : 'error' ?>",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            </script>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head d-flex align-items-center justify-content-between">
                        <h2>Data Pengaduan</h2>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table id="tabel-data" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Pengaduan</th>
                                        <th>Deskripsi</th>
                                        <th>Nama Pegawai</th>
                                        <th>Nama Perangkat Daerah</th>
                                        <th>Status</th>
                                        <th>Nomor Pengaduan</th>
                                        <th>Foto Bukti</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['judul_pengaduan'] ?></td>
                                            <td><?= $row['deskripsi'] ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['nama_perangkat_daerah'] ?></td>
                                            <td>
                                                <?php if ($row['status'] == 'Selesai') : ?>
                                                    <span class="badge badge-success">Selesai</span>
                                                <?php elseif ($row['status'] == 'Ditolak') : ?>
                                                    <span class="badge badge-danger">Ditolak</span>
                                                <?php else : ?>
                                                    <span class="badge badge-secondary"><?= $row['status'] ?></span>
                                                <?php endif; ?>
                                            </td>

                                            <td><?= $row['nomor_pengaduan'] ?></td>
                                            <td>
                                                <a href="../<?= $row['foto_bukti'] ?>" target="_blank">
                                                    <img src="../<?= $row['foto_bukti'] ?>" width="50">
                                                </a>
                                            </td>
                                            <td><?= $row['ket'] ?></td>
                                            <td>
                                                <button class="btn btn-success verif-btn"
                                                    data-id="<?= $row['id_pengaduan'] ?>"
                                                    data-status="<?= $row['status'] ?>" data-ket="<?= $row['ket'] ?>"
                                                    data-toggle="modal" data-target="#verifModal">Verif</button>

                                                <form method="POST" action="hapus_pengaduan.php" class="delete-form"
                                                    onsubmit="return confirmDelete(event)">
                                                    <input type="hidden" name="id_pengaduan"
                                                        value="<?= $row['id_pengaduan'] ?>">
                                                    <button type="submit" class="btn btn-danger delete-btn">Hapus</button>
                                                </form>
                                            </td>



                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Verifikasi -->
<div class="modal fade" id="verifModal" tabindex="-1" role="dialog" aria-labelledby="verifModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifModalLabel">Verifikasi Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="hidden" name="verif_id" id="verif_id">
                    <p>Silakan pilih status pengaduan:</p>
                    <select class="form-control" name="status_pengaduan" required>
                        <option value="">Pilih Status</option>
                        <option value="Ditolak">Ditolak</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                    <p class="mt-3">Tambahkan keterangan:</p>
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Tangkap event klik tombol verifikasi dan masukkan ID & keterangan ke modal
    document.querySelectorAll('.verif-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('verif_id').value = this.getAttribute('data-id');
            document.getElementById('keterangan').value = this.getAttribute('data-ket');
        });
    });
</script>
<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const idPengaduan = this.getAttribute('data-id');

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data ini akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete_id').value = idPengaduan;
                    document.getElementById('deleteForm').submit();
                }
            });
        });
    });
</script>
<script>
    function confirmDelete(event) {
        event.preventDefault(); // Mencegah form langsung dikirim

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit(); // Submit form jika dikonfirmasi
            }
        });
    }
</script>

<?php include '../layouts/footer.php'; ?>