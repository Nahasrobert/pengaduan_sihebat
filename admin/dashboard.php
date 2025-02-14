<?php
$title = "Beranda | Admin";
include '../config.php'; // Pastikan koneksi database disertakan
include '../layouts/header.php';

// Mengambil jumlah  (user dengan role pelapor)
$jumlah_pd = $conn->query("SELECT COUNT(*) AS total FROM tbl_perangkat_daerah ")->fetch_assoc()['total'];

// Mengambil jumlah tiket yang dibuat oleh pelapor
$jumlah_pengaduan = $conn->query("SELECT COUNT(*) AS total FROM tbl_pengaduan 
                                    ")->fetch_assoc()['total'];

// Mengambil jumlah tiket dalam proses
$jumlah_pegawai = $conn->query("SELECT COUNT(*) AS total FROM tbl_pegawai 
                                    ")->fetch_assoc()['total'];




?>

<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-6 col-lg-4">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div><i class="fa fa-users yellow_color"></i></div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no"><?= number_format($jumlah_pd) ?></p>
                            <p class="head_couter">Jumlah Instansi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div><i class="fa fa-ticket blue1_color"></i></div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no"><?= number_format($jumlah_pengaduan) ?></p>
                            <p class="head_couter">Jumlah Pengaduan</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="full counter_section margin_bottom_30">
                    <div class="couter_icon">
                        <div><i class="fa fa-spinner red_color"></i></div>
                    </div>
                    <div class="counter_no">
                        <div>
                            <p class="total_no"><?= number_format($jumlah_pegawai) ?></p>
                            <p class="head_couter">Jumlah Pegawai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('ticketChart').getContext('2d');
        var ticketChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($data_labels) ?>,
                datasets: [{
                        label: 'Jumlah Tiket (Bar)',
                        data: <?= json_encode($data_values) ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Jumlah Tiket (Line)',
                        data: <?= json_encode($data_values) ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 2,
                        type: 'line',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <?php include '../layouts/footer.php'; ?>