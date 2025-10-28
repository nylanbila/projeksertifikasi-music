<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/functions.php';

if (session_status() === PHP_SESSION_NONE)
    session_start();

// ====== SEARCH & PAGINATION ======
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
$perPage = 6;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * $perPage;

// ====== WHERE CLAUSE ======
$whereSql = '';
$params = [];
$types = '';
if ($searchQuery !== '') {
    $whereSql = "WHERE (a.title LIKE ? OR a.content LIKE ?)";
    $like = '%' . $searchQuery . '%';
    $params = [$like, $like];
    $types = 'ss';
}

// ====== COUNT ARTICLES ======
$sqlCount = "SELECT COUNT(*) AS cnt FROM articles a $whereSql";
$stmt = mysqli_prepare($koneksi, $sqlCount);
if ($whereSql)
    mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$totalItems = (int) (mysqli_fetch_assoc($res)['cnt'] ?? 0);
mysqli_stmt_close($stmt);

$totalPages = max(1, ceil($totalItems / $perPage));

// ====== FETCH ARTICLES ======
$sql = "SELECT a.id, a.title, a.slug, a.featured_image, a.content, a.created_at, u.name AS author,
        (SELECT COUNT(*) FROM likes l WHERE l.article_id = a.id) AS like_count,
        (SELECT COUNT(*) FROM comments c WHERE c.article_id = a.id AND c.is_approved = 1) AS comment_count
        FROM articles a
        LEFT JOIN users u ON a.author_id = u.id
        $whereSql
        ORDER BY a.created_at DESC
        LIMIT ? OFFSET ?";
$stmt = mysqli_prepare($koneksi, $sql);
if ($whereSql)
    mysqli_stmt_bind_param($stmt, $types . 'ii', ...array_merge($params, [$perPage, $offset]));
else
    mysqli_stmt_bind_param($stmt, 'ii', $perPage, $offset);
mysqli_stmt_execute($stmt);
$articles = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

// ====== Jika login, ambil daftar artikel yang di-like user ======
$user_id = $_SESSION['user_id'] ?? 0;
$userLikes = [];
if ($user_id) {
    $stmt = $koneksi->prepare("SELECT article_id FROM likes WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $userLikes = array_column($res, 'article_id');
}

// ====== Helper untuk pagination ======
function build_page_url($p)
{
    $params = $_GET;
    $params['page'] = $p;
    return htmlspecialchars($_SERVER['PHP_SELF'] . '?' . http_build_query($params));
}

include __DIR__ . '/_header.php';
?>

<!-- ====== PAGE HEADER ====== -->
<section class="max-w-6xl mx-auto mt-10 px-4">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <div>
      <h2 class="text-3xl font-bold text-gray-800">Daftar Artikel</h2>
      <p class="text-gray-500 mt-1 text-sm">Temukan informasi terbaru dan menarik di sini.</p>
    </div>

    <form method="GET" action="articles.php" class="flex w-full md:w-auto gap-2">
      <input type="search" name="q" value="<?= htmlspecialchars($searchQuery) ?>"
        placeholder="Cari artikel..."
        class="w-full md:w-64 px-4 py-2.5 rounded-xl border border-gray-300 bg-white shadow-sm 
               focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-700 placeholder-gray-400 transition">
      <button
        class="bg-violet-700 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-md font-medium transition">
        Cari
      </button>
    </form>
  </div>
</section>

<!-- ====== ARTICLES GRID ====== -->
<section class="max-w-6xl mx-auto mt-10 px-4 mb-16">
  <?php if (count($articles) > 0): ?>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($articles as $a): ?>
        <div class="flex flex-col bg-white rounded-2xl shadow hover:shadow-xl transition border border-gray-100 overflow-hidden">
          
          <!-- Gambar -->
          <?php if ($a['featured_image'] && file_exists(__DIR__ . '/' . $a['featured_image'])): ?>
            <img src="<?= e($a['featured_image']) ?>" alt="<?= e($a['title']) ?>"
              class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
          <?php else: ?>
            <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
              Tidak ada gambar
            </div>
          <?php endif; ?>

          <!-- Konten Artikel -->
          <div class="flex flex-col flex-grow p-6">
            <h3 class="text-lg font-semibold text-gray-900 hover:text-indigo-600 transition mb-1">
              <a href="singlepost.php?slug=<?= urlencode($a['slug']) ?>"><?= e($a['title']) ?></a>
            </h3>

            <p class="text-sm text-gray-500 mb-3">
              <?= date('d M Y', strtotime($a['created_at'])) ?> • <?= e($a['author'] ?? 'Anonim') ?>
            </p>

            <?php
            $excerpt = strip_tags($a['content'] ?? '');
            $excerpt = mb_substr($excerpt, 0, 140);
            ?>
            <p class="text-gray-600 text-sm flex-grow leading-relaxed">
              <?= e($excerpt) ?><?= (mb_strlen($excerpt) >= 140 ? '...' : '') ?>
            </p>

            <!-- Footer Card -->
            <div class="flex items-center justify-between mt-5 pt-3 border-t border-gray-100">
              <div class="flex items-center gap-3 text-sm text-gray-600">
                <span class="flex items-center gap-1">💬 <?= (int)$a['comment_count'] ?></span>
                <span class="flex items-center gap-1">❤️ <?= (int)$a['like_count'] ?></span>
              </div>

              <?php if (!empty($_SESSION['user_id'])): ?>
                <form method="post" action="../app/process_like.php">
                  <input type="hidden" name="_csrf_token" value="<?= e(csrf_token()) ?>">
                  <input type="hidden" name="article_id" value="<?= e($a['id']) ?>">
                  <?php if (in_array($a['id'], $userLikes)): ?>
                    <button type="submit"
                      class="px-3 py-1.5 text-sm rounded-lg bg-red-500 hover:bg-red-600 text-white transition">
                      Unlike
                    </button>
                  <?php else: ?>
                    <button type="submit"
                      class="px-3 py-1.5 text-sm rounded-lg bg-indigo-500 hover:bg-indigo-600 text-white transition">
                      Like
                    </button>
                  <?php endif; ?>
                </form>
              <?php else: ?>
                <a href="login.php" class="text-sm text-indigo-600 hover:underline">Login untuk like</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="bg-white p-10 rounded-2xl shadow text-center border border-gray-200">
      <h3 class="text-lg font-semibold text-gray-800">Tidak ada artikel ditemukan</h3>
      <p class="mt-2 text-sm text-gray-500">
        Coba ubah kata kunci pencarian atau tunggu admin menambahkan artikel baru.
      </p>
    </div>
  <?php endif; ?>
</section>

<!-- ====== PAGINATION ====== -->
<?php if ($totalPages > 1): ?>
  <div class="max-w-6xl mx-auto mt-12 px-4 flex justify-center">
    <nav class="inline-flex rounded-xl shadow border border-gray-200 bg-white overflow-hidden">
      <?php if ($page > 1): ?>
        <a href="<?= build_page_url($page - 1) ?>" class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 border-r">← Sebelumnya</a>
      <?php else: ?>
        <span class="px-4 py-2 text-sm text-gray-400 bg-gray-50 border-r">← Sebelumnya</span>
      <?php endif; ?>

      <?php
      $pages = [];
      if ($totalPages <= 7) {
          for ($i = 1; $i <= $totalPages; $i++) $pages[] = $i;
      } else {
          $pages = [1, 2];
          $start = max(3, $page - 1);
          $end = min($totalPages - 2, $page + 1);
          if ($start > 3) $pages[] = '...';
          for ($i = $start; $i <= $end; $i++) $pages[] = $i;
          if ($end < $totalPages - 2) $pages[] = '...';
          $pages[] = $totalPages - 1;
          $pages[] = $totalPages;
      }
      ?>

      <?php foreach ($pages as $p): ?>
        <?php if ($p === '...'): ?>
          <span class="px-3 py-2 text-sm text-gray-400">...</span>
        <?php elseif ($p == $page): ?>
          <span class="px-4 py-2 text-sm bg-indigo-600 text-white font-semibold"><?= $p ?></span>
        <?php else: ?>
          <a href="<?= build_page_url($p) ?>" class="px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-700 font-medium">
            <?= $p ?>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>

      <?php if ($page < $totalPages): ?>
        <a href="<?= build_page_url($page + 1) ?>" class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 border-l">Selanjutnya →</a>
      <?php else: ?>
        <span class="px-4 py-2 text-sm text-gray-400 bg-gray-50 border-l">Selanjutnya →</span>
      <?php endif; ?>
    </nav>
  </div>
<?php endif; ?>

<?php include __DIR__ . '/_footer.php'; ?>
