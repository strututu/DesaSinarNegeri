<?php
require_once __DIR__ . '/../../src/lib/auth.php';
require_once __DIR__ . '/../../src/config/db.php';
require_login();

$id = $_GET['id'] ?? null;
if (!$id) { header('Location: /api/residents/list.php'); exit; }

// Ambil data lama
$stmt = $pdo->prepare("SELECT * FROM residents WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) { die("Data tidak ditemukan."); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $ttl = $_POST['ttl'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE residents SET nik=?, nama=?, jk=?, ttl=?, alamat=?, status=? WHERE id=?");
    $stmt->execute([$nik, $nama, $jk, $ttl, $alamat, $status, $id]);

    header('Location: /api/residents/list.php');
    exit;
}
?>
<!doctype html>
<html>
<head><title>Edit Penduduk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Edit Penduduk</h3>
    <form method="post" class="card p-4 mt-3">
        <div class="mb-3"><label>NIK</label><input name="nik" class="form-control" value="<?= htmlspecialchars($data['nik']) ?>" required></div>
        <div class="mb-3"><label>Nama</label><input name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required></div>
        <div class="mb-3"><label>TTL</label><input name="ttl" class="form-control" value="<?= htmlspecialchars($data['ttl']) ?>"></div>
        <div class="mb-3"><label>JK</label>
            <select name="jk" class="form-select">
                <option value="L" <?= $data['jk']=='L'?'selected':'' ?>>Laki-Laki</option>
                <option value="P" <?= $data['jk']=='P'?'selected':'' ?>>Perempuan</option>
            </select>
        </div>
        <div class="mb-3"><label>Status</label>
            <select name="status" class="form-select">
                <option value="hidup" <?= $data['status']=='hidup'?'selected':'' ?>>Hidup</option>
                <option value="meninggal" <?= $data['status']=='meninggal'?'selected':'' ?>>Meninggal</option>
                <option value="pindah" <?= $data['status']=='pindah'?'selected':'' ?>>Pindah</option>
            </select>
        </div>
        <div class="mb-3"><label>Alamat</label><textarea name="alamat" class="form-control"><?= htmlspecialchars($data['alamat']) ?></textarea></div>
        
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary">Update Data</button>
            <a href="/api/residents/delete.php?id=<?= $data['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus Warga</a>
        </div>
    </form>
</div>
</body>
</html>