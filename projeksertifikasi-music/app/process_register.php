<?php
// app/process_register.php
include __DIR__ . '/../config/config.php';
session_start();

//jika pengguna mencoba mengakses proses dengan method selain post
//maka mereka otomatis diarhkan kehalaman regist
//fungsinya mencegah akses langsung ke php dan hanya bia diakses lewat form post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: ../public/register.php');
  exit;
}

//data yang akan dimasukkan ke DB
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

//alert untuk mengisi seluruh data
if ($name === '' || $email === '' || $password === '') {
  header('Location: ../public/register.php?error=' . urlencode('Semua field wajib diisi'));
  exit;
}

//memastikan email yg diinput memiliki struktur valid
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('Location: ../public/register.php?error=' . urlencode('Email tidak valid'));
  exit;
}

//memastikan pass lebih dari 6 char
if (strlen($password) < 6) {
  header('Location: ../public/register.php?error=' . urlencode('Password minimal 6 karakter'));
  exit;
}

// cek apakah email sudah terdaftar
//penjelasannya kaya di proses login, intinya menyiapkan template untuk mencegah SQL injection
$stmt = mysqli_prepare($koneksi, "SELECT id FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
//email yang diinput harus unik atau baru
if (mysqli_stmt_num_rows($stmt) > 0) {
  mysqli_stmt_close($stmt);
  header('Location: ../public/register.php?error=' . urlencode('Email sudah terdaftar'));
  exit;
}
mysqli_stmt_close($stmt);


$password_hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = mysqli_prepare($koneksi, "INSERT INTO users (name, email, password_hash, role) VALUES (?, ?, ?, 'user')");
if (!$stmt) {
  header('Location: ../public/register.php?error=' . urlencode('Terjadi kesalahan server'));
  exit;
}
mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password_hash);
$ok = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($koneksi);

//password hash berfungsi mengacak pass yang diinputkan user sehingga pass yg tersimpan di database bukan pass apa adanya
//mysqli menyiapkan dan default role = user
//mysqli stmt bind = Mengisi tanda tanya ? dengan data yg diinput, dgn berurutan 
//"sss" maksudny 3 data yg diinput bertipe string
//$ok = mysli stmt mnjalankan query

//handling jika query berhasil atau gagal
if ($ok) {
  header('Location: ../public/login.php?success=1');
  exit;
} else {
  header('Location: ../public/register.php?success=2');
  exit;
}
