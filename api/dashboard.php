<?php
require_once __DIR__ . '/../src/lib/auth.php';
require_login();
$user = current_user();
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8"><title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">Desa Sinar Segeri</a>
    <div class="d-flex text-white align-items-center">
        <span class="me-3">Halo, <?= htmlspecialchars($user['full_name'] ?? $user['username']) ?></span>
        <a class="btn btn-sm btn-light text-primary" href="/api/logout.php">Logout</a>
    </div>
  </div>
</nav>

<div class="container">
  <div class="row g-3">
    <div class="col-md-4">
      <div class="card h-100 text-center p-3">
        <h5>👥 Data Penduduk</h5>
        <p>Kelola data warga desa.</p>
        <a href="/api/residents/list.php" class="btn btn-outline-primary">Buka</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 text-center p-3">
        <h5>🏠 Data Keluarga (KK)</h5>
        <p>Data Kepala Keluarga.</p>
        <a href="/api/families/list.php" class="btn btn-outline-primary">Buka</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 text-center p-3">
        <h5>📄 Layanan Surat</h5>
        <p>Cetak SKTM, Domisili, dll.</p>
        <a href="/api/letters/index.php" class="btn btn-outline-primary">Buka</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 text-center p-3">
        <h5>📢 Informasi Desa</h5>
        <p>Berita & Pengumuman.</p>
        <a href="/api/news/index.php" class="btn btn-outline-primary">Buka</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card h-100 text-center p-3">
        <h5>👔 Aparat Desa</h5>
        <p>Data Perangkat Desa.</p>
        <a href="/api/officials/list.php" class="btn btn-outline-primary">Buka</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>