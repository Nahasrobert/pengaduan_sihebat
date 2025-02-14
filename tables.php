<?php
$title = "Data Users";
include 'config.php';
include 'layouts/header.php';

$result = $conn->query("SELECT * FROM users");
?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Data Users</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="white_shd full margin_bottom_30">
                    <div class="full graph_head">
                        <div class="heading1 margin_0">
                            <h2>Data Users</h2>
                        </div>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <a href="create.php" class="btn btn-success">Tambah User</a>
                            <table id="tabel-data" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Nomor HP</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $row['user_id'] ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['nomor_hp'] ?></td>
                                            <td><?= $row['role'] ?></td>
                                            <td>
                                                <a href="edit.php?id=<?= $row['user_id'] ?>"
                                                    class="btn btn-warning">Edit</a>
                                                <a href="delete.php?id=<?= $row['user_id'] ?>" class="btn btn-danger"
                                                    onclick="return confirm('Hapus data?')">Hapus</a>
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

<?php include 'layouts/footer.php'; ?>