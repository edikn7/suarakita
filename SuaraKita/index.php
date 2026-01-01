<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuaraKita | Sistem Pengaduan Siswa</title>
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
                    },
                },
            },
        }
    </script>

</head>
<body id="beranda" class=" bg-violet-50">
    <!-- Navbar -->
    <?php include 'partials/header.php'; ?>

    <!-- Content -->
    <main class="bg-violet-50 mt-10">
    <!-- HERO SECTION -->
    <section class="relative h-[85vh] pt-20 flex items-center justify-center">

        <!-- Background Image -->
        <img 
            src="assets/img/123.jpg" 
            alt="Suasana Sekolah"
            class="absolute inset-0 w-full h-full object-cover"
        >

        <!-- Overlay -->
        <div class="absolute inset-0 bg-navy/65"></div>

            <div class="relative z-10 text-center text-white px-6 max-w-4xl">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    SuaraKita
                </h1>
                <h3 class="text-xl md:text-3xl font-bold pt-5 leading-tight">
                    Suarakan Aspirasi, Bangun Sekolah Lebih Baik!
                </h3>
               


                <p class="mt-6 text-lg md:text-xl text-gray-200">
                    Platform aman dan transparan bagi siswa untuk menyampaikan
                    pengaduan, kritik, dan aspirasi demi lingkungan sekolah yang lebih sehat dan adil.
                </p>

                <div class="mt-10 flex justify-center gap-4 flex-wrap">
                    <a href="auth/login.php" class="bg-gradient-to-t from-green to-mint text-navy/80   px-8 py-3 rounded-full font-semibold hover:bg- hover: transition">
                        Mulai Pengaduan
                    </a>

                    <a href="#fitur" class="border border-white px-8 py-3 rounded-full font-semibold hover:bg-mint hover:text-navy transition">
                        Pelajari Lebih Lanjut →
                    </a>
                </div>
            </div>
        </section>

    <!-- About Section -->
    <section id="tentang" class="py-20 bg-violet-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-navy mb-4 fade-in">Tentang SuaraKita</h2>
                <p class="text-xl text-gray-600 fade-in">Suarakan Aspirasi, Bangun Sekolah Lebih Baik!</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <h3 class="text-2xl font-bold text-navy mb-6">Kenapa SuaraKita?</h3>
                    <p class="text-gray-600">SuaraKita adalah platform digital berbasis web yang menyediakan ruang aman bagi siswa untuk menyampaikan aspirasi, kritik, dan pengaduan secara terstruktur dan bertanggung jawab.</p>
                    <p class="text-gray-600 mt-4">Aplikasi ini hadir sebagai solusi atas minimnya media komunikasi yang efektif antara siswa dan pihak sekolah. Melalui sistem yang transparan dan terdokumentasi, setiap aspirasi yang masuk dapat dipantau, ditanggapi, dan ditindaklanjuti dengan jelas.</p>              
                </div>
                <div class="fade-in">
                    <div class="bg-gradient-to-b from-emerald-50 to-mint p-8 rounded-3xl shadow-md">
                        <div class="text-center">
                            <img src="assets/img/logovisi.png" alt="Misi dan Visi" class="mx-auto mb-6 w-32 h-32 object-contain">
                            <h4 class="text-xl font-bold text-navy mb-4">Visi Kami</h4>
                            <p class="text-gray-600">Mewujudkan ruang aman bagi setiap siswa untuk bersuara, beraspirasi, dan berkontribusi dalam membangun sekolah yang lebih baik.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-20 bg-gradient-to-b from-mint to-emerald-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Judul Section -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-navy mb-4 fade-in">
                Fitur Unggulan
            </h2>
            <p class="text-xl text-gray-600 fade-in">
                Dirancang untuk mendukung aspirasi siswa dan transparansi sekolah.
            </p>
        </div>

        <!-- Grid Fitur -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Fitur 1: Sistem Pengaduan -->
            <div class="service-card bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all transform hover:scale-105">
                <img src="assets/img/dash.png" alt="Sistem Pengaduan" class="mx-auto mb-4 w-20 h-20 object-contain">
                <h3 class="text-xl font-bold text-navy mb-4 text-center">
                    Sistem Pengaduan
                </h3>
                <p class="text-gray-600 text-justify mb-6">
                    Wadah resmi bagi siswa untuk menyampaikan pengaduan, kritik,
                    dan aspirasi secara aman dan terstruktur.
                </p>
                <div class="text-center">
                    <span class="text-navy font-semibold">
                        Aman & Terdokumentasi
                    </span>
                </div>
            </div>

            <!-- Fitur 2: Dashboard Admin -->
            <div class="service-card bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all transform hover:scale-105">
                <img src="assets/img/logodash.png" alt="Dashboard Admin" class="mx-auto mb-4 w-20 h-20 object-contain">
                <h3 class="text-xl font-bold text-navy mb-4 text-center">
                    Dashboard Admin
                </h3>
                <p class="text-gray-600 text-justify mb-6">
                    Dashboard profesional untuk admin sekolah dalam memantau,
                    mengelola, dan menindaklanjuti setiap pengaduan secara transparan.
                </p>
                <div class="text-center">
                    <span class="text-navy font-semibold">
                        Kontrol Penuh & Terarah
                    </span>
                </div>
            </div>

            <!-- Fitur 3: Manajemen Siswa -->
            <div class="service-card bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all transform hover:scale-105">
                <img src="assets/img/logodash (1).png" alt="Manajemen Siswa" class="mx-auto mb-4 w-20 h-20 object-contain">
                <h3 class="text-xl font-bold text-navy mb-4 text-center">
                    Manajemen Siswa
                </h3>
                <p class="text-gray-600 text-justify mb-6">
                    Sistem pengelolaan data siswa berbasis sekolah untuk memastikan
                    setiap pengaduan berasal dari akun yang valid dan terverifikasi.
                </p>
                <div class="text-center">
                    <span class="text-navy font-semibold">
                        Valid, Aman, dan Terpercaya
                    </span>
                </div>
            </div>

            <!-- Fitur 4: Riwayat & Tanggapan -->
            <div class="service-card bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all transform hover:scale-105">
                <img src="assets/img/logovisi.png" alt="Riwayat dan Tanggapan" class="mx-auto mb-4 w-20 h-20 object-contain">
                <h3 class="text-xl font-bold text-navy mb-4 text-justify">
                    Riwayat & Tanggapan
                </h3>
                <p class="text-gray-600 text-justify mb-6">
                    Siswa dapat memantau status pengaduan serta menerima dan
                    mengirim tanggapan sebagai bentuk komunikasi dua arah yang sehat.
                </p>
                <div class="text-center">
                    <span class="text-navy font-semibold">
                        Transparan & Interaktif
                    </span>
                </div>
            </div>

        </div>
    </div>
    </section>



    <!-- HERO SECTION -->
    <section class="relative bg-teal py-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <!-- Statistik -->
            <?php
            // Koneksi ke database
            require_once 'config.php'; // pastikan file ini ada dan benar

            // Query jumlah sekolah
            $sekolah = $config->query("SELECT COUNT(*) AS total FROM sekolah");
            $totalSekolah = $sekolah ? $sekolah->fetch_assoc()['total'] : 0;

            // Query jumlah pengaduan
            $pengaduan = $config->query("SELECT COUNT(*) AS total FROM pengaduan");
            $totalPengaduan = $pengaduan ? $pengaduan->fetch_assoc()['total'] : 0;

            // Query jumlah pengguna aktif
            $pengguna = $config->query("SELECT COUNT(*) AS total FROM users ");
            $totalPengguna = $pengguna ? $pengguna->fetch_assoc()['total'] : 0;

            // Query tingkat respons pengaduan
            $ditanggapi = $config->query("SELECT COUNT(*) AS total FROM pengaduan WHERE status='selesai'");
            $totalDitanggapi = $ditanggapi ? $ditanggapi->fetch_assoc()['total'] : 0;
            $persenRespons = $totalPengaduan > 0 ? round(($totalDitanggapi / $totalPengaduan) * 100) : 0;
            ?>

            <div class="grid grid-cols-2 md:grid-cols-4 text-center">

                <!-- Sekolah -->
                <div class="stat-item">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                        <?= $totalSekolah ?>+
                    </div>
                    <div class="text-cyan-100">
                        Sekolah Terdaftar
                    </div>
                </div>

                <!-- Pengaduan -->
                <div class="stat-item">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                        <?= $totalPengaduan ?>+
                    </div>
                    <div class="text-cyan-100">
                        Pengaduan Masuk
                    </div>
                </div>

                <!-- Pengguna -->
                <div class="stat-item">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                        <?= $totalPengguna ?>+
                    </div>
                    <div class="text-cyan-100">
                        Pengguna Aktif
                    </div>
                </div>

                <!-- Tingkat Respons -->
                <div class="stat-item">
                    <div class="text-4xl md:text-5xl font-bold text-white mb-2">
                        <?= $persenRespons ?>%
                    </div>
                    <div class="text-cyan-100">
                        Pengaduan Ditanggapi
                    </div>
                </div>
            </div>

        <!-- Aksen dekoratif -->
        <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-violet-50  opacity-30 rounded-full blur-3xl"></div>
        <div class="absolute top-10 -right-24 w-72 h-72 bg-green opacity-40 rounded-full blur-3xl"></div>
    </section>

    <!-- SECTION: PENGADUAN -->
    <section id="pengaduan" class="py-24 bg-gradient-to-b from-emerald-50 to-mint">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Judul Section -->
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-navy mb-4">
                    Sistem Pengaduan
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Sampaikan permasalahan secara aman, tercatat, dan dapat ditindaklanjuti oleh pihak sekolah.
                </p>
            </div>

            <!-- Card Pengaduan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                <!-- Card 1 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:-translate-y-1 transition">
                    <div class="w-14 h-14 rounded-xl bg-violet-50 flex items-center justify-center mb-6">
                        <span class="text-2xl font-bold text-teal">1</span>
                    </div>
                    <h3 class="text-xl font-semibold text-navy mb-3">
                        Tulis Pengaduan
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Siswa dapat menuliskan pengaduan atau aspirasi dengan bahasa yang sopan
                        dan jelas melalui sistem.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:-translate-y-1 transition">
                    <div class="w-14 h-14 rounded-xl bg-violet-50 flex items-center justify-center mb-6">
                        <span class="text-2xl font-bold text-teal">2</span>
                    </div>
                    <h3 class="text-xl font-semibold text-navy mb-3">
                        Diproses Sekolah
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Admin sekolah akan menerima dan meninjau setiap laporan sesuai
                        kewenangan dan prosedur yang berlaku.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl shadow-lg p-8 hover:-translate-y-1 transition">
                    <div class="w-14 h-14 rounded-xl bg-violet-50 flex items-center justify-center mb-6">
                        <span class="text-2xl font-bold text-teal">3</span>
                    </div>
                    <h3 class="text-xl font-semibold text-navy mb-3">
                        Tanggapan & Riwayat
                    </h3>
                    <p class="text-gray-600 leading-relaxed">
                        Siswa dapat melihat status dan tanggapan secara transparan
                        melalui riwayat pengaduan.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION: PANDUAN -->
    <section id="panduan" class="py-24 bg-violet-50">
        <div class="max-w-6xl mx-auto px-6">

            <!-- Judul -->
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-navy mb-4">
                    Panduan Penggunaan
                </h2>
                <p class="text-gray-600 text-lg">
                    Ikuti langkah sederhana berikut agar pengaduanmu efektif dan bertanggung jawab.
                </p>
            </div>

            <!-- List Panduan -->
            <div class="space-y-6">

                <!-- Item 1 -->
                <div class="bg-mint rounded-2xl shadow p-6 flex gap-6">
                    <div class="text-teal font-bold text-xl">01</div>
                    <div>
                        <h4 class="font-semibold text-navy mb-2">Gunakan Bahasa yang Sopan</h4>
                        <p class="text-gray-600">
                            Sampaikan permasalahan secara jelas tanpa kata kasar atau unsur provokatif.
                        </p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="bg-mint rounded-2xl shadow p-6 flex gap-6">
                    <div class="text-teal font-bold text-xl">02</div>
                    <div>
                        <h4 class="font-semibold text-navy mb-2">Sertakan Informasi yang Relevan</h4>
                        <p class="text-gray-600">
                            Jelaskan waktu, tempat, dan kronologi agar laporan mudah dipahami.
                        </p>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="bg-mint rounded-2xl shadow p-6 flex gap-6">
                    <div class="text-teal font-bold text-xl">03</div>
                    <div>
                        <h4 class="font-semibold text-navy mb-2">Pantau Status Pengaduan</h4>
                        <p class="text-gray-600">
                            Gunakan fitur riwayat untuk melihat perkembangan dan tanggapan dari sekolah.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    </main>

    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>

</body>
</html>