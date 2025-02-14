<?php
include '../config.php';



// Create user
if (isset($_POST['create'])) {
    // Get input values
    $judul_pengaduan = $_POST['judul_pengaduan'];
    $deskripsi = $_POST['deskripsi'];
    $id_pegawai = $_POST['id_pegawai'];
    $id_perangkat_daerah = $_POST['id_perangkat_daerah'];
    $status = $_POST['status'];
    $nomor_pengaduan = $_POST['nomor_pengaduan'];
    $foto_bukti = $_POST['foto_bukti'];
    
    // Prepare and execute the query to create the user
    $stmt = $conn->prepare("INSERT INTO tbl_pegawai (id_perangkat_daerah, nama, nip_nrp, nomor_telpon ) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $id_perangkat_daerah ,$nama, $nip_nrp, $nomor_telpon );
    if ($stmt->execute()) {
        // Redirect with success status for addition
        header("Location: pengaduan.php?status=success&action=tambah");
    } else {
        // Redirect with error status
        header("Location: pengaduan.php?status=error");
    }
    exit();
}

// Update user
if (isset($_POST['update'])) {
    // Get updated values
    $id_pegawai = intval($_POST['id_pegawai']);
    $id_perangkat_daerah = intval($_POST['id_perangkat_daerah']);
    $nama = htmlspecialchars($_POST['nama'], ENT_QUOTES, 'UTF-8');
    $nip_nrp = htmlspecialchars($_POST['nip_nrp'], ENT_QUOTES, 'UTF-8');
    $nomor_telpon = htmlspecialchars($_POST['nomor_telpon'], ENT_QUOTES, 'UTF-8');



    // Prepare and execute the update query
  
    $stmt = $conn->prepare("UPDATE tbl_pegawai SET id_perangkat_daerah=?, nama=?, nip_nrp=?, nomor_telpon=? WHERE id_pegawai=?");
    $stmt->bind_param("isssi", $id_perangkat_daerah, $nama, $nip_nrp, $nomor_telpon, $id_pegawai);

    if ($stmt->execute()) {
        // Redirect with success status for update
        header("Location: pengaduan.php?status=success&action=ubah");
    } else {
        // Redirect with error status
        header("Location: pengaduan.php?status=error");
    }
    exit();
}

// Delete user
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM tbl_pegawai WHERE id_pegawai = ?");
    $stmt->bind_param("i", $user_id);

    // Try executing the statement and check if it was successful
    if ($stmt->execute()) {
        // If successful, redirect with success status for deletion
        header("Location: pengaduan.php?status=success&action=hapus");
    } else {
        // If an error occurs, redirect with error status
        header("Location: pengaduan.php?status=error");
    }
} else {
    // If no 'id' is set, redirect to index page with an error message
    header("Location: pengaduan.php?status=error");
}

// Make sure to exit after the header to avoid further code execution
exit();
