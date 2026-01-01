<?php
session_start();
include '../config.php';

//ambil data admin dari session
$adminUsername = $_SESSION['admin_username'];

// ambil data siswa berdasarkan sekolah admin
$sekolah_id = $_SESSION['sekolah_id'];
$query = mysqli_query(
    $config,
    "SELECT * FROM users 
     WHERE level='siswa' AND sekolah_id='$sekolah_id'
     ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa | Admin SuaraKita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html, body {
            font-family: 'Inter', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }
    </style>
    <!-- Tailwind -->
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

<!-- Sidebar -->
<?php include 'partials/sidebar.php'; ?>

<!-- Main Content -->
<main class="ml-64 min-h-screen">

    <!-- Header -->
    <?php include 'partials/header.php'; ?>

    <!-- Content -->
    <section class="p-6 mt-20">

        <!-- Judul -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-navy">Data Siswa</h1>
            <a href="tambah_siswa.php"
               class="bg-green text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-teal transition">
                + Tambah Siswa
            </a>
        </div>

        <!-- Tabel -->
         
        <div class="bg-white shadow rounded-lg overflow-hidden">
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
            $where = "WHERE level='siswa' AND sekolah_id='$sekolah_id'";
            if ($keyword !== '') {
                $safeKeyword = mysqli_real_escape_string($config, $keyword);
                $where .= " AND (nama LIKE '%$safeKeyword%' OR username LIKE '%$safeKeyword%' OR nis LIKE '%$safeKeyword%' OR kelas LIKE '%$safeKeyword%')";
            }

            // Hitung total data
            $countQuery = mysqli_query($config, "
                SELECT COUNT(*) as total
                FROM users
                $where
            ");
            $totalData = mysqli_fetch_assoc($countQuery)['total'];
            $totalPages = ceil($totalData / $perPage);

            // Query data siswa dengan limit dan offset
            $query = mysqli_query($config, "
                SELECT * FROM users
                $where
                ORDER BY id DESC
                LIMIT $perPage OFFSET $offset
            ");
            ?>

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

            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-mint text-navy uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">No</th>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Username</th>
                        <th class="px-6 py-3 text-left">NIS</th>
                        <th class="px-6 py-3 text-left">Kelas</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4"><?= $no++; ?></td>
                        <td class="px-6 py-4 font-semibold"><?= htmlspecialchars($row['nama']); ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['username']); ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['nis']); ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($row['kelas']); ?></td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <a href="edit_siswa.php?id=<?= $row['id']; ?>"
                               class="text-teal font-semibold hover:underline">
                                Edit
                            </a>
                            <a href="hapus_siswa.php?id=<?= $row['id']; ?>"
                               onclick="return confirm('Yakin hapus siswa ini?')"
                               class="text-red-500 font-semibold hover:underline">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                    <?php if (mysqli_num_rows($query) == 0): ?>
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">
                            Data siswa belum tersedia
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <!-- 
        </div>

    </section>

</main>

</body>
</html>
