<?php
echo $_SESSION['siswa_username'];
?>

<header class="fixed top-0 left-64 right-0 h-20 bg-white shadow-sm flex items-center px-6 z-40 transition-all">

    <!-- Judul -->
    <div class="flex-1">
        <h1 class="text-xl font-bold text-navy">Dashboard Siswa</h1>
        <p class="text-sm text-gray-500">Sistem Pengaduan Siswa</p>
    </div>

    <!-- User Info -->
    <div class="flex items-center gap-4">
        <div class="text-right">
            <p class="text-sm font-semibold text-navy">
                <?= $siswaUsername; ?>
            </p>
            <p class="text-xs text-gray-500">Siswa</p>
        </div>

        <!--Profil Siswa-->
        <a href="profil_siswa.php">
            <img src="../assets/img/profil.webp" alt="User Icon" class="w-10 h-10 rounded-full object-cover">
        </a>
    </div>

</header>
