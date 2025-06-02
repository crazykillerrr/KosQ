<?php
session_start();
include 'config/db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: user/dashboard.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: user/dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
  <div class="container d-flex vh-100 justify-content-center align-items-center">
    <div class="card p-4 shadow" style="max-width: 400px; width:100%;">
      <h3 class="mb-3 text-center">Login User</h3>

      <?php if($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" novalidate>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" id="username" name="username" required class="form-control" />
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" name="password" required class="form-control" />
        </div>
        <button type="submit" class="btn btn-success w-100">Login</button>
        <div class="mt-3 text-center">
          <a href="login_admin.php">Login sebagai Admin</a><br>
          <a href="register_user.php">Daftar User Baru</a>
        </div>
      </form>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
