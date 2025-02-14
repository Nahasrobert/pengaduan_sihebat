<?php
include '../config.php';



// Create user
if (isset($_POST['create'])) {
    // Get input values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);  // MD5 encryption (use bcrypt for better security)
    $role = $_POST['role'];
    
    // Prepare and execute the query to create the user
    $stmt = $conn->prepare("INSERT INTO tbl_admin (username, email, password , role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $password, $role );



    if ($stmt->execute()) {
        // Redirect with success status for addition
        header("Location: index.php?status=success&action=tambah");
    } else {
        // Redirect with error status
        header("Location: index.php?status=error");
    }
    exit();
}

// Update user
if (isset($_POST['update'])) {
    // Get updated values
    $id = $_POST['id_admin'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];



    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE tbl_admin SET username=?, email=?, role=? WHERE id_admin=?");
    $stmt->bind_param("sssi", $username, $email, $role, $id);

    if ($stmt->execute()) {
        // Redirect with success status for update
        header("Location: index.php?status=success&action=ubah");
    } else {
        // Redirect with error status
        header("Location: index.php?status=error");
    }
    exit();
}

// Delete user
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM tbl_admin WHERE id_admin = ?");
    $stmt->bind_param("i", $user_id);

    // Try executing the statement and check if it was successful
    if ($stmt->execute()) {
        // If successful, redirect with success status for deletion
        header("Location: index.php?status=success&action=hapus");
    } else {
        // If an error occurs, redirect with error status
        header("Location: index.php?status=error");
    }
} else {
    // If no 'id' is set, redirect to index page with an error message
    header("Location: index.php?status=error");
}

// Make sure to exit after the header to avoid further code execution
exit();
