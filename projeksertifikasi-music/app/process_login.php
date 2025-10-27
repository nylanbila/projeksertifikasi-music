<?php
// app/process_login.php
include __DIR__ . '/../config/config.php';
session_start();

//jika pengguna mencoba mengakses proses dengan method selain post
//maka mereka otomatis diarhkan kehalaman login
//fungsinya mencegah akses langsung ke php dan hanya bia diakses lewat form post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ../public/login.php');
  exit;
}


$email = trim($_POST['email'] ?? ''); //trim fungsinya menghapus spasi kosong
$password = $_POST['password'] ?? '';

//alert email dan pass wajib diisi
if ($email === '' || $password === '') {
  header('Location: ../public/login.php?error=' . urlencode('Email & password wajib diisi'));
  exit;
}

//mengecek apakah email valid jika tidak akan muncul notif
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('Location: ../public/login.php?error=' . urlencode('Email tidak valid'));
  exit;
}


$stmt = mysqli_prepare($koneksi, "SELECT id, name, password_hash, role FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id, $name, $password_hash, $role);
$found = mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

//mysqli_prepare = buat template query dengan ? sebagai tempat isian
//tidak langsung disusun menjadi perintah SQL seperti SELECT * From users WHERE email = $email
//karena rawan untuk SQL injection (misal hacker tambah OR '1'='1' selalu true → mengembalikan semua baris → akses data semua user.)
//mysqli bind_param = mengisi ? dengan $email bertipe string (s) yang diinputkan user
//sehingga $email hanya dianggap data bukan query sql
//mysqli execute = mejalankan query berdasarkan data yg sudah dibind
// mysqli result = Bind result (siapkan tempat menampung hasil query)
// mysqli_stmt_fetch() membaca satu baris hasil query dan mengisi variabel yang telah di-bind.



//mengecek apakah data user ditemukan di BD, jika tidak akan dibawa kembali ke hal login
if (!$found) {
  // jangan jelaskan lebih detil (keamanan)
  header('Location: ../public/login.php?error=' . urlencode('Email atau password salah'));
  exit;
}

//Mengecek apakah password yang diketik pengguna ($password) cocok dengan password yang tersimpan di database ($password_hash).
if (!password_verify($password, $password_hash)) {
  header('Location: ../public/login.php?error=' . urlencode('Email atau password salah'));
  exit;
}

// login sukses: set session
session_regenerate_id(true);
$_SESSION['user_id'] = $id;
$_SESSION['user_name'] = $name;
$_SESSION['user_email'] = $email;
$_SESSION['user_role'] = $role;

// redirect berdasarkan role
if ($role === 'admin') {
  header('Location: ../public/admin/admin_dashboard.php');
  exit;
} else {
  header('Location: ../public/users/users_dashboard.php');
  exit;
}