<?php
session_start();

// Cek jika belum login atau bukan admin
if (!isset($_SESSION['admin'])) {
    header("Location: ../login_admin.php");
    exit();
}

// Jika admin disimpan sebagai array, ambil nama_lengkap. Jika tidak, pakai username.
$nama_admin = is_array($_SESSION['admin']) && isset($_SESSION['admin']['nama_lengkap']) 
    ? $_SESSION['admin']['nama_lengkap'] 
    : $_SESSION['admin'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-card {
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Kost</a>
    <div class="d-flex">
      <a href="../logout.php" class="btn btn-outline-light">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h3 class="mb-4">Selamat datang, <strong><?= htmlspecialchars($nama_admin); ?></strong></h3>

  <div class="row g-4">
    <!-- Modul Data Penyewa -->
    <div class="col-md-6">
      <div class="card dashboard-card">
        <div class="card-body">
          <h5 class="card-title">Manajemen Penyewa</h5>
          <p class="card-text">Lihat, tambah, ubah, dan hapus data penyewa kost.</p>
          <a href="penyewa/index.php" class="btn btn-primary">Kelola Penyewa</a>
        </div>
      </div>
    </div>

    <!-- Modul Data Kamar -->
    <div class="col-md-6">
      <div class="card dashboard-card">
        <div class="card-body">
          <h5 class="card-title">Manajemen Kamar Kost</h5>
          <p class="card-text">Kelola informasi kamar yang tersedia di kost.</p>
          <a href="kamar/index.php" class="btn btn-primary">Kelola Kamar</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
