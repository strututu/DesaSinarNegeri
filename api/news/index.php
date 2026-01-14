<?php
require_once __DIR__ . '/../../src/lib/auth.php';
require_once __DIR__ . '/../../src/config/db.php';
require_login();

$stmt = $pdo->query("SELECT * FROM news ORDER BY id DESC");
$news = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head><title>Berita Desa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>📢 Informasi & Berita Desa</h3>
        <a href="/api/dashboard.php" class="btn btn-secondary">Kembali</a>
    </div>
    <a href="/api/news/create.php" class="btn btn-success mb-3">+ Tulis Berita Baru</a>

    <div class="row">
        <?php foreach($news as $n): ?>
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($n['judul']) ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $n['tanggal'] ?></h6>
                    <p class="card-text"><?= nl2br(htmlspecialchars(substr($n['isi'], 0, 150))) ?>...</p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>