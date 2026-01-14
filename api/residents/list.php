<?php
// Perhatikan tanda ../../ (mundur 2 langkah)
require_once __DIR__ . '/../../src/lib/auth.php';
require_once __DIR__ . '/../../src/config/db.php';
require_login();

// Ambil data dari database
$stmt = $pdo->query("SELECT * FROM residents ORDER BY id DESC");
$residents = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head><title>Data Penduduk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Data Penduduk</h3>
        <a href="/api/dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
    <a href="/api/residents/create.php" class="btn btn-success mb-3">+ Tambah Warga</a>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($residents as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r['nik']) ?></td>
                <td><?= htmlspecialchars($r['nama']) ?></td>
                <td><?= htmlspecialchars($r['jk']) ?></td>
                <td><?= htmlspecialchars($r['alamat']) ?></td>
                <td>
                    <a href="/api/residents/edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>