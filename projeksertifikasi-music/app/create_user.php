<?php
// app/process_create_user.php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/../config/config.php';

require_admin();

// hanya POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /projeksertifikasi-music/public/admin/add_user.php');
    exit;
}

// CSRF
$csrf = $_POST['csrf'] ?? '';
if (empty($csrf) || !isset($_SESSION['csrf_add_user']) || !hash_equals($_SESSION['csrf_add_user'], $csrf)) {
    $_SESSION['flash_error'] = 'Form tidak valid (CSRF).';
    header('Location: /projeksertifikasi-music/public/admin/add_user.php');
    exit;
}
unset($_SESSION['csrf_add_user']);

// ambil & sanitasi input
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

$allowed_roles = ['admin', 'editor', 'user'];

// validasi
if ($name === '' || $email === '' || $password === '' || $role === '') {
    $_SESSION['flash_error'] = 'Semua field wajib diisi.';
    header('Location: /projeksertifikasi-music/public/admin/add_user.php');
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['flash_error'] = 'Email tidak valid.';
    header('Location: /projeksertifikasi-music/public/admin/add_user.php');
    exit;
}
if (!in_array($role, $allowed_roles)) {
    $_SESSION['flash_error'] = 'Role tidak valid.';
    header('Location: /projeksertifikasi-music/public/admin/add_user.php');
    exit;
}
if (strlen($password) < 6) {
    $_SESSION['flash_error'] = 'Password minimal 6 karakter.';
    header('Location: /projeksertifikasi-music/public/admin/add_user.php');
    exit;
}

// cek unique email
$stmt = $koneksi->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->close();
    $_SESSION['flash_error'] = 'Email sudah terdaftar.';
    header('Location: /projeksertifikasi-music/public/admin/add_user.php');
    exit;
}
$stmt->close();

// hash password
$hash = password_hash($password, PASSWORD_DEFAULT);

// insert user
$stmt = $koneksi->prepare("INSERT INTO users (name, email, password_hash, role, created_at) VALUES (?, ?, ?, ?, NOW())");
if (!$stmt) {
    $_SESSION['flash_error'] = 'Terjadi kesalahan server.';
    header('Location: /projeksertifikasi-music/public/admin/add_user.php');
    exit;
}
$stmt->bind_param('ssss', $name, $email, $hash, $role);
$ok = $stmt->execute();
$stmt->close();

if ($ok) {
    $_SESSION['flash'] = 'User berhasil dibuat.';
    header('Location: /projeksertifikasi-music/public/admin/role_management.php');
    exit;
} else {
    $_SESSION['flash_error'] = 'Gagal menyimpan user: ' . $koneksi->error;
    header('Location: /projeksertifikasi-music/public/admin/add_user.php');
    exit;
}