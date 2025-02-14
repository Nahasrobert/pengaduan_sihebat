<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticket_id = $_POST['ticket_id'];
    $vendor_id = $_POST['vendor_id'];

    $stmt = $conn->prepare("UPDATE tickets SET vendor_id = ?, status = 'proses' WHERE ticket_id = ?");
    $stmt->bind_param("ii", $vendor_id, $ticket_id);

    if ($stmt->execute()) {
        echo "Laporan sedang ditangani oleh vendor!";
    } else {
        echo "Gagal memproses laporan: " . $conn->error;
    }

    $stmt->close();
}
