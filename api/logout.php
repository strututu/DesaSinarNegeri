<?php
require_once __DIR__ . '/../src/lib/auth.php';
logout_user();
header('Location: /api/index.php');
exit;