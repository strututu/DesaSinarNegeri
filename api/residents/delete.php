<?php
require_once __DIR__ . '/../../src/lib/auth.php';
require_once __DIR__ . '/../../src/config/db.php';
require_login();

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM residents WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: /api/residents/list.php');
exit;
?>