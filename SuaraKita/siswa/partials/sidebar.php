<?php
echo $_SESSION['siswa_username'];

// Ambil nama file yang sedang dibuka (buat menu aktif)
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside id="sidebar"
       class="fixed top-0 left-0 h-full w-64 bg-mint shadow-md
              flex flex-col transition-transform duration-300 z-50 border-r border-grey-400">

    <!-- Logo -->
    <div class="h-20 flex items-center justify-center">
        <img src="../assets/img/logoSuaraKita.png" alt="Logo Sekolah" class="h-24 w-auto">
    </div>

    <!-- Menu -->
    <nav class="flex-1 py-6 space-y-2">
        <a href="dashboard_siswa.php"
           class="block px-14 py-3 rounded-lg mt-7 relative text-teal
            <?= $current_page == 'dashboard_siswa.php' ? 'text-navy font-semibold after:absolute after:left-12 after:right-12 after:bottom-2 after:h-0.5 after:bg-teal-500' : 'text-gray-800 hover:text-navy hover:after:absolute hover:after:left-12 hover:after:right-12 hover:after:bottom-2 hover:after:h-0.5 hover:after:bg-teal-400' ?>">
            <svg class="w-5 h-5 inline-block mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Dashboard
        </a>

        <a href="buat_pengaduan.php"
           class="block px-14 py-3 rounded-lg relative text-teal
            <?= $current_page == 'buat_pengaduan.php' ? 'text-navy font-semibold after:absolute after:left-12 after:right-12 after:bottom-2 after:h-0.5 after:bg-teal-500' : 'text-gray-800 hover:text-navy hover:after:absolute hover:after:left-12 hover:after:right-12 hover:after:bottom-2 hover:after:h-0.5 hover:after:bg-teal-400' ?>">
            <svg class="w-5 h-5 inline-block mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Pengaduan
        </a>

        <a href="riwayat_pengaduan.php"
           class="block px-14 py-3 rounded-lg relative text-teal
            <?= $current_page == 'riwayat_pengaduan.php' ? 'text-navy font-semibold after:absolute after:left-12 after:right-12 after:bottom-2 after:h-0.5 after:bg-teal-500' : 'text-gray-800 hover:text-navy hover:after:absolute hover:after:left-12 hover:after:right-12 hover:after:bottom-2 hover:after:h-0.5 hover:after:bg-teal-400' ?>">
            <svg class="w-5 h-5 inline-block mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5.121 17.804A9.001 9.001 0 0112 15c2.21 0 4.21.805 5.879 2.146M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Riwayat
        </a>
        
        <hr class="my-5 border-gray-300">   

        <a href="../auth/logout.php"
           class="block px-14 py-3 rounded-lg text-red-500 hover:text-red-700 ">
            <svg class="w-5 h-5 inline-block mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Logout
        </a>
    </nav>
</aside>
