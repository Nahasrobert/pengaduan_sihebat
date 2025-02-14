<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ticket_id = $_POST['ticket_id'];

    $stmt = $conn->prepare("UPDATE tickets SET status = 'selesai' WHERE ticket_id = ?");
    $stmt->bind_param("i", $ticket_id);

    if ($stmt->execute()) {
        echo "Laporan telah diselesaikan!";
    } else {
        echo "Gagal menyelesaikan laporan: " . $conn->error;
    }

    $stmt->close();
}
