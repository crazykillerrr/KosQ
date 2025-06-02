<?php
session_start();

// Jika sudah login, arahkan langsung ke dashboard
if (isset($_SESSION['admin'])) {
    header("Location: admin/dashboard.php");
    exit;
} elseif (isset($_SESSION['user_id'])) {
    header("Location: user/dashboard.php");
    exit;
} else {
    // Jika belum login, arahkan ke login_user.php setelah 3 detik
    header("Refresh: 3; url=login_user.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Selamat Datang</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

  <div class="container d-flex vh-100 justify-content-center align-items-center">
    <div class="text-center">
      <div class="spinner-border text-primary mb-3" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <h3>Selamat datang di Sistem Penyewaan Kost</h3>
      <p class="text-muted">Mengalihkan ke halaman login...</p>
      <p><small>Jika tidak dialihkan, klik <a href="login_user.php">di sini</a>.</small></p>
    </div>
  </div>

</body>
</html>
