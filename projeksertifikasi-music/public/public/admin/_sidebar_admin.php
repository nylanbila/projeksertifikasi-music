<?php
$base = '/projeksertifikasi-music/public'; // sesuaikan dengan folder public di URL-mu
$user_name = $_SESSION['user_name'] ?? 'Admin Kampus';
$user_role = $_SESSION['user_role'] ?? 'admin';
?>

<aside class="w-64 min-h-screen bg-gradient-to-b from-violet-700 to-indigo-800 text-white flex flex-col shadow-lg">
  <!-- Header -->
  <div class="p-6 border-b border-violet-600 text-center">
    <a href="<?= $base ?>/admin/dashboard.php" class="text-2xl font-bold tracking-wide">
      <?= htmlspecialchars($user_name) ?>
    </a>
    <p class="text-xs text-violet-200 mt-1">Admin Panel</p>
  </div>

  <!-- Menu Navigasi -->
  <nav class="flex-1 px-5 py-6 space-y-2">

    <a href="<?= $base ?>/admin/admin_dashboard.php"
      class="flex items-center gap-3 px-3 py-2 rounded-lg transition <?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'bg-violet-600 font-semibold shadow-md' : 'hover:bg-violet-600/50' ?>">
      <img src="https://img.icons8.com/?size=100&id=Yj5svDsC4jQA&format=png&color=000000" alt="Dashboard"
        class="w-5 h-5"> Dashboard
    </a>

    <a href="<?= $base ?>/admin/articles/index.php"
      class="flex items-center gap-3 px-3 py-2 rounded-lg transition <?= strpos($_SERVER['PHP_SELF'], 'berita') !== false ? 'bg-violet-600 font-semibold shadow-md' : 'hover:bg-violet-600/50' ?>">
      <img src="https://img.icons8.com/?size=100&id=532&format=png&color=000000" alt="Berita" class="w-5 h-5"> Artikel
    </a>

    <a href="<?= $base ?>/admin/role_management.php"
      class="flex items-center gap-3 px-3 py-2 rounded-lg transition <?= strpos($_SERVER['PHP_SELF'], 'role') !== false ? 'bg-violet-600 font-semibold shadow-md' : 'hover:bg-violet-600/50' ?>">
      <img src="https://img.icons8.com/?size=100&id=7819&format=png&color=000000" alt="Role" class="w-5 h-5"> Kelola
      Role
    </a>

    <a href="<?= $base ?>/admin/comment_management.php"
      class="flex items-center gap-3 px-3 py-2 rounded-lg transition <?= strpos($_SERVER['PHP_SELF'], 'komentar') !== false ? 'bg-violet-600 font-semibold shadow-md' : 'hover:bg-violet-600/50' ?>">
      <img src="https://img.icons8.com/?size=100&id=2951&format=png&color=000000" alt="Komentar" class="w-5 h-5"> Kelola
      Komentar
    </a>
  </nav>

<!-- Informasi User -->
<div class="px-6 py-4 border-t border-violet-600 bg-violet-800/40 rounded-b-lg">
  <div class="flex items-center justify-between">
    <div class="flex items-center space-x-4">
      <!-- Avatar User -->
      <div class="w-12 h-12 rounded-full bg-violet-700 flex items-center justify-center text-white text-xl font-bold">
        <?= strtoupper(substr($user_name, 0, 1)) ?>
      </div>
      <!-- Nama dan Role -->
      <div>
        <p class="text-violet-200 text-sm">Signed in as</p>
        <p class="font-semibold text-white mt-1"><?= htmlspecialchars($user_name) ?></p>
        <p class="text-xs text-violet-300 capitalize">Role: <?= htmlspecialchars($user_role) ?></p>
      </div>
    </div>
    
    <!-- Icon Edit Profile -->
    <a href="<?= $base ?>/admin/profile.php" title="Edit Profile"
       class="flex items-center justify-center w-9 h-9 rounded-full bg-violet-700 hover:bg-violet-600 transition">
      <img src="https://cdn-icons-png.flaticon.com/128/484/484562.png" alt="Edit Profile" class="w-5 h-5" />
    </a>
  </div>
</div>


  <!-- Footer Sidebar -->
  <div class="px-5 py-4 border-t border-violet-700 text-sm">
    <a href="<?= $base ?>/index.php"
      class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-violet-600/50 transition">
      <img src="https://cdn-icons-png.flaticon.com/128/93/93634.png" alt="Back" class="w-5 h-5"> Kembali ke Halaman
      Utama
    </a>
    <a href="<?= $base ?>/logout.php"
      class="flex items-center gap-3 px-3 py-2 mt-2 rounded-lg bg-red-500 hover:bg-red-600 transition text-white">
      <img src="https://img.icons8.com/?size=100&id=2445&format=png&color=000000" alt="Logout" class="w-5 h-5"> Logout
    </a>
  </div>
</aside>