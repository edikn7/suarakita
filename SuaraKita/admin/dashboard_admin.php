
<?php
session_start();
include '../config.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['login']) || $_SESSION['level'] !== 'admin') {
    header("Location: ../auth/login.php");
}

// Ambil data admin dari session
$adminUsername = $_SESSION['admin_username'];

// Ambil nama sekolah admin
$sekolah_id = $_SESSION['sekolah_id'];
$nama_sekolah = $sekolah_id; // Default jika tidak ditemukan
$q_sekolah = mysqli_query(
    $config,
    "SELECT nama_sekolah FROM sekolah WHERE id = '$sekolah_id'"
);
if ($row = mysqli_fetch_assoc($q_sekolah)) {
    $nama_sekolah = $row['nama_sekolah'];
}

// Pastikan admin punya sekolah
if (!isset($_SESSION['sekolah_id'])) {
    header("Location: ../auth/login.php");
}



// Total pengaduan
$q_total_pengaduan = mysqli_query(
    $config,
    "SELECT COUNT(id) AS total_pengaduan
     FROM pengaduan
     WHERE sekolah_id = '$sekolah_id'"
);
$total_pengaduan = mysqli_fetch_assoc($q_total_pengaduan)['total_pengaduan'];

// Pengaduan diproses
$q_diproses = mysqli_query(
    $config,
    "SELECT COUNT(id) AS total_diproses
     FROM pengaduan
     WHERE sekolah_id = '$sekolah_id'
     AND status = 'diproses'"
);
$total_diproses = mysqli_fetch_assoc($q_diproses)['total_diproses'];

// Total siswa
$q_siswa = mysqli_query(
    $config,
    "SELECT COUNT(id) AS total_siswa
     FROM users
     WHERE sekolah_id = '$sekolah_id'
     AND level = 'siswa'"
);
$total_siswa = mysqli_fetch_assoc($q_siswa)['total_siswa'];

// DATA GRAFIK PENGADUAN PER BULAN
$q_grafik = mysqli_query(
    $config,
    "SELECT 
        MONTH(created_at) AS bulan,
        COUNT(id) AS total
     FROM pengaduan
     WHERE sekolah_id = '$sekolah_id'
     AND YEAR(created_at) = YEAR(CURDATE())
     GROUP BY MONTH(created_at)
     ORDER BY MONTH(created_at)"
);

$bulan = [];
$total_bulanan = [];

while ($row = mysqli_fetch_assoc($q_grafik)) {
    $bulan[] = $row['bulan'];
    $total_bulanan[] = $row['total'];
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | SuaraKita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html, body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }
    </style>
    <!-- Tailwind CSS -->
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

<body class="bg-violet-50">


<!-- SIDEBAR -->

<?php include 'partials/sidebar.php'; ?>


<!-- MAIN CONTENT -->

<main class="ml-64 min-h-screen">

    <!-- HEADER -->
    <?php include 'partials/header.php'; ?>

    <!-- HEADER DASHBOARD -->
    <div class="p-6 mt-16">
        <h1 class="text-2xl font-bold text-navy mb-2">
            Admin | 
            <?= htmlspecialchars($nama_sekolah); ?>
        </h1>
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
                    <?= $total_diproses; ?>
                </p>
            </div>
        </div>

        <!-- Total Siswa -->
        <div class="bg-white p-6 rounded-lg shadow border-l-8 border-navy flex items-center">
            <div class="flex-1">
                <h3 class="text-sm text-gray-500">Total Siswa</h3>
                <p class="text-3xl font-bold text-navy">
                    <?= $total_siswa; ?>
                </p>
            </div>
        </div>

    </div>

    <!-- DAFTAR PENGADUAN MASUK TERBARU -->
    <div class="p-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-navy mb-4">
                Pengaduan Masuk Terbaru
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-mint text-navy">
                            <th class="py-2 px-4 text-left">Tanggal</th>
                            <th class="py-2 px-4 text-left">Judul</th>
                            <th class="py-2 px-4 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q_terbaru = mysqli_query(
                            $config,
                            "SELECT id, judul, status, created_at 
                             FROM pengaduan 
                             WHERE sekolah_id = '$sekolah_id'
                             ORDER BY created_at DESC
                             LIMIT 5"
                        );
                        if (mysqli_num_rows($q_terbaru) > 0):
                            while ($row = mysqli_fetch_assoc($q_terbaru)):
                        ?>
                        <tr class="border-b">
                            <td class="py-2 px-4"><?= date('d-m-Y', strtotime($row['created_at'])); ?></td>
                            <td class="py-2 px-4"><?= htmlspecialchars($row['judul']); ?></td>
                            <td class="py-2 px-4">
                                <span class="inline-block px-2 py-1 rounded-full
                                    <?php
                                        if ($row['status'] === 'dikirim') echo 'bg-yellow-100 text-yellow-700';
                                        elseif ($row['status'] === 'diproses') echo 'bg-blue-100 text-blue-700';
                                        elseif ($row['status'] === 'selesai') echo 'bg-emerald-100 text-emerald-700';
                                        else echo 'bg-gray-200 text-gray-700';
                                    ?>">
                                    <?= htmlspecialchars(ucfirst($row['status'])); ?>
                                </span>
                            </td>
                        </tr>
                        <?php
                            endwhile;
                        else:
                        ?>
                        <tr>
                            <td colspan="3" class="py-4 text-center text-gray-500">Belum ada pengaduan masuk.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- GRAFIK -->
    <div class="p-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-navy mb-4">
                Statistik Pengaduan (Tahun Ini)
            </h2>
            <canvas id="complaintChart"></canvas>
        </div>
    </div>

    <!--footer-->
    <footer class="p-6 text-center text-gray-500 text-sm">
        &copy; <?= date('Y'); ?> SuaraKita. All rights reserved.
    </footer>
</main>


<!-- CHART JS -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('complaintChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($bulan); ?>,
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: <?= json_encode($total_bulanan); ?>,
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>
