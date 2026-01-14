<?php
require_once __DIR__ . '/../../src/lib/auth.php';
require_once __DIR__ . '/../../src/config/db.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tgl = date('Y-m-d');

    $stmt = $pdo->prepare("INSERT INTO news (judul, isi, tanggal) VALUES (?, ?, ?)");
    $stmt->execute([$judul, $isi, $tgl]);
    
    header('Location: /api/news/index.php'); exit;
}
?>
<!doctype html>
<html>
<head><title>Tulis Berita</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body>
<div class="container mt-4">
    <h3>Tulis Berita Baru</h3>
    <form method="post" class="card p-4">
        <div class="mb-3"><label>Judul Berita</label><input name="judul" class="form-control" required></div>
        <div class="mb-3"><label>Isi Berita</label><textarea name="isi" class="form-control" rows="5" required></textarea></div>
        <button class="btn btn-primary">Publish</button>
        <a href="/api/news/index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>