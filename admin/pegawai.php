<?php
ob_start(); // Menangani output buffering
$title = "Data Pegawai";
include '../config.php';
include '../layouts/header.php';

// Proses Hapus Data
if (isset($_POST['delete_id'])) {
    $id_pegawai = $_POST['delete_id'];

    if (empty($id_pegawai)) {
        header("Location: pegawai.php?error=ID tiket tidak ditemukan");
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM tbl_pegawai WHERE id_pegawai = ?");
    $stmt->bind_param("s", $id_pegawai);

    if ($stmt->execute()) {
        header("Location: pegawai.php?success=Data berhasil dihapus");
    } else {
        header("Location: pegawai.php?error=Gagal menghapus data");
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Ambil data users dan tickets
$result = $conn->query("SELECT tbl_pegawai.*,tbl_perangkat_daerah.* from tbl_pegawai
join tbl_perangkat_daerah on tbl_pegawai.id_perangkat_daerah = tbl_perangkat_daerah.id_perangkat_daerah ");
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Data Pegawai</h2>
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
                            <h2>Data Pegawai</h2>
                        </div>
                        <a href="create_pegawai.php" class="btn btn-success ms-auto">Tambah Pegawai</a>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table id="tabel-data" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>Nip/Nrp</th>
                                        <th>No Telpon</th>
                                        <th>Nama Perangkat Daerah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1; // Inisialisasi nomor urut
                                    while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td> <!-- Tambahkan nomor urut -->
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['nip_nrp'] ?></td>
                                        <td><?= $row['nomor_telpon'] ?></td>
                                        <td><?= $row['nama_perangkat_daerah'] ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="User Actions">
                                                <a href="edit_pegawai.php?id=<?= $row['id_pegawai'] ?>"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="#" class="btn btn-danger delete-btn"
                                                    data-id="<?= $row['id_pegawai'] ?>">Hapus</a>
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
                window.location.href = `process_pegawai.php?id=${userId}`;
            }
        });
    });
});
</script>

<?php include '../layouts/footer.php'; ?>