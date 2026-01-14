<?php
// Trik khusus Vercel: simpan session di folder /tmp
if (!is_dir('/tmp/sessions')) {
    mkdir('/tmp/sessions', 0777, true);
}
session_save_path('/tmp/sessions');
session_start();

function current_user() {
    return $_SESSION['user'] ?? null;
}

function require_login() {
    if (!current_user()) {
        header('Location: /api/index.php');
        exit;
    }
}

function logout_user() {
    session_destroy();
}
?>