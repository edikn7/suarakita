<?php
session_start();
include '../config.php';


$siswaUsername = $_SESSION['siswa_username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaduan | SuaraKita</title>
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

<!-- Sidebar siswa -->
<?php include 'partials/sidebar.php'; ?>
<main class="ml-64 min-h-screen bg-violet-50">

    <!-- Header -->
    <?php include 'partials/header.php'; ?>

    <!-- Konten -->
    <div class="p-6 mt-20">

        <h2 class="text-2xl font-bold text-navy mb-6">
            Riwayat Pengaduan Saya
        </h2>

        <div class="bg-white rounded-lg shadow overflow-x-auto">
        <!--Fitur Pencarian dan Pilihan Jumlah Data-->
            <?php
            // Ambil keyword pencarian
            $keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
            // Ambil limit per halaman
            $perPageOptions = [10, 20, 50, 100];
            $perPage = isset($_GET['per_page']) && in_array((int)$_GET['per_page'], $perPageOptions) ? (int)$_GET['per_page'] : 10;

            // Ambil halaman aktif
            $page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $perPage;

            // Query pencarian
            $where = "WHERE siswa_id = '{$_SESSION['siswa_id']}'";
            if ($keyword !== '') {
                $safeKeyword = mysqli_real_escape_string($config, $keyword);
                $where .= " AND (judul LIKE '%$safeKeyword%')";
            }

            // Hitung total data
            $countQuery = mysqli_query($config, "
                SELECT COUNT(*) as total
                FROM pengaduan
                $where
            ");
            $totalData = mysqli_fetch_assoc($countQuery)['total'];
            $totalPages = ceil($totalData / $perPage);

            // Query data pengaduan dengan limit dan offset
            $pengaduan = mysqli_query($config, "
                SELECT * FROM pengaduan
                $where
                ORDER BY created_at DESC
                LIMIT $perPage OFFSET $offset
            ");
            ?>
            <!-- Form Pencarian dan Pilihan Jumlah Data -->
            <form method="get" class="flex flex-wrap gap-2 items-baseline p-4">
            <input type="text" name="q" value="<?= htmlspecialchars($keyword) ?>" placeholder="Cari..."
                class="border rounded-full px-10 py-2 focus:outline-none focus:ring-2 focus:ring-mint" />
            <button type="submit" class="bg-green text-white px-4 py-2 rounded-full hover:bg-teal">Cari</button>
            <label class="ml-auto flex items-end gap-2 text-sm text-gray-700">
                <select name="per_page" onchange="this.form.submit()" class="border rounded-xl px-2 py-2">
                    <?php foreach ($perPageOptions as $opt): ?>
                        <option value="<?= $opt ?>" <?= $perPage == $opt ? 'selected' : '' ?>><?= $opt ?></option>
                    <?php endforeach; ?>
                    <option value="<?= $totalData ?>" <?= $perPage == $totalData ? 'selected' : '' ?>>Semua</option>
                </select>
            </label>
            </form>


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
                        <td colspan="5" class="text-center py-6 text-gray-500">
                            Belum ada pengaduan yang dibuat.
                        </td>
                    </tr>   
                </tbody>

            </table>
            <?php endif; ?>

        </div>
    </div>

</main>


</body>
</html>