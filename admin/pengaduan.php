<?php
ob_start(); // Menangani output buffering
$title = "Data Pengaduan";
include '../config.php';
include '../layouts/header.php';

// Proses Hapus Data
if (isset($_POST['delete_id'])) {
    $id_pengaduan = $_POST['delete_id'];

    if (empty($id_pegawai)) {
        header("Location: pengaduan.php?error=ID tiket tidak ditemukan");
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM tbl_pengaduan WHERE id_pengaduan = ?");
    $stmt->bind_param("s", $id_pegawai);

    if ($stmt->execute()) {
        header("Location: pengaduan.php?success=Data berhasil dihapus");
    } else {
        header("Location: pengaduan.php?error=Gagal menghapus data");
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Ambil data users dan tickets
$result = $conn->query("SELECT tbl_pengaduan.*,tbl_perangkat_daerah.*,tbl_pegawai.* from tbl_pengaduan
join tbl_perangkat_daerah on tbl_pengaduan.id_perangkat_daerah = tbl_perangkat_daerah.id_perangkat_daerah
join tbl_pegawai on tbl_pengaduan.id_pegawai = tbl_pegawai.id_pegawai
 ");
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
                        <div class="heading1 margin_0">
                            <h2>Data Pengaduan</h2>
                        </div>
                    
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table id="tabel-data" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul Pengaduan</th>
                                        <th>Deskripsi</th>
                                        <th>Nama pegawai</th>
                                        <th>Nama Perangkat Daerah</th>
                                        <th>Status</th>
                                        <th>Nomor Pengaduan</th>
                                        <th>Foto Bukti</th>
                                         <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) {
                                        // Tentukan warna badge berdasarkan status tiket
                                    
                                    ?>
                                        <tr>
                                            <th>#<?= $row['id_pengaduan'] ?></th>
                                            <td><?= $row['judul_pengaduan'] ?></td>
                                            <td><?= $row['deskripsi'] ?></td>
                                            <td><?= $row['nama_pegawai'] ?></td>
                                            <td><?= $row['nama_perangkat_daerah'] ?></td>
                                            <td><?= $row['status'] ?></td>
                                            <td><?= $row['nomor_pengaduan'] ?></td>
                                            <td><?= $row['foto_bukti'] ?></td>
                                        
                                         
                                            <td>
                                            <div class="btn-group" role="group" aria-label="User Actions">
                                                <a href="edit_pengaduan.php?id=<?= $row['id_pengaduan'] ?>"
                                                    class="btn btn-warning"></a>
                                                <!-- Use JavaScript for delete confirmation -->
                                                <a href="#" class="btn btn-danger delete-btn"
                                                    data-id="<?= $row['id_pengaduan'] ?>">Hapus</a>
                                            </div>
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
<script>
// Attach event listener to delete buttons
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent the default action (navigation)

        const userId = this.getAttribute('data-id');

        // SweetAlert2 confirmation
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to process.php with the id_admin to delete
                window.location.href = `process_pengaduan.php?id=${userId}`;
            }
        });
    });
});
</script>

<?php include '../layouts/footer.php'; ?>