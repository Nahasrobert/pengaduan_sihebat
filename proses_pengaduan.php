<?php
include 'config.php';

// Ambil data dari form
$id_pegawai = $_POST['id_pegawai'];
$id_perangkat_daerah = $_POST['id_perangkat_daerah'];
$no_plat = $_POST['no_plat'];
$judul_pengaduan = $_POST['judul_pengaduan'];
$deskripsi = $_POST['deskripsi'];
$status = 'Diajukan';
$nomor_pengaduan = 'PND' . time(); // Buat nomor pengaduan unik

// Upload foto bukti
$foto_bukti = '';
if ($_FILES['foto_bukti']['name']) {
    $target_dir = "uploads/";
    $foto_bukti = $target_dir . basename($_FILES["foto_bukti"]["name"]);
    move_uploaded_file($_FILES["foto_bukti"]["tmp_name"], $foto_bukti);
}

// Simpan ke database
$query = "INSERT INTO tbl_pengaduan (id_pegawai, id_perangkat_daerah, no_plat, judul_pengaduan, deskripsi, status, nomor_pengaduan, foto_bukti) 
          VALUES ('$id_pegawai', '$id_perangkat_daerah', '$no_plat', '$judul_pengaduan', '$deskripsi', '$status', '$nomor_pengaduan', '$foto_bukti')";

if ($conn->query($query) === TRUE) {
    // Redirect ke halaman hasil pengaduan
    header("Location: hasil_pengaduan.php?nomor_pengaduan=" . $nomor_pengaduan);
    exit();
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
