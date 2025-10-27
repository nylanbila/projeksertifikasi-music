<?php
// public/singlepost.php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/functions.php';
require_once __DIR__ . '/../app/auth.php'; // pastikan auth/session tersedia

// ambil slug dari URL
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

if ($slug === '') {
  header('Location: articles.php');
  exit;
}

// ambil artikel dari database
$stmt = mysqli_prepare($koneksi, "
  SELECT a.*, u.name AS author
  FROM articles a
  LEFT JOIN users u ON a.author_id = u.id
  WHERE a.slug = ?
  LIMIT 1
");
mysqli_stmt_bind_param($stmt, "s", $slug);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$article = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

// kalau artikel tidak ditemukan
if (!$article) {
  include __DIR__ . '/_header.php';
  echo '<div class="max-w-3xl mx-auto py-16 text-center">
          <h2 class="text-2xl font-semibold text-gray-700 mb-4">Artikel tidak ditemukan</h2>
          <a href="articles.php" class="text-indigo-600 hover:underline text-sm">← Kembali ke daftar artikel</a>
        </div>';
  include __DIR__ . '/_footer.php';
  exit;
}

include __DIR__ . '/_header.php';
?>

<main class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
  <article class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-8">
    
    <!-- Judul -->
    <h1 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">
      <?= e($article['title']) ?>
    </h1>

    <!-- Info author & tanggal -->
    <div class="flex flex-wrap items-center text-sm text-gray-500 mb-6">
      <span>Oleh <span class="font-semibold text-gray-700"><?= e($article['author'] ?? 'Admin') ?></span></span>
      <span class="mx-2">•</span>
      <span><?= date('d M Y', strtotime($article['created_at'])) ?></span>
    </div>

    <!-- Gambar utama -->
    <?php if (!empty($article['featured_image']) && file_exists(__DIR__ . '/' . $article['featured_image'])): ?>
      <div class="mb-8">
        <img
          src="<?= e($article['featured_image']) ?>"
          alt="<?= e($article['title']) ?>"
          class="w-full h-80 object-cover rounded-lg shadow"
        >
      </div>
    <?php endif; ?>

    <!-- Isi artikel -->
    <div class="prose prose-lg prose-indigo max-w-none text-gray-800 mb-10 leading-relaxed">
      <?= $article['content'] /* tampilkan HTML dari TinyMCE */ ?>
    </div>

    <!-- Komentar Section -->
    <?php
      $article_id = (int)$article['id'];
      $stmtC = $koneksi->prepare("
        SELECT c.id, c.body, c.created_at, c.user_id, u.name AS user_name
        FROM comments c
        LEFT JOIN users u ON u.id = c.user_id
        WHERE c.article_id = ? AND c.is_approved = 1
        ORDER BY c.created_at ASC
      ");
      $stmtC->bind_param("i", $article_id);
      $stmtC->execute();
      $comments = $stmtC->get_result()->fetch_all(MYSQLI_ASSOC);
      $stmtC->close();
    ?>

    <section id="comments" class="border-t pt-8 mt-10">
      <h3 class="text-xl font-semibold mb-5 text-gray-800">
        Komentar (<?= e(count($comments)) ?>)
      </h3>

      <!-- Form komentar -->
      <?php if (!empty($_SESSION['user_id'])): ?>
        <form method="post" action="../app/process_comment.php" class="mb-8 bg-gray-50 p-5 rounded-lg border border-gray-200">
          <input type="hidden" name="_csrf_token" value="<?= e(csrf_token()) ?>">
          <input type="hidden" name="article_id" value="<?= e($article_id) ?>">
          <input type="hidden" name="slug" value="<?= e($article['slug']) ?>">

          <textarea
            name="body"
            rows="4"
            class="w-full border border-gray-300 rounded-md p-3 text-gray-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Tulis komentar kamu di sini..."
            required></textarea>

          <div class="mt-3 flex items-center justify-between">
            <span class="text-xs text-gray-500">💬 Gunakan bahasa yang sopan dan santun ya.</span>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-5 py-2 rounded-lg shadow">
              Kirim Komentar
            </button>
          </div>
        </form>
      <?php else: ?>
        <div class="mb-8 text-sm text-gray-600">
          <a href="login.php" class="text-indigo-600 hover:underline font-medium">Login</a> untuk menulis komentar.
        </div>
      <?php endif; ?>

      <!-- List komentar -->
      <div class="space-y-5">
        <?php if (empty($comments)): ?>
          <div class="text-gray-600 italic">Belum ada komentar. Jadilah yang pertama!</div>
        <?php else: ?>
          <?php foreach ($comments as $c): ?>
            <div class="bg-gray-50 border border-gray-200 p-5 rounded-lg shadow-sm">
              <div class="flex justify-between items-start">
                <div>
                  <div class="font-semibold text-gray-800"><?= e($c['user_name'] ?? 'Guest') ?></div>
                  <div class="text-xs text-gray-500"><?= e(date('d M Y H:i', strtotime($c['created_at']))) ?></div>
                </div>

                <?php if (!empty($_SESSION['user_id']) && $_SESSION['user_id'] == $c['user_id']): ?>
                  <form method="post" action="../app/process_comment.php" class="ml-3">
                    <input type="hidden" name="_csrf_token" value="<?= e(csrf_token()) ?>">
                    <input type="hidden" name="delete_id" value="<?= e($c['id']) ?>">
                    <button
                      type="submit"
                      name="action"
                      value="delete"
                      class="text-xs text-red-500 hover:text-red-700 transition"
                    >
                      Hapus
                    </button>
                  </form>
                <?php endif; ?>
              </div>

              <p class="mt-3 text-gray-700 leading-relaxed whitespace-pre-wrap">
                <?= e($c['body']) ?>
              </p>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>

    <!-- Tombol kembali -->
    <div class="mt-10 text-right">
      <a href="articles.php" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
        ← Kembali ke daftar artikel
      </a>
    </div>

  </article>
</main>

<?php include __DIR__ . '/_footer.php'; ?>
