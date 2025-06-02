<?php
include 'config/db.php'; // pastikan path sesuai struktur folder kamu
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama_lengkap = trim($_POST['nama_lengkap']);
    $no_hp = trim($_POST['no_hp']);
    $alamat = trim($_POST['alamat']);

    // Upload Foto
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $folder = "uploads/";

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $target = $folder . basename($foto);

    if (move_uploaded_file($tmp, $target)) {
        // Simpan ke database
        $stmt = $conn->prepare("INSERT INTO user (username, password, nama_lengkap, no_hp, alamat, foto) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $username, $password, $nama_lengkap, $no_hp, $alamat, $foto);
        
        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Registrasi berhasil. Silakan <a href='login_user.php'>login</a>.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Gagal menyimpan data.</div>";
        }

        $stmt->close();
    } else {
        $message = "<div class='alert alert-danger'>Upload foto gagal.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register User</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h3 class="text-center mb-4">Form Registrasi Pengguna</h3>

      <?= $message ?>

      <form method="POST" enctype="multipart/form-data" novalidate>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" name="password" id="password" class="form-control" required minlength="4">
        </div>

        <div class="mb-3">
          <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="no_hp" class="form-label">Nomor HP</label>
          <input type="tel" name="no_hp" id="no_hp" class="form-control" required pattern="^[0-9]{10,13}$">
        </div>

        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
          <label for="foto" class="form-label">Foto Profil</label>
          <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Daftar</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>
