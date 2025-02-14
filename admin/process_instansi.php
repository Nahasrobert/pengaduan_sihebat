<?php
include '../config.php';



// Create user
if (isset($_POST['create'])) {
    // Get input values
    $nama_perangkat_daerah = $_POST['nama_perangkat_daerah'];
    
    // Prepare and execute the query to create the user
    $stmt = $conn->prepare("INSERT INTO tbl_perangkat_daerah (nama_perangkat_daerah) VALUES (?)");
    $stmt->bind_param("s", $nama_perangkat_daerah );
    if ($stmt->execute()) {
        // Redirect with success status for addition
        header("Location: instansi.php?status=success&action=tambah");
    } else {
        // Redirect with error status
        header("Location: instansi.php?status=error");
    }
    exit();
}

// Update user
if (isset($_POST['update'])) {
    // Get updated values
    $id_perangkat_daerah = $_POST['id_perangkat_daerah'];
    $nama_perangkat_daerah = $_POST['nama_perangkat_daerah'];



    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE tbl_perangkat_daerah SET nama_perangkat_daerah=? WHERE id_perangkat_daerah=?");
    $stmt->bind_param("si", $nama_perangkat_daerah, $id_perangkat_daerah);

    if ($stmt->execute()) {
        // Redirect with success status for update
        header("Location: instansi.php?status=success&action=ubah");
    } else {
        // Redirect with error status
        header("Location: instansi.php?status=error");
    }
    exit();
}

// Delete user
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM tbl_perangkat_daerah WHERE id_perangkat_daerah = ?");
    $stmt->bind_param("i", $user_id);

    // Try executing the statement and check if it was successful
    if ($stmt->execute()) {
        // If successful, redirect with success status for deletion
        header("Location: instansi.php?status=success&action=hapus");
    } else {
        // If an error occurs, redirect with error status
        header("Location: instansi.php?status=error");
    }
} else {
    // If no 'id' is set, redirect to index page with an error message
    header("Location: instansi.php?status=error");
}

// Make sure to exit after the header to avoid further code execution
exit();
