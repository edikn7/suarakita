<?php
echo $_SESSION['admin_username'];
?>

<header class="fixed top-0 left-64 right-0 h-20 bg-white shadow flex items-center px-6 z-40 transition-all">

    <!-- Judul -->
    <div class="flex-1">
        <h1 class="text-xl font-bold text-navy">Dashboard Admin</h1>
        <p class="text-sm text-gray-500">Sistem Pengaduan Siswa</p>
    </div>

    <!-- User Info -->
    <div class="flex items-center gap-4">
        <div class="text-right">
            <p class="text-sm font-semibold text-navy">
                <?= $adminUsername; ?>
            </p>
            <p class="text-xs text-gray-500">Admin Sekolah</p>
        </div>
        <!--Profil Admin-->
        <a href="profil_admin.php">
            <img src="../assets/img/profil.webp" alt="User Icon" class="w-10 h-10 rounded-full object-cover">
        </a>
    </div>

</header>
