<!-- admin dashboard -->
<?php
include __DIR__ . '../../../app/auth.php';
require_admin();
include __DIR__ . '/_header_admin.php';
include __DIR__ . '/_sidebar_admin.php';
?>

<!-- Main Content -->
<main class="flex-1 p-10 bg-gray-50 min-h-screen">
  <div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
      <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
      <p class="text-gray-600 mt-2">
        Selamat datang, <span class="font-semibold text-indigo-600"><?= e(current_user_name()) ?></span> —
        role: <span class="capitalize"><?= e(current_user_role()) ?></span>
      </p>
    </div>

    <!-- Statistik Ringkas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
      <div class="bg-gradient-to-br from-indigo-500 to-violet-600 text-white rounded-xl shadow p-5">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-sm opacity-80">Total Artikel</p>
            <h2 class="text-3xl font-bold mt-1">24</h2>
          </div>
          <img src="https://cdn-icons-png.flaticon.com/128/2965/2965879.png" alt="Artikel" class="w-10 h-10 opacity-80">
        </div>
      </div>

      <div class="bg-gradient-to-br from-purple-500 to-fuchsia-600 text-white rounded-xl shadow p-5">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-sm opacity-80">Total Komentar</p>
            <h2 class="text-3xl font-bold mt-1">57</h2>
          </div>
          <img src="https://cdn-icons-png.flaticon.com/128/1380/1380338.png" alt="Komentar" class="w-10 h-10 opacity-80">
        </div>
      </div>

      <div class="bg-gradient-to-br from-sky-500 to-cyan-600 text-white rounded-xl shadow p-5">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-sm opacity-80">Produk Aktif</p>
            <h2 class="text-3xl font-bold mt-1">12</h2>
          </div>
          <img src="https://cdn-icons-png.flaticon.com/128/1040/1040230.png" alt="Produk" class="w-10 h-10 opacity-80">
        </div>
      </div>

      <div class="bg-gradient-to-br from-emerald-500 to-green-600 text-white rounded-xl shadow p-5">
        <div class="flex justify-between items-center">
          <div>
            <p class="text-sm opacity-80">Pengguna</p>
            <h2 class="text-3xl font-bold mt-1">8</h2>
          </div>
          <img src="https://cdn-icons-png.flaticon.com/128/847/847969.png" alt="User" class="w-10 h-10 opacity-80">
        </div>
      </div>
    </div>

    <!-- Menu Kelola -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-white rounded-xl p-6 shadow hover:shadow-md transition">
        <img src="https://cdn-icons-png.flaticon.com/128/1828/1828673.png" class="w-10 h-10 mb-3" alt="">
        <h3 class="font-semibold text-lg text-gray-800">Kelola artikel</h3>
        <p class="text-gray-500 text-sm mt-1">Tambah, ubah, atau hapus artikel dengan mudah.</p>
        <a href="articles/index.php" class="text-indigo-600 text-sm font-medium mt-3 inline-block hover:underline">
          Buka Manajemen artikel →
        </a>
      </div>

      <div class="bg-white rounded-xl p-6 shadow hover:shadow-md transition">
        <img src="https://cdn-icons-png.flaticon.com/128/1380/1380338.png" class="w-10 h-10 mb-3" alt="">
        <h3 class="font-semibold text-lg text-gray-800">Kelola Komentar</h3>
        <p class="text-gray-500 text-sm mt-1">Moderasi komentar dari pengunjung situs.</p>
        <a href="komentar.php" class="text-indigo-600 text-sm font-medium mt-3 inline-block hover:underline">
          Lihat Komentar →
        </a>
      </div>

      <div class="bg-white rounded-xl p-6 shadow hover:shadow-md transition">
        <img src="https://cdn-icons-png.flaticon.com/128/1040/1040230.png" class="w-10 h-10 mb-3" alt="">
        <h3 class="font-semibold text-lg text-gray-800">Kelola Produk</h3>
        <p class="text-gray-500 text-sm mt-1">Atur produk dan penawaran untuk pengguna.</p>
        <a href="produk/index.php" class="text-indigo-600 text-sm font-medium mt-3 inline-block hover:underline">
          Kelola Produk →
        </a>
      </div>

            <div class="bg-white rounded-xl p-6 shadow hover:shadow-md transition">
        <img src="https://img.icons8.com/?size=100&id=7819&format=png&color=000000" class="w-10 h-10 mb-3" alt="">
        <h3 class="font-semibold text-lg text-gray-800">Kelola Pengguna</h3>
        <p class="text-gray-500 text-sm mt-1">Atur akses untuk pengguna.</p>
        <a href="role_management.php" class="text-indigo-600 text-sm font-medium mt-3 inline-block hover:underline">
          Kelola Pengguna →
        </a>
      </div>
    </div>
  </div>
</main>
<!-- end -->
