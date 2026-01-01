<?php
session_start();
include '../config.php';

// Cek apakah siswa sudah login
if (!isset($_SESSION['login']) || $_SESSION['level'] !== 'siswa') {
    header("Location: ../auth/login.php");
}

// Ambil data siswa dari session
$siswaUsername = $_SESSION['siswa_username'];
$sekolah_id = $_SESSION['sekolah_id'];

// Ambil data penganduan siswa ini
$q_total_pengaduan = mysqli_query(
    $config,
    "SELECT COUNT(id) AS total_pengaduan
     FROM pengaduan
     WHERE sekolah_id = '$sekolah_id'
     AND siswa_id = '{$_SESSION['siswa_id']}'"
);
$total_pengaduan = mysqli_fetch_assoc($q_total_pengaduan)['total_pengaduan'];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Siswa | SuaraKita</title>
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

<body class="bg-violet-50">

<?php include 'partials/sidebar.php'; ?>

<main class="pl-64 min-h-screen">
    <?php include 'partials/header.php'; ?>

     <!-- HEADER DASHBOARD -->
    <div class="p-6 mt-16">
        <h2 class="text-2xl font-bold text-navy mb-2">
                Halo, <?= htmlspecialchars($siswaUsername); ?>!
        </h2>
        <p class="text-gray-600">
            Ringkasan pengaduan dan aktivitas sekolah Anda
        </p>
    </div>

    <!-- STATISTIC CARDS -->
    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- Total Pengaduan -->
        <div class="bg-white p-6 rounded-lg shadow border-l-8 border-green flex items-center">
            <div class="flex-1">
                <h3 class="text-sm text-gray-500">Total Pengaduan</h3>
                <p class="text-3xl font-bold text-green">
                    <?= $total_pengaduan; ?>
                </p>
            </div>
        </div>

        <!-- Diproses -->
        <div class="bg-white p-6 rounded-lg shadow border-l-8 border-teal flex items-center">
            <div class="flex-1">
                <h3 class="text-sm text-gray-500">Sedang Diproses</h3>
                <p class="text-3xl font-bold text-teal">
                    <?php
                    $q_diproses = mysqli_query(
                        $config,
                        "SELECT COUNT(id) AS diproses
                         FROM pengaduan
                         WHERE sekolah_id = '$sekolah_id'
                         AND siswa_id = '{$_SESSION['siswa_id']}'
                         AND status = 'Diproses'"
                    );
                    $diproses = mysqli_fetch_assoc($q_diproses)['diproses'];
                    echo $diproses;
                    ?>
                </p>
            </div>
        </div>

        <!-- Selesai -->
        <div class="bg-white p-6 rounded-lg shadow border-l-8 border-navy flex items-center">
            <div class="flex-1">
                <h3 class="text-sm text-gray-500">Selesai</h3>
                <p class="text-3xl font-bold text-navy">
                    <?php
                    $q_selesai = mysqli_query(
                        $config,
                        "SELECT COUNT(id) AS selesai
                         FROM pengaduan
                         WHERE sekolah_id = '$sekolah_id'
                         AND siswa_id = '{$_SESSION['siswa_id']}'
                         AND status = 'Selesai'"
                    );
                    $selesai = mysqli_fetch_assoc($q_selesai)['selesai'];
                    echo $selesai;
                    ?>
                </p>
            </div>
        </div>
    </div>
    <!-- Tanggapan Pengaduan Terbaru -->
    <div class="p-6">
        <h2 class="text-2xl font-bold text-navy mb-6">
            Tanggapan Pengaduan Terbaru
        </h2>

        <div class="bg-white rounded-lg shadow p-6 space-y-4">

            <?php
            $siswa_id = $_SESSION['siswa_id'];
            $tanggapan_terbaru = mysqli_query(
                $config,
                "SELECT tp.pesan, tp.created_at, pg.judul
                 FROM tanggapan_pengaduan tp
                 JOIN pengaduan pg ON tp.pengaduan_id = pg.id
                 WHERE pg.siswa_id = '$siswa_id'
                 ORDER BY tp.created_at DESC
                 LIMIT 5"
            );

            if (mysqli_num_rows($tanggapan_terbaru) == 0): ?>
                <p class="text-gray-500 italic text-center">
                    Belum ada tanggapan.
                </p>
            <?php else:
                while ($row = mysqli_fetch_assoc($tanggapan_terbaru)): ?>
                    <div class="border-b pb-4">
                        <h3 class="text-lg font-semibold text-navy">
                            <?= htmlspecialchars($row['judul']); ?>
                        </h3>
                        <div class="text-gray-700 leading-relaxed mt-2 border border-gray-200 rounded p-3 bg-mint">
                            <p class="text-gray-700">
                            <?= nl2br(htmlspecialchars($row['pesan'])); ?>
                        </p>
                        <span class="text-xs text-gray-500 block">
                            <?= date('d M Y H:i', strtotime($row['created_at'])); ?>
                        </span>
                        </div>
                        <!-- Button Lihat Detail Pengaduan -->
                        <div class="mt-2">
                            <a href="riwayat_pengaduan.php"
                               class="text-teal font-semibold hover:underline">
                               Lihat Detail
                            </a>
                        </div>  
                    </div>
                <?php endwhile;
            endif; ?>
        </div>
    </div>
 


    <!-- Riwayat Pengaduan Terbaru -->
    <div class="p-6">
        <h2 class="text-2xl font-bold text-navy mb-6">
            Riwayat Pengaduan Terbaru
        </h2>

        <div class="bg-white rounded-lg shadow overflow-x-auto">

            <table class="w-full border-collapse">
                <thead class="bg-mint text-teal">
                    <tr>
                        <th class="px-4 py-3 border text-left">No</th>
                        <th class="px-4 py-3 border text-left">Judul Pengaduan</th>
                        <th class="px-4 py-3 border text-center">Status</th>
                        <th class="px-4 py-3 border text-center">Tanggal</th>
                        <th class="px-4 py-3 border text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $siswa_id = $_SESSION['siswa_id'];
                    $pengaduan = mysqli_query($config, "
                        SELECT *
                        FROM pengaduan
                        WHERE siswa_id = '$siswa_id'
                        ORDER BY created_at DESC
                        LIMIT 5
                    ");
                    if (mysqli_num_rows($pengaduan) > 0) :
                        $no = 1;
                        while ($p = mysqli_fetch_assoc($pengaduan)) : ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 border"><?= $no++; ?></td>
                        <td class="px-4 py-3 border"><?= htmlspecialchars($p['judul']); ?></td>
                        <td class="px-4 py-3 border text-center">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                <?php
                                    if ($p['status'] == 'dikirim') echo 'bg-yellow-100 text-yellow-700';
                                    elseif ($p['status'] == 'diproses') echo 'bg-blue-100 text-blue-700';
                                    elseif ($p['status'] == 'selesai') echo 'bg-emerald-100 text-emerald-700';
                                    else echo 'bg-green-100 text-green-700';
                                ?>">
                                <?= ucfirst($p['status']); ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 border text-center">
                            <?= date('d M Y', strtotime($p['created_at'])); ?>
                        </td>
                        <td class="px-4 py-3 border text-center">
                            <a href="detail_pengaduan.php?id=<?= $p['id']; ?>"
                               class="text-teal font-semibold hover:underline">
                               Detail
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <!--- Jika tidak ada pengaduan -->
                    <?php else : ?>
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 italic">
                            Belum ada pengaduan.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>




    <!--footer-->
    <footer class="p-6 text-center text-gray-500 text-sm">
        &copy; <?= date('Y'); ?> SuaraKita. All rights reserved.
    </footer>
        
</main>

</body>
</html>
