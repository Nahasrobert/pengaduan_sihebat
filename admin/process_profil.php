<?php
include '../config.php';

// Folder tempat menyimpan file
$uploadDir = "../uploads/";

// Fungsi untuk menghandle upload file
function uploadFile($file, $uploadDir)
{
    if ($file['error'] === 0) {
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if ($fileExt !== "pdf") {
            return false; // Hanya izinkan file PDF
        }

        $newFileName = uniqid() . "." . $fileExt;
        $destination = $uploadDir . $newFileName;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $newFileName;
        }
    }
    return null; // Jika tidak ada file yang diupload
}

// 🔹 TAMBAH DATA PROFIL
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8');
    $visi = htmlspecialchars($_POST['visi'], ENT_QUOTES, 'UTF-8');
    $misi = htmlspecialchars($_POST['misi'], ENT_QUOTES, 'UTF-8');
    $keterangan = htmlspecialchars($_POST['keterangan'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $nomor_hp = htmlspecialchars($_POST['nomor_hp'], ENT_QUOTES, 'UTF-8');

    // Proses upload file
    $perwali = uploadFile($_FILES["perwali"], $uploadDir);
    $sop = uploadFile($_FILES["sop"], $uploadDir);
    $manual_book = uploadFile($_FILES["manual_book"], $uploadDir);

    if (!$perwali || !$sop || !$manual_book) {
        header("Location: tambah_profil.php?status=error&msg=File upload gagal");
        exit();
    }

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO tbl_profil (nama, visi, misi, perwali, sop, manual_book, keterangan, email, nomor_hp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $nama, $visi, $misi, $perwali, $sop, $manual_book, $keterangan, $email, $nomor_hp);

    if ($stmt->execute()) {
        header("Location: profil.php?status=success&action=tambah");
    } else {
        header("Location: tambah_profil.php?status=error");
    }

    $stmt->close();
    $conn->close();
    exit();
}

// 🔹 UPDATE DATA PROFIL
if (isset($_POST['update'])) {
    $id_profil = intval($_POST['id_profil']);
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8');
    $visi = htmlspecialchars($_POST['visi'], ENT_QUOTES, 'UTF-8');
    $misi = htmlspecialchars($_POST['misi'], ENT_QUOTES, 'UTF-8');
    $keterangan = htmlspecialchars($_POST['keterangan'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $nomor_hp = htmlspecialchars($_POST['nomor_hp'], ENT_QUOTES, 'UTF-8');

    // Ambil data lama dari database
    $result = $conn->query("SELECT perwali, sop, manual_book FROM tbl_profil WHERE id_profil = $id_profil");
    $oldData = $result->fetch_assoc();

    // Cek apakah user mengupload file baru, jika tidak gunakan file lama
    $perwali = uploadFile($_FILES['perwali'], $uploadDir) ?? $oldData['perwali'];
    $sop = uploadFile($_FILES['sop'], $uploadDir) ?? $oldData['sop'];
    $manual_book = uploadFile($_FILES['manual_book'], $uploadDir) ?? $oldData['manual_book'];

    // Update database
    $stmt = $conn->prepare("UPDATE tbl_profil SET nama=?, visi=?, misi=?, perwali=?, sop=?, manual_book=?, keterangan=?, email=?, nomor_hp=? WHERE id_profil=?");
    $stmt->bind_param("sssssssssi", $nama, $visi, $misi, $perwali, $sop, $manual_book, $keterangan, $email, $nomor_hp, $id_profil);

    if ($stmt->execute()) {
        header("Location: profil.php?status=success&action=ubah");
    } else {
        header("Location: profil.php?status=error");
    }
    exit();
}

// 🔹 HAPUS DATA PROFIL
if (isset($_POST['delete'])) {
    $id_profil = intval($_POST['delete_id']);

    // Ambil data lama untuk menghapus file terkait (jika ada)
    $result = $conn->query("SELECT perwali, sop, manual_book FROM tbl_profil WHERE id_profil = $id_profil");
    $data = $result->fetch_assoc();

    // Hapus file jika ada
    if ($data) {
        if (!empty($data['perwali']) && file_exists($uploadDir . $data['perwali'])) {
            unlink($uploadDir . $data['perwali']);
        }
        if (!empty($data['sop']) && file_exists($uploadDir . $data['sop'])) {
            unlink($uploadDir . $data['sop']);
        }
        if (!empty($data['manual_book']) && file_exists($uploadDir . $data['manual_book'])) {
            unlink($uploadDir . $data['manual_book']);
        }
    }

    // Hapus data dari database
    $stmt = $conn->prepare("DELETE FROM tbl_profil WHERE id_profil = ?");
    $stmt->bind_param("i", $id_profil);

    if ($stmt->execute()) {
        header("Location: profil.php?status=success&action=hapus");
    } else {
        header("Location: profil.php?status=error");
    }
    exit();
}
