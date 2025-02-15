<?php
$title = "Data Users";
include '../config.php';
include '../layouts/header.php';

$result = $conn->query("SELECT * FROM tbl_admin");

?>
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Data Admin</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head d-flex align-items-center justify-content-between">
                        <div class="heading1 margin_0">
                            <h2>Data Admin</h2>
                        </div>
                        <a href="create.php" class="btn btn-success ms-auto">Tambah User</a>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table id="tabel-data" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1; // Inisialisasi nomor urut
                                    while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td> <!-- Nomor urut otomatis -->
                                            <td><?= $row['username'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['password'] ?></td>
                                            <td><?= $row['role'] ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="User Actions">
                                                    <a href="edit.php?id=<?= $row['id_admin'] ?>"
                                                        class="btn btn-warning">Edit</a>
                                                    <!-- Use JavaScript for delete confirmation -->
                                                    <a href="#" class="btn btn-danger delete-btn"
                                                        data-id="<?= $row['id_admin'] ?>">Hapus</a>
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
                    window.location.href = `process.php?id=${userId}`;
                }
            });
        });
    });
</script>

<?php include '../layouts/footer.php'; ?>