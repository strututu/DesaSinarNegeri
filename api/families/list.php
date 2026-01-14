<?php
require_once __DIR__ . '/../../src/lib/auth.php';
require_once __DIR__ . '/../../src/config/db.php';
require_login();

$stmt = $pdo->query("SELECT * FROM families ORDER BY id DESC");
$families = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head><title>Data KK</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Data Kartu Keluarga</h3>
    <a href="/api/dashboard.php" class="btn btn-secondary">Kembali</a>
    <a href="/api/families/create.php" class="btn btn-success">Tambah KK</a>
    <table class="table mt-3">
        <thead><tr><th>No KK</th><th>Kepala Keluarga</th><th>Alamat</th></tr></thead>
        <tbody>
            <?php foreach($families as $f): ?>
            <tr>
                <td><?= $f['no_kk'] ?></td>
                <td><?= $f['kepala_keluarga'] ?></td>
                <td><?= $f['alamat'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>