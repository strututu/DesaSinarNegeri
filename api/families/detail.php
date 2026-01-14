<?php
require_once __DIR__ . '/../../src/lib/auth.php';
require_once __DIR__ . '/../../src/config/db.php';
require_login();

$id = $_GET['id'] ?? null;
if (!$id) { header('Location: /api/families/list.php'); exit; }

// 1. Ambil Data Kepala Keluarga (KK)
$stmt = $pdo->prepare("SELECT * FROM families WHERE id = ?");
$stmt->execute([$id]);
$kk = $stmt->fetch();

if (!$kk) { die("Data KK tidak ditemukan."); }

// 2. Ambil Daftar Anggota Keluarga (Warga yang terhubung ke KK ini)
// Pastikan tabel residents sudah punya kolom 'family_id'
$stmt2 = $pdo->prepare("SELECT * FROM residents WHERE family_id = ?");
$stmt2->execute([$id]);
$members = $stmt2->fetchAll();
?>
<!doctype html>
<html>
<head>
    <title>Detail Kartu Keluarga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Kartu Keluarga: <?= htmlspecialchars($kk['no_kk']) ?></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <strong>Kepala Keluarga:</strong><br>
                    <?= htmlspecialchars($kk['kepala_keluarga']) ?>
                </div>
                <div class="col-md-6">
                    <strong>Alamat:</strong><br>
                    <?= htmlspecialchars($kk['alamat']) ?>
                </div>
            </div>
            <div class="mt-3">
                <a href="/api/families/list.php" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
        </div>
    </div>

    <h4>Anggota Keluarga</h4>
    <?php if (count($members) > 0): ?>
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($members as $m): ?>
                <tr>
                    <td><?= htmlspecialchars($m['nik']) ?></td>
                    <td><?= htmlspecialchars($m['nama']) ?></td>
                    <td><?= $m['jk'] == 'L' ? 'Laki-Laki' : 'Perempuan' ?></td>
                    <td><?= htmlspecialchars($m['status']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">
            Belum ada anggota keluarga yang terdaftar di KK ini. 
            <br>
            <small>Silakan edit Data Penduduk dan pilih KK ini di kolom "Keluarga".</small>
        </div>
    <?php endif; ?>
</div>
</body>
</html>