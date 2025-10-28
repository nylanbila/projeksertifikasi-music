<?php
// public/admin/comments_management.php
require_once __DIR__ . '/../../app/auth.php';
require_once __DIR__ . '/../../app/functions.php';
require_once __DIR__ . '/../../config/config.php';

if (session_status() === PHP_SESSION_NONE) session_start();
require_admin(); // hanya admin boleh akses

// --- Ambil semua komentar ---
$stmt = $koneksi->prepare("
  SELECT c.id, c.body, c.created_at,
         a.id AS article_id, a.title AS article_title, a.slug,
         u.id AS user_id, u.name AS user_name, u.email AS user_email
  FROM comments c
  JOIN articles a ON a.id = c.article_id
  JOIN users u ON u.id = c.user_id
  ORDER BY c.created_at DESC
");
$stmt->execute();
$comments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

include __DIR__ . '/_header_admin.php';
?>

<div class="flex min-h-screen bg-gray-50">
  <!-- Sidebar -->
  <?php include __DIR__ . '/_sidebar_admin.php'; ?>

  <!-- Konten utama -->
  <main class="flex-1 p-10 overflow-y-auto">
    <div class="max-w-6xl mx-auto">
      <h1 class="text-3xl font-bold text-gray-800 mb-2">Kelola Komentar 🗨️</h1>
      <p class="text-gray-500 mb-8">Lihat dan kelola seluruh komentar pengguna pada artikel di <span class="text-indigo-600 font-semibold">Melody Sphere</span>.</p>

      <?php if (empty($comments)): ?>
        <div class="bg-white rounded-2xl shadow-md p-8 text-center text-gray-600">
          <p class="text-lg">Belum ada komentar yang masuk 😅</p>
        </div>
      <?php else: ?>
        <div class="overflow-x-auto bg-white rounded-2xl shadow">
          <table class="min-w-full border border-gray-100 text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
              <tr>
                <th class="px-4 py-3">#</th>
                <th class="px-4 py-3">Pengguna</th>
                <th class="px-4 py-3">Artikel</th>
                <th class="px-4 py-3">Isi Komentar</th>
                <th class="px-4 py-3">Tanggal</th>
                <th class="px-4 py-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($comments as $c): ?>
                <tr class="border-t hover:bg-gray-50">
                  <td class="px-4 py-3 text-gray-500"><?= $no++ ?></td>
                  <td class="px-4 py-3">
                    <div class="font-semibold text-gray-800"><?= e($c['user_name']) ?></div>
                    <div class="text-xs text-gray-400"><?= e($c['user_email']) ?></div>
                  </td>
                  <td class="px-4 py-3">
                    <a href="../singlepost.php?slug=<?= urlencode($c['slug']) ?>"
                       class="text-indigo-600 hover:underline font-medium">
                      <?= e($c['article_title']) ?>
                    </a>
                  </td>
                  <td class="px-4 py-3 max-w-xs">
                    <div class="text-gray-700 line-clamp-3"><?= nl2br(e($c['body'])) ?></div>
                  </td>
                  <td class="px-4 py-3 text-gray-500">
                    <?= e(date('d M Y H:i', strtotime($c['created_at']))) ?>
                  </td>
                  <td class="px-4 py-3 text-center">
                    <form method="post" action="../../app/process_comment.php" onsubmit="return confirm('Hapus komentar ini?')">
                      <input type="hidden" name="_csrf_token" value="<?= e(csrf_token()) ?>">
                      <input type="hidden" name="delete_id" value="<?= e($c['id']) ?>">
                      <button type="submit" name="action" value="delete"
                        class="inline-flex items-center px-3 py-2 rounded-lg bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-medium shadow hover:from-red-600 hover:to-pink-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                          <path d="M6 19a2 2 0 002 2h8a2 2 0 002-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                        </svg>
                        Hapus
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </main>
</div>

