<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticket_id = $_POST['ticket_id'];
    $kominfo_id = $_POST['kominfo_id'];

    $stmt = $conn->prepare("UPDATE tickets SET kominfo_id = ?, status = 'verifikasi' WHERE ticket_id = ?");
    $stmt->bind_param("ii", $kominfo_id, $ticket_id);

    if ($stmt->execute()) {
        echo "Laporan berhasil diverifikasi!";
    } else {
        echo "Gagal verifikasi laporan: " . $conn->error;
    }

    $stmt->close();
}
