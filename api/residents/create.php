<?php
require_once __DIR__ . '/../../src/lib/auth.php';
require_once __DIR__ . '/../../src/config/db.php';
require_login();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = trim($_POST['nik']);
    $nama = trim($_POST['nama']);
    $jk = $_POST['jk'];
    $ttl = $_POST['ttl'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];

    if (!$nik || !$nama) {
        $error = "NIK dan Nama wajib diisi.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO residents (nik, nama, jk, ttl, alamat, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nik, $nama, $jk, $ttl, $alamat, $status]);
            
            // Redirect ke list
            header('Location: /api/residents/list.php');
            exit;
        } catch (PDOException $e) {
            $error = "Gagal menyimpan: " . $e->getMessage();
        }
    }
}
?>
<!doctype html>
<html>
<head><title>Tambah Penduduk</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Tambah Penduduk</h3>
    <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    
    <form method="post" class="card p-4 mt-3">
        <div class="mb-3"><label>NIK</label><input name="nik" class="form-control" required></div>
        <div class="mb-3"><label>Nama Lengkap</label><input name="nama" class="form-control" required></div>
        <div class="mb-3"><label>TTL (Contoh: Jakarta, 01-01-1990)</label><input name="ttl" class="form-control"></div>
        <div class="mb-3"><label>Jenis Kelamin</label>
            <select name="jk" class="form-select">
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="mb-3"><label>Status</label>
            <select name="status" class="form-select">
                <option value="hidup">Hidup</option>
                <option value="meninggal">Meninggal</option>
                <option value="pindah">Pindah</option>
            </select>
        </div>
        <div class="mb-3"><label>Alamat</label><textarea name="alamat" class="form-control"></textarea></div>
        
        <button class="btn btn-primary">Simpan</button>
        <a href="/api/residents/list.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>