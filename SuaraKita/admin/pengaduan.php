
<?php
include '../config.php';
session_start();

//ambil data admin dari session
$adminUsername = $_SESSION['admin_username'];

$sekolah_id = $_SESSION['sekolah_id'];

// Ambil pengaduan siswa sekolah ini
$pengaduan = mysqli_query($config, "
    SELECT p.*, u.nama, u.kelas
    FROM pengaduan p
    JOIN users u ON p.siswa_id = u.id
    WHERE p.sekolah_id = '$sekolah_id'
    ORDER BY p.created_at DESC
    ");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pengaduan | Admin</title>
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

<main class="ml-64 min-h-screen">
<?php include 'partials/header.php'; ?>

<section class="p-6 mt-20">
    <h1 class="text-2xl font-bold text-navy mb-6">Data Pengaduan Siswa</h1>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <!-- Fitur Pencarian dan Pagination -->
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
        $where = "WHERE p.sekolah_id = '$sekolah_id'";
        if ($keyword !== '') {
            $safeKeyword = mysqli_real_escape_string($config, $keyword);
            $where .= " AND (u.nama LIKE '%$safeKeyword%' OR u.kelas LIKE '%$safeKeyword%' OR p.judul LIKE '%$safeKeyword%')";
        }

        // Hitung total data
        $countQuery = mysqli_query($config, "
            SELECT COUNT(*) as total
            FROM pengaduan p
            JOIN users u ON p.siswa_id = u.id
            $where
        ");
        $totalData = mysqli_fetch_assoc($countQuery)['total'];
        $totalPages = ceil($totalData / $perPage);

        // Query data pengaduan dengan limit dan offset
        $pengaduan = mysqli_query($config, "
            SELECT p.*, u.nama, u.kelas
            FROM pengaduan p
            JOIN users u ON p.siswa_id = u.id
            $where
            ORDER BY p.created_at DESC
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

        <table class="w-full text-sm rounded-lg border-collapse">
            <thead class="border-collapse bg-mint text-navy">
                <tr>
                    <th class="px-4 py-3 text-left">Siswa</th>
                    <th class="px-4 py-3 text-left">Kelas</th>
                    <th class="px-4 py-3 text-left">Judul</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($p = mysqli_fetch_assoc($pengaduan)) : ?>
                <tr class="border-b">
                    <td class="px-4 py-3"><?= $p['nama']; ?></td>
                    <td class="px-4 py-3"><?= $p['kelas']; ?></td>
                    <td class="px-4 py-3"><?= $p['judul']; ?></td>
                    <td class="px-4 py-3">
                        <?php
                        switch ($p['status']) {
                            case 'dikirim':
                                echo '<span class="text-yellow-500 font-semibold">Baru</span>';
                                break;
                            case 'diproses':
                                echo '<span class="text-blue-500 font-semibold">Diproses</span>';
                                break;
                            case 'selesai':
                                echo '<span class="text-emerald-600 font-semibold">Selesai</span>';
                                break;
                            default:
                                echo '<span class="text-gray-500 font-semibold">Tidak Diketahui</span>';
                                break;
                        }
                        ?>
                    </td>
                    <td class="px-4 py-3 text-center">
                        <a href="detail_pengaduan.php?id=<?= $p['id']; ?>"
                           class="text-teal hover:underline font-semibold">
                           Detail
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>

                <?php if(mysqli_num_rows($pengaduan) == 0): ?>
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">
                        Belum ada pengaduan
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
        <div class="flex justify-between items-center mt-4 px-4">
            <div class="text-sm text-gray-600">
                Halaman <?= $page ?> dari <?= $totalPages ?> (Total: <?= $totalData ?> data)
            </div>
            <div class="flex gap-1">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?q=<?= urlencode($keyword) ?>&per_page=<?= $perPage ?>&page=<?= $i ?>"
                        class="px-3 py-1 rounded <?= $i == $page ? 'bg-teal text-white' : 'bg-mint text-navy hover:bg-green hover:text-white' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

</main>
</body>
</html>
