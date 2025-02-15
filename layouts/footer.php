<!-- footer -->
<div class="footer">
    <p class="powered">&copy; <?= date("Y"); ?> | <strong>Pengaduan SiHebat</strong>. All Rights Reserved<br>
        <span>Powered by</span> <a href="https://tapaleukprogrammer.com/" target="_blank">Pengaduan SiHebat</a>
    </p>
</div>
</div>
</div>
<!-- end dashboard inner -->
</div>
</div>
</div>
<style>
    .footer {

        text-align: center;
        padding: 20px;
        background: #222;
        color: #ff5722;
        /* Warna teks utama (misalnya oranye) */
        font-size: 14px;
        font-weight: bold;
    }

    .footer a {
        color: #ff5722;
        /* Warna link tetap oranye */
        text-decoration: none;
        font-weight: bold;
    }

    .footer a:hover {
        text-decoration: underline;
    }

    .footer .powered {
        color: #ffffff;
        /* Warna putih khusus untuk teks "Powered by" */
    }
</style>
<!-- jQuery -->
<!-- <script src="js/jquery.min.js"></script> -->
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!-- wow animation -->
<script src="../js/animate.js"></script>
<!-- select country -->
<script src="../js/bootstrap-select.js"></script>
<!-- owl carousel -->
<script src="../js/owl.carousel.js"></script>
<!-- chart js -->
<script src="../js/Chart.min.js"></script>
<script src="../js/Chart.bundle.min.js"></script>
<script src="../js/utils.js"></script>
<script src="../js/analyser.js"></script>
<!-- nice scrollbar -->
<script src="../js/perfect-scrollbar.min.js"></script>
<script>
    var ps = new PerfectScrollbar('#sidebar');
</script>
<!-- custom js -->
<script src="../js/custom.js"></script>
<script src="../js/chart_custom_style1.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.7.1/jszip.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tabel-data').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [10, 25, 50, 100],
            "dom": 'Bfrtip',
            "buttons": [{
                    extend: 'pdf',
                    title: 'Data Tabel',
                    filename: 'data_tabel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    title: 'Data Tabel',
                    filename: 'data_tabel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'csv',
                    title: 'Data Tabel',
                    filename: 'data_tabel',
                    exportOptions: {
                        columns: ':visible'
                    }
                }
            ]
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (isset($_GET['status'])): ?>
    <script>
        // Check if the 'status' parameter is success or error
        <?php if ($_GET['status'] == 'success'): ?>
            // Check which action was performed
            <?php if (isset($_GET['action']) && $_GET['action'] == 'tambah'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil ditambahkan.',
                    confirmButtonText: 'OK'
                });
            <?php elseif (isset($_GET['action']) && $_GET['action'] == 'ubah'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil diubah.',
                    confirmButtonText: 'OK'
                });
            <?php elseif (isset($_GET['action']) && $_GET['action'] == 'hapus'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil dihapus.',
                    confirmButtonText: 'OK'
                });
            <?php else: ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil diproses.',
                    confirmButtonText: 'OK'
                });
            <?php endif; ?>
        <?php elseif ($_GET['status'] == 'error'): ?>
            // Show general error message
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Silakan coba lagi nanti.',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>

        // Check for duplicate phone number error
        <?php if (isset($_GET['error']) && $_GET['error'] == 'duplicate'): ?>
            Swal.fire({
                icon: 'error',
                title: 'Nomor HP Sudah Terdaftar!',
                text: 'Silakan gunakan nomor HP lain.',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>
<?php endif; ?>
</body>

</html>