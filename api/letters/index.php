<?php
require_once __DIR__ . '/../../src/lib/auth.php';
require_once __DIR__ . '/../../src/config/db.php';
require_login();

// Ambil semua warga buat dipilih
$stmt = $pdo->query("SELECT id, nik, nama FROM residents ORDER BY nama ASC");
$warga = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head>
    <title>Layanan Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Buat Surat</h3>
    <a href="/api/dashboard.php" class="btn btn-secondary mb-3">Kembali</a>
    
    <div class="card p-4">
        <form action="/api/letters/print_domisili.php" method="GET" target="_blank">
            <div class="mb-3">
                <label>Pilih Warga</label>
                <select name="id" class="form-control" required>
                    <option value="">-- Cari Nama --</option>
                    <?php foreach($warga as $w): ?>
                        <option value="<?= $w['id'] ?>"><?= $w['nama'] ?> - <?= $w['nik'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label>Jenis Surat</label>
                <select class="form-control" onchange="this.form.action = this.value">
                    <option value="/api/letters/print_domisili.php">Keterangan Domisili</option>
                    <option value="/api/letters/print_usaha.php">Keterangan Usaha</option>
                    <option value="/api/letters/print_sktm.php">Keterangan Tidak Mampu</option>
                </select>
            </div>
            <button class="btn btn-primary">Cetak PDF</button>
        </form>
    </div>
</div>
</body>
</html>