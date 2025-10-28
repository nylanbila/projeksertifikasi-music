<?php
require_once __DIR__ . '/../../app/auth.php';
require_login();

// include layout header (tanpa <body> di dalamnya)
include __DIR__ . '/_header_users.php';
?>

<div class="flex min-h-screen bg-gray-50">
  <!-- Sidebar -->
  <?php include __DIR__ . '/_sidebar_users.php'; ?>

  <!-- Konten Utama -->
  <main class="flex-1 p-10 overflow-y-auto">
    <div class="max-w-5xl mx-auto">
      <!-- Header -->
      <h1 class="text-3xl font-bold text-gray-800 mb-2">
        Selamat Datang, <span class="text-indigo-600"><?= e(current_user_name()) ?></span> 👋
      </h1>
      <p class="text-gray-500 mb-8">
        Berikut informasi akun dan aktivitasmu di platform <span class="font-semibold text-indigo-600">Melody Sphere</span>.
      </p>

      <!-- Grid Info -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Profil -->
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-gradient-to-r from-indigo-500 to-violet-500 text-white font-bold text-lg w-12 h-12 rounded-full flex items-center justify-center shadow-md">
              <?= strtoupper(substr(e(current_user_name()), 0, 1)) ?>
            </div>
            <h2 class="ml-4 text-lg font-semibold text-gray-800">Profil Akun</h2>
          </div>
          <div class="space-y-3 text-gray-600">
            <p><span class="font-medium text-gray-800">Nama:</span> <?= e(current_user_name()) ?></p>
            <p><span class="font-medium text-gray-800">Email:</span> <?= e($_SESSION['user_email'] ?? '-') ?></p>
            <p><span class="font-medium text-gray-800">Role:</span> <?= e(current_user_role()) ?></p>
          </div>
        </div>

        <!-- Aktivitas -->
        <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100 hover:shadow-lg transition">
          <div class="flex items-center mb-4">
            <div class="flex-shrink-0 bg-gradient-to-r from-violet-500 to-indigo-500 text-white font-bold text-lg w-12 h-12 rounded-full flex items-center justify-center shadow-md">
              <i class="fa fa-bolt"></i>
            </div>
            <h2 class="ml-4 text-lg font-semibold text-gray-800">Aktivitas Terbaru</h2>
          </div>
          <p class="text-gray-600 mb-4">
            Lihat artikel yang kamu <span class="font-medium text-indigo-600">sukai</span> atau komentar yang telah kamu <span class="font-medium text-indigo-600">tinggalkan</span>.
          </p>
          <div class="flex gap-3">
            <a href="likes.php" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700 transition">Lihat Disukai</a>
            <a href="comments.php" class="bg-violet-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-violet-700 transition">Lihat Komentar</a>
          </div>
        </div>
      </div>

      <!-- Tips -->
      <div class="mt-10 bg-gradient-to-r from-indigo-600 to-violet-600 text-white p-6 rounded-2xl shadow-md">
        <h3 class="font-semibold text-lg mb-2 flex items-center">
          <i class="fa fa-lightbulb mr-2"></i> Tips Penggunaan
        </h3>
        <p class="text-sm leading-relaxed">
          Gunakan menu di sebelah kiri untuk menavigasi ke halaman <b>Disukai</b> dan <b>Dikomentar</b>. 
          Kamu juga bisa kembali ke halaman utama kapan saja melalui tombol 
          <span class="underline font-semibold">Kembali ke Halaman Utama</span>.
        </p>
      </div>
    </div>
  </main>
</div>

<?php include __DIR__ . '/_footer_users.php'; ?>
