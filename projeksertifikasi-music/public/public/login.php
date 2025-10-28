<?php include __DIR__ . '/_header.php'; ?>

<!-- Bungkus seluruh konten login dengan flex agar posisinya di tengah -->
<main class="min-h-screen flex items-center justify-center bg-[url('https://images.unsplash.com/photo-1487180144351-b8472da7d491?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1172')] bg-cover bg-center">
  <div class="bg-violet-300 text-gray-900 rounded-2xl shadow-xl w-full max-w-md p-8">
    <h1 class="text-3xl font-bold text-center mb-2">Melody Sphere</h1>
    <p class="text-center text-gray-700 mb-6">Masuk untuk melanjutkan</p>

    <form action="../app/process_login.php" method="POST" class="space-y-5">
      <div>
        <label for="email" class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" id="email" required
          class="w-full px-4 py-2 rounded bg-white border border-gray-300 focus:ring-2 focus:ring-violet-500 focus:outline-none">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium mb-1">Password</label>
        <input type="password" name="password" id="password" required
          class="w-full px-4 py-2 rounded bg-white border border-gray-300 focus:ring-2 focus:ring-violet-500 focus:outline-none">
      </div>

      <button type="submit"
        class="w-full bg-violet-600 hover:bg-violet-700 transition text-white py-2 rounded font-semibold">
        Masuk
      </button>

      <p class="text-center text-sm text-gray-700 mt-3">
        Belum punya akun?
        <a href="register.php" class="text-violet-700 font-semibold hover:underline">Daftar Sekarang</a>
      </p>
    </form>
  </div>
</main>
<script>
  // Tangkap parameter success dari URL
  const params = new URLSearchParams(window.location.search);
  if (params.get('success') === '1') {
    alert('Registrasi berhasil! Silakan login menggunakan akun Anda.');
  } else if (params.get('success') === '2') {
    alert('Terjadi kesalahan saat registrasi. Silakan coba lagi.');
  }
</script>
<?php include __DIR__ . '/_footer.php'; ?>
