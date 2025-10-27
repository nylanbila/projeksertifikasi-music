<?php
require_once __DIR__ . '/../../app/auth.php';
require_once __DIR__ . '/../../app/functions.php';
require_once __DIR__ . '/../../config/config.php';

if (session_status() === PHP_SESSION_NONE) session_start();
require_login();

$user_id = (int)($_SESSION['user_id'] ?? 0);

// ambil semua artikel yang di-like user (pakai prepared)
$stmt = $koneksi->prepare("
  SELECT a.id, a.title, a.slug, a.featured_image, a.content, a.created_at, l.created_at AS liked_at
  FROM likes l
  JOIN articles a ON a.id = l.article_id
  WHERE l.user_id = ?
  ORDER BY l.created_at DESC
");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$liked = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

include __DIR__ . '/_header_users.php';
?>

<div class="flex min-h-screen bg-gray-50">
  <!-- Sidebar -->
  <?php include __DIR__ . '/_sidebar_users.php'; ?>

  <!-- Konten utama -->
  <main class="flex-1 p-10 overflow-y-auto">
    <div class="max-w-5xl mx-auto">
      <!-- Header -->
      <h1 class="text-3xl font-bold text-gray-800 mb-2">
        Postingan yang Kamu Sukai
      </h1>
      <p class="text-gray-500 mb-8">
        Berikut adalah daftar artikel yang pernah kamu beri <span class="text-indigo-600 font-semibold">Like</span>.
      </p>

      <?php if (empty($liked)): ?>
        <div class="bg-white rounded-2xl shadow-md p-8 text-center text-gray-600">
          <p class="text-lg">Kamu belum menyukai artikel apapun </p>
        </div>
      <?php else: ?>
        <div class="grid grid-cols-1 gap-6">
          <?php foreach ($liked as $a): ?>
            <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition border border-gray-100 p-6 flex flex-col md:flex-row md:items-center md:justify-between">
              
              <!-- Info Artikel -->
              <div class="md:flex-1">
                <a href="../singlepost.php?slug=<?= urlencode($a['slug']) ?>"
                   class="text-xl font-semibold text-indigo-600 hover:underline">
                  <?= e($a['title']) ?>
                </a>
                <div class="text-sm text-gray-500 mt-1">
                  Dipublikasikan: <?= e(date('d M Y', strtotime($a['created_at']))) ?>
                </div>
                <div class="text-xs text-gray-400 mt-1">
                  Kamu menyukai: <?= e(date('d M Y H:i', strtotime($a['liked_at']))) ?>
                </div>

                <?php
                  $excerpt = mb_substr(strip_tags($a['content'] ?? ''), 0, 150);
                ?>
                <p class="text-sm text-gray-700 mt-3 leading-relaxed">
                  <?= e($excerpt) ?><?= (mb_strlen($excerpt) >= 150 ? '...' : '') ?>
                </p>
              </div>

              <!-- Tombol Unlike -->
              <div class="mt-5 md:mt-0 md:ml-6 flex-shrink-0">
                <form method="post" action="../../app/process_like.php">
                  <input type="hidden" name="_csrf_token" value="<?= e(csrf_token()) ?>">
                  <input type="hidden" name="article_id" value="<?= e($a['id']) ?>">
                  <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-medium shadow hover:from-red-600 hover:to-pink-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 
                               2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 
                               4.5 2.09C13.09 3.81 14.76 3 16.5 3
                               19.58 3 22 5.42 22 8.5
                               c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                    Unlike
                  </button>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </main>
</div>

<?php include __DIR__ . '/_footer_users.php'; ?>
