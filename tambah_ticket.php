<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $nomor_hp_pelapor = $_POST['nomor_hp'];
    $deskripsi = $_POST['deskripsi'];

    $stmt = $conn->prepare("INSERT INTO tickets (user_id, nomor_hp_pelapor, deskripsi, status) VALUES (?, ?, ?, 'baru')");
    $stmt->bind_param("iss", $user_id, $nomor_hp_pelapor, $deskripsi);

    if ($stmt->execute()) {
        echo "Laporan berhasil dikirim!";
    } else {
        echo "Gagal mengirim laporan: " . $conn->error;
    }

    $stmt->close();
}
