<?php
require_once __DIR__ . '/../src/config/db.php';
// session_start sudah ada di auth, tapi karena ini file awal, kita panggil manual session start
if (!is_dir('/tmp/sessions')) { mkdir('/tmp/sessions', 0777, true); }
session_save_path('/tmp/sessions');
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  // Cek user di database
  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  // Cek password (MD5 sesuai request awalmu)
  if ($user && md5($password) === $user['password']) {
    $_SESSION['user'] = $user;
    header('Location: /api/dashboard.php');
    exit;
  } else {
    $error = 'Username atau password salah';
  }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Login - Desa Sinar Segeri</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow">
        <div class="card-body">
          <h4 class="text-center mb-4">Sistem Desa Sinar Segeri</h4>
          <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
          <form method="post">
            <div class="mb-3">
                <label>Username</label>
                <input name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100">Masuk</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>