<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once __DIR__ . '/../app/functions.php';

$logged = isset($_SESSION['user_id']);
$current = basename($_SERVER['PHP_SELF']);


// helper: tentukan link dashboard berdasarkan role
function dashboard_link_for_role()
{
    $role = $_SESSION['user_role'] ?? 'user';
    if ($role === 'admin') {
        return 'admin/admin_dashboard.php'; // atau 'admin/' kalau index.php di folder admin
    }
    return 'users/users_dashboard.php'; // atau 'users/'
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Store</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex flex-col bg-gray-50 text-gray-800">
    <!-- Header -->
    <header class="bg-violet-700 border-b border-violet-800 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            <!-- Logo -->
            <a href="index.php" class="flex items-center space-x-2">
                <span class="text-3xl font-extrabold text-slate-200">Melody Sphere</span>
            </a>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="index.php" class="text-lg text-slate-200 hover:text-slate-400 transition">Beranda</a>
                <a href="produk.php" class="text-lg text-slate-200 hover:text-slate-400">Produk</a>
                <a href="articles.php" class="text-lg text-slate-200 hover:text-slate-400">Article</a>
                <a href="events.php" class="text-lg text-slate-200 hover:text-slate-400">Event</a>
                <a href="about.php" class="text-lg text-slate-200 hover:text-slate-400">Tentang</a>
            </nav>

            <!-- Right Menu -->
            <div class="flex items-center space-x-4">
                <!-- Cart -->
                <a href="cart.php" class="relative hover:opacity-80 transition">
                    <img src="https://img.icons8.com/?size=100&id=85180&format=png&color=D8D8D8" alt="Cart Icon"
                        class="w-6 h-6 invert">
                    <span class="absolute -top-1 -right-2 bg-red-500 text-xs rounded-full px-1">2</span>
                </a>


                <?php if (!$logged): ?>
                    <!-- not logged: show register / login -->
                    <a href="login.php"
                        class="bg-slate-200 px-4 py-2 rounded-full text-sm font-medium hover:bg-slate-400 transition">Masuk</a>
                <?php else: ?>
                    <!-- logged: show profile button -->
                    <div class="relative" id="profileDropdownRoot">
                        <button id="profileBtn" aria-expanded="false" aria-haspopup="true"
                            class="flex items-center gap-3 px-3 py-1 rounded hover:bg-indigo-500/30 focus:outline-none focus:ring-2 focus:ring-white">
                            <!-- Avatar (ui-avatars) -->
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($_SESSION['user_name'] ?? 'User') ?>&background=4f46e5&color=fff&rounded=true"
                                alt="avatar" class="w-8 h-8 rounded-full border-2 border-white/30 shadow-sm">
                            <span class="text-sm"><?= e($_SESSION['user_name'] ?? 'User') ?></span>
                            <!-- caret -->
                            <svg id="caret" class="w-4 h-4 text-white/90" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div id="profileDropdown"
                            class="hidden dropdown-enter absolute right-0 mt-2 w-40 bg-white text-gray-800 rounded-md shadow-lg ring-1 ring-black/10 z-50 overflow-hidden">
                            <a href="<?= dashboard_link_for_role() ?>"
                                class="block px-4 py-2 text-sm hover:bg-gray-100">Dashboard</a>
                            <form action="logout.php" method="POST" class="m-0">
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>
    </header>
</body>
<script>
  // Dropdown logic: toggle + close on outside click + ESC
  (function(){
    const btn = document.getElementById('profileBtn');
    const dd = document.getElementById('profileDropdown');
    if (!btn || !dd) return;

    function openDropdown() {
      dd.classList.remove('hidden');
      btn.setAttribute('aria-expanded', 'true');
    }
    function closeDropdown() {
      dd.classList.add('hidden');
      btn.setAttribute('aria-expanded', 'false');
    }
    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      if (dd.classList.contains('hidden')) openDropdown(); else closeDropdown();
    });

    // click outside
    document.addEventListener('click', (e) => {
      if (!dd.classList.contains('hidden')) {
        if (!dd.contains(e.target) && !btn.contains(e.target)) closeDropdown();
      }
    });

    // esc
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeDropdown();
    });
  })();
</script>
</html>