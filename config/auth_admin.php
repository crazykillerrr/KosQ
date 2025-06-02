<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin'])) {
    // Jika belum login, redirect ke halaman login admin
    header("Location: ../login_admin.php");
    exit();
}
?>
