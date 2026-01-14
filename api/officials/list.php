<?php
require_once __DIR__ . '/../../src/lib/auth.php';
require_login();
?>
<!doctype html>
<html>
<head><title>Aparat Desa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Struktur Organisasi Desa</h3>
    <a href="/api/dashboard.php" class="btn btn-secondary mb-3">Kembali</a>
    
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Bpk. Kepala Desa</h5>
                <p class="text-muted">Kepala Desa</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Ibu Sekretaris</h5>
                <p class="text-muted">Sekretaris Desa</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Bpk. Bendahara</h5>
                <p class="text-muted">Kaur Keuangan</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>