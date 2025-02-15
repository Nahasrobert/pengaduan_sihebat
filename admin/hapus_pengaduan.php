<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id_pengaduan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];

    $stmt = $conn->prepare("DELETE FROM tbl_pengaduan WHERE id_pengaduan = ?");
    $stmt->bind_param("s", $id_pengaduan);

    if ($stmt->execute()) {
        header("Location: pengaduan.php?success=Data berhasil dihapus");
    } else {
        header("Location: pengaduan.php?error=Gagal menghapus data");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: pengaduan.php?error=ID tidak ditemukan");
}
