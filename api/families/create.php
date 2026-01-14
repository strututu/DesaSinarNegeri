<?php
require_once __DIR__ . '/../../src/lib/auth.php';
require_once __DIR__ . '/../../src/config/db.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO families (no_kk, kepala_keluarga, alamat) VALUES (?,?,?)");
    $stmt->execute([$_POST['no_kk'], $_POST['kepala'], $_POST['alamat']]);
    header('Location: /api/families/list.php'); exit;
}
?>
<!doctype html>
<html>
<head><title>Tambah KK</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body>
<div class="container mt-4">
    <h3>Tambah KK Baru</h3>
    <form method="post" class="card p-4">
        <div class="mb-3"><label>No KK</label><input name="no_kk" class="form-control"></div>
        <div class="mb-3"><label>Kepala Keluarga</label><input name="kepala" class="form-control"></div>
        <div class="mb-3"><label>Alamat</label><input name="alamat" class="form-control"></div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>