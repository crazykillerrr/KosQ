<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user'])) {
    // Jika belum login, redirect ke halaman login user
    header("Location: ../login_user.php");
    exit();
}
?>
