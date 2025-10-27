<?php include __DIR__ . '/_header.php'; ?>
<!-- 🎵 Hero Banner / Carousel -->
<section class="relative w-full h-[450px] overflow-hidden bg-gray-900 text-white">
  <!-- Carousel Wrapper -->
  <div id="carousel" class="relative w-full h-full">
    <!-- Slide 1 -->
    <div class="carousel-slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-700 ease-in-out"
      style="background-image: url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?auto=format&fit=crop&w=1600&q=80');">
      <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Temukan Irama Baru Setiap Hari</h1>
        <p class="max-w-xl text-lg mb-5 text-indigo-100">Rasakan pengalaman musik tanpa batas — dengarkan, beli, dan bagikan lagu favoritmu.</p>
        <a href="#join" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold">Mulai Sekarang</a>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-700 ease-in-out"
      style="background-image: url('https://images.unsplash.com/photo-1515202913167-d9a698095ebf?auto=format&fit=crop&w=1600&q=80');">
      <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Berita Musik Terkini</h1>
        <p class="max-w-xl text-lg mb-5 text-indigo-100">Selalu update dengan tren, konser, dan rilisan terbaru dari dunia musik global.</p>
        <a href="#news" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold">Lihat Berita</a>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-700 ease-in-out"
      style="background-image: url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=1600&q=80');">
      <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Bangun Komunitas Musikmu</h1>
        <p class="max-w-xl text-lg mb-5 text-indigo-100">Gabung bersama ribuan pengguna untuk berbagi inspirasi dan cerita di dunia musik.</p>
        <a href="#join" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold">Gabung Sekarang</a>
      </div>
    </div>
  </div>

  <!-- Tombol Navigasi -->
  <button id="prevBtn" class="absolute left-5 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-40 hover:bg-opacity-60 text-white px-3 py-2 rounded-full">
    &#10094;
  </button>
  <button id="nextBtn" class="absolute right-5 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-40 hover:bg-opacity-60 text-white px-3 py-2 rounded-full">
    &#10095;
  </button>

  <!-- Indikator Bawah -->
  <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-3">
    <span class="dot w-3 h-3 rounded-full bg-white opacity-50 cursor-pointer"></span>
    <span class="dot w-3 h-3 rounded-full bg-white opacity-50 cursor-pointer"></span>
    <span class="dot w-3 h-3 rounded-full bg-white opacity-50 cursor-pointer"></span>
  </div>
</section>


<!-- Trending Songs Section -->
<section class="py-16 bg-gray-50" id="trending-songs">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">🎵 Trending Songs</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
      <!-- Song Card -->
      <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
        <img src="https://images.unsplash.com/photo-1511376777868-611b54f68947?auto=format&fit=crop&w=500&q=60" alt="Album" class="w-full h-48 object-cover">
        <div class="p-4 flex flex-col justify-between h-40">
          <div>
            <h3 class="text-lg font-semibold text-gray-800">Blinding Lights</h3>
            <p class="text-gray-500 text-sm">The Weeknd</p>
          </div>
          <div class="flex items-center justify-between mt-4">
            <button class="flex items-center bg-indigo-600 text-white text-sm px-3 py-2 rounded-lg hover:bg-indigo-700 transition">
              <img src="https://img.icons8.com/ios-filled/24/ffffff/shopping-cart.png" class="w-4 h-4 mr-1" alt="cart">
              Add to Cart
            </button>
            <div class="flex items-center space-x-1 text-gray-600">
              <img src="https://img.icons8.com/emoji/24/000000/red-heart.png" class="w-5 h-5" alt="heart">
              <span class="text-sm font-medium">1.2K</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Duplicate this card with different data -->
      <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
        <img src="https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?auto=format&fit=crop&w=500&q=60" alt="Album" class="w-full h-48 object-cover">
        <div class="p-4 flex flex-col justify-between h-40">
          <div>
            <h3 class="text-lg font-semibold text-gray-800">Levitating</h3>
            <p class="text-gray-500 text-sm">Dua Lipa</p>
          </div>
          <div class="flex items-center justify-between mt-4">
            <button class="flex items-center bg-indigo-600 text-white text-sm px-3 py-2 rounded-lg hover:bg-indigo-700 transition">
              <img src="https://img.icons8.com/ios-filled/24/ffffff/shopping-cart.png" class="w-4 h-4 mr-1" alt="cart">
              Add to Cart
            </button>
            <div class="flex items-center space-x-1 text-gray-600">
              <img src="https://img.icons8.com/emoji/24/000000/red-heart.png" class="w-5 h-5" alt="heart">
              <span class="text-sm font-medium">984</span>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
        <img src="https://images.unsplash.com/photo-1485579149621-3123dd979885?auto=format&fit=crop&w=500&q=60" alt="Album" class="w-full h-48 object-cover">
        <div class="p-4 flex flex-col justify-between h-40">
          <div>
            <h3 class="text-lg font-semibold text-gray-800">Shape of You</h3>
            <p class="text-gray-500 text-sm">Ed Sheeran</p>
          </div>
          <div class="flex items-center justify-between mt-4">
            <button class="flex items-center bg-indigo-600 text-white text-sm px-3 py-2 rounded-lg hover:bg-indigo-700 transition">
              <img src="https://img.icons8.com/ios-filled/24/ffffff/shopping-cart.png" class="w-4 h-4 mr-1" alt="cart">
              Add to Cart
            </button>
            <div class="flex items-center space-x-1 text-gray-600">
              <img src="https://img.icons8.com/emoji/24/000000/red-heart.png" class="w-5 h-5" alt="heart">
              <span class="text-sm font-medium">2.3K</span>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
        <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?auto=format&fit=crop&w=500&q=60" alt="Album" class="w-full h-48 object-cover">
        <div class="p-4 flex flex-col justify-between h-40">
          <div>
            <h3 class="text-lg font-semibold text-gray-800">Peaches</h3>
            <p class="text-gray-500 text-sm">Justin Bieber</p>
          </div>
          <div class="flex items-center justify-between mt-4">
            <button class="flex items-center bg-indigo-600 text-white text-sm px-3 py-2 rounded-lg hover:bg-indigo-700 transition">
              <img src="https://img.icons8.com/ios-filled/24/ffffff/shopping-cart.png" class="w-4 h-4 mr-1" alt="cart">
              Add to Cart
            </button>
            <div class="flex items-center space-x-1 text-gray-600">
              <img src="https://img.icons8.com/emoji/24/000000/red-heart.png" class="w-5 h-5" alt="heart">
              <span class="text-sm font-medium">756</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ====== LATEST NEWS SECTION ====== -->
<section id="news" class="py-16 bg-gray-50">
  <div class="container mx-auto px-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">
      📰 Berita Musik Terkini
    </h2>

    <?php
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/../app/functions.php';

    if (session_status() === PHP_SESSION_NONE)
        session_start();

    // ====== AMBIL ARTIKEL ======
    $limit = 3;
    $offset = 0;

    $sql = "SELECT a.id, a.title, a.slug, a.featured_image, a.content, a.created_at, u.name AS author,
            (SELECT COUNT(*) FROM likes l WHERE l.article_id = a.id) AS like_count,
            (SELECT COUNT(*) FROM comments c WHERE c.article_id = a.id AND c.is_approved = 1) AS comment_count
            FROM articles a
            LEFT JOIN users u ON a.author_id = u.id
            ORDER BY a.created_at DESC
            LIMIT ? OFFSET ?";

    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $limit, $offset);
    mysqli_stmt_execute($stmt);
    $articles = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    // ====== Jika login, ambil daftar artikel yang sudah di-like user ======
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
    ?>

    <div class="grid md:grid-cols-3 gap-8">
      <?php if (count($articles) > 0): ?>
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
      <?php else: ?>
        <p class="col-span-3 text-center text-gray-500">
          Belum ada artikel yang tersedia.
        </p>
      <?php endif; ?>
    </div>
  </div>
</section>





<!-- 🚀 CTA Section -->
<section id="join" class="bg-violet-700  text-slate-200 py-16 text-center">
    <h2 class="text-3xl font-bold mb-4">Gabung Bersama Komunitas Musik Terbesar!</h2>
    <p class="max-w-2xl mx-auto mb-6 text-indigo-100">Tulis berita musikmu, beli lagu favoritmu, dan bergabung dengan
        ribuan pecinta musik lainnya di MelodySphere.</p>
    <a href="#" class="bg-white text-indigo-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Daftar
        Sekarang</a>
</section>

<script>
  const slides = document.querySelectorAll(".carousel-slide");
  const dots = document.querySelectorAll(".dot");
  let currentIndex = 0;
  let autoPlayInterval;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.style.opacity = i === index ? 1 : 0;
      dots[i].style.opacity = i === index ? 1 : 0.5;
    });
    currentIndex = index;
  }

  function nextSlide() {
    let newIndex = (currentIndex + 1) % slides.length;
    showSlide(newIndex);
  }

  function prevSlide() {
    let newIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(newIndex);
  }

  function startAutoPlay() {
    autoPlayInterval = setInterval(nextSlide, 5000); // ganti slide tiap 5 detik
  }

  document.getElementById("nextBtn").addEventListener("click", () => {
    clearInterval(autoPlayInterval);
    nextSlide();
    startAutoPlay();
  });

  document.getElementById("prevBtn").addEventListener("click", () => {
    clearInterval(autoPlayInterval);
    prevSlide();
    startAutoPlay();
  });

  dots.forEach((dot, i) => {
    dot.addEventListener("click", () => {
      clearInterval(autoPlayInterval);
      showSlide(i);
      startAutoPlay();
    });
  });

  // tampilkan slide pertama
  showSlide(0);
  startAutoPlay();
</script>
<?php include __DIR__ . '/_footer.php'; ?>