<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>SuaraKita</title>
  <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html, body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }
    </style>
  <script src="https://cdn.tailwindcss.com"></script>
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            mint: '#DDF4E7',
            green: '#67C090',
            teal: '#26667F',
            navy: '#124170',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-violet-50" >
  
  <nav class="bg-white backdrop-blur-md shadow-lg border-b border-white/20 fixed w-full top-0 z-50 transition-all duration-500" id="navbar">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="relative flex justify-between items-center h-20">

      <!-- Logo -->
      <div class="flex items-center group">
        <img src="assets/img/logoSuaraKita.png"
             alt="Logo SuaraKita"
             class="h-20 w-50 rounded-3xl object-cover">
      </div>

      <!-- Menu -->
      <div class="absolute left-1/2 -translate-x-1/2 hidden md:flex">
        <div class="flex items-center space-x-1">

          <a href="#beranda" class="text-gray-800 font-semibold nav-link relative px-4 py-2 text-base transition-all duration-300 group">
            <span class="relative z-10">Beranda</span>
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-navy group-hover:w-12 transition-all duration-300"></div>
          </a>

          <a href="#pengaduan" class="text-gray-800 font-semibold nav-link relative px-4 py-2 text-text-base transition-all duration-300 group">
            <span class="relative z-10">Pengaduan</span>
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-navy group-hover:w-16 transition-all duration-300"></div>
          </a>

          <a href="#panduan" class="text-gray-800 font-semibold nav-link relative px-4 py-2 text-text-base transition-all duration-300 group">
            <span class="relative z-10">Panduan</span>
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-navy group-hover:w-12 transition-all duration-300"></div>
          </a>

        </div>
      </div>

      <!-- Login -->
      <div class="hidden md:flex items-center space-x-3">
        <a href="auth/login.php" class="text-black font-semibold nav-link relative px-4 py-2 text-base transition-all duration-300 group">
          <span class="relative z-10">Login →</span>
        </a>
      </div>

    </div>
  </div>
</nav>


</body>