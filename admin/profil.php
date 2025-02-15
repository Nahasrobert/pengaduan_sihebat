<?php
ob_start(); // Menangani output buffering
$title = "Data Profil";
include '../config.php';
include '../layouts/header.php';

// Proses Hapus Data
if (isset($_POST['delete_id'])) {
    $id_profil = $_POST['delete_id'];

    if (empty($id_profil)) {
        header("Location: profil.php?error=ID tiket tidak ditemukan");
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM tbl_profil WHERE id_profil$id_profil = ?");
    $stmt->bind_param("s", $id_profil);

    if ($stmt->execute()) {
        header("Location: profil.php?success=Data berhasil dihapus");
    } else {
        header("Location: profil.php?error=Gagal menghapus data");
    }

    $stmt->close();
    $conn->close();
    exit();
}

// Ambil data users 
$result = $conn->query("SELECT tbl_profil.* from tbl_profil");
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Data Profil</h2>
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
                            <h2>Data Profil</h2>
                        </div>
                        <a href="create_profil.php" class="btn btn-success ms-auto">Tambah Profil</a>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table id="tabel-data" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Visi</th>
                                        <th>Misi</th>
                                        <th>Perwali</th>
                                        <th>SOP</th>
                                        <th>Manual Book</th>
                                        <th>Keterangan</th>
                                        <th>Email</th>
                                        <th>Nomor HP</th>
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
                                            <td><?= $row['visi'] ?></td>
                                            <td><?= $row['misi'] ?></td>
                                            <td><a href="../uploads/<?= $row['perwali'] ?>" target="_blank">Lihat PDF</a>
                                            </td>
                                            <td><a href="../uploads/<?= $row['sop'] ?>" target="_blank">Lihat PDF</a></td>
                                            <td><a href="../uploads/<?= $row['manual_book'] ?>" target="_blank">Lihat
                                                    PDF</a></td>
                                            <td><?= $row['keterangan'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['nomor_hp'] ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="edit_profil.php?id=<?= $row['id_profil'] ?>"
                                                        class="btn btn-warning">Edit</a>
                                                    <form action="process_profil.php" method="POST"
                                                        class="d-inline delete-form">
                                                        <input type="hidden" name="delete_id"
                                                            value="<?= $row['id_profil'] ?>">
                                                        <button type="submit" name="delete" class="btn btn-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                            Hapus
                                                        </button>
                                                    </form>
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
                    window.location.href = `process_profil.php?id=${userId}`;
                }
            });
        });
    });
</script>

<?php include '../layouts/footer.php'; ?>