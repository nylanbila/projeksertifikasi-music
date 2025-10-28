<?php
require_once __DIR__ . '/../../app/auth.php';
require_once __DIR__ . '/../../app/functions.php';
require_once __DIR__ . '/../../config/config.php';

if (session_status() === PHP_SESSION_NONE) session_start();
require_login();

$user_id = (int)$_SESSION['user_id'];

// ambil komentar user beserta artikel terkait
$stmt = $koneksi->prepare("
  SELECT c.id, c.body, c.created_at, a.id AS article_id, a.title, a.slug
  FROM comments c
  JOIN articles a ON a.id = c.article_id
  WHERE c.user_id = ?
  ORDER BY c.created_at DESC
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$myComments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

include __DIR__ . '/_header_users.php';
?>

<div class="flex min-h-screen bg-gray-50">
  <!-- Sidebar -->
  <?php include __DIR__ . '/_sidebar_users.php'; ?>

  <!-- Konten utama -->
  <main class="flex-1 p-10 overflow-y-auto">
    <div class="max-w-5xl mx-auto">
      <!-- Judul Halaman -->
      <h1 class="text-3xl font-bold text-gray-800 mb-2">Komentar Saya 💬</h1>
      <p class="text-gray-500 mb-8">Berikut adalah komentar yang sudah kamu tulis pada artikel di <span class="text-indigo-600 font-semibold">Melody Sphere</span>.</p>

      <?php if (empty($myComments)): ?>
        <div class="bg-white rounded-2xl shadow-md p-8 text-center text-gray-600">
          <p class="text-lg">Kamu belum menulis komentar apa pun 😅</p>
        </div>
      <?php else: ?>
        <div class="space-y-6">
          <?php foreach ($myComments as $c): ?>
            <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-lg transition p-6">
              <!-- Header Komentar -->
              <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3">
                <div>
                  <a href="../singlepost.php?slug=<?= urlencode($c['slug']) ?>"
                     class="text-lg font-semibold text-indigo-600 hover:underline">
                    <?= e($c['title']) ?>
                  </a>
                  <div class="text-xs text-gray-400 mt-1">
                    Diposting pada <?= e(date('d M Y H:i', strtotime($c['created_at']))) ?>
                  </div>
                </div>

                <!-- Tombol Hapus -->
                <form method="post" action="../../app/process_comment.php" class="mt-3 md:mt-0">
                  <input type="hidden" name="_csrf_token" value="<?= e(csrf_token()) ?>">
                  <input type="hidden" name="delete_id" value="<?= e($c['id']) ?>">
                  <button type="submit" name="action" value="delete"
                          class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-medium shadow hover:from-red-600 hover:to-pink-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M6 19a2 2 0 002 2h8a2 2 0 002-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                    </svg>
                    Hapus
                  </button>
                </form>
              </div>

              <!-- Isi Komentar -->
              <p class="text-gray-700 leading-relaxed border-t pt-3"><?= nl2br(e($c['body'])) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </main>
</div>

<?php include __DIR__ . '/_footer_users.php'; ?>
