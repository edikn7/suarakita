
<?php
session_start();
include '../config.php';

//Cek apakah admin sudah login
if (!isset($_SESSION['login']) || $_SESSION['level'] !== 'admin') {
    header("Location: ../auth/login.php");
}

// Ambil data admin dari session
$adminUsername = $_SESSION['admin_username'];

$sekolah_id = $_SESSION['sekolah_id'];
$id = $_GET['id'];

// Ambil detail pengaduan
$pengaduan = mysqli_query($config, "
    SELECT p.*, u.nama, u.kelas
    FROM pengaduan p
    JOIN users u ON p.siswa_id = u.id
    WHERE p.id = '$id'
    AND p.sekolah_id = '$sekolah_id'
");
$data = mysqli_fetch_assoc($pengaduan);

//Ambil Riwayat Tanggapan
$tanggapan = mysqli_query($config, "
    SELECT * FROM tanggapan_pengaduan
    WHERE pengaduan_id = '$id'
    ORDER BY created_at ASC
");

// Kalau data tidak ditemukan
if (!$data) {
    header("Location: pengaduan.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengaduan</title>
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
    <!-- Sidebar -->
    <?php include 'partials/sidebar.php'; ?>
    <main class="ml-64 min-h-screen bg-violet-50">

    <!-- Header -->
    <?php include 'partials/header.php'; ?>

    <!-- Content -->
    <div class="p-6 mt-20 max-w-5xl mx-auto space-y-6">

        <!-- Judul Halaman -->
        <h2 class="text-2xl font-bold text-navy">
            Detail Pengaduan
        </h2>

        <!-- Ringkasan Pengaduan -->
        <div class="bg-white rounded-lg shadow p-6 space-y-4">

            <!-- Judul Pengaduan -->
            <h3 class="text-xl font-semibold text-teal border-b border-mint pb-2">
                <?= htmlspecialchars($data['judul']) ?>
            </h3>

            <!-- Isi Pengaduan -->
            <div class="text-gray-700 leading-relaxed min-h-[150px]">
                <?= nl2br(htmlspecialchars($data['isi'])) ?>
            </div>

            <!-- Meta -->
            <div class="text-sm text-gray-500 gap-3 border-t border-mint pt-4 space-y-2">
                <p class="flex items-center gap-2">Nama Siswa :
                    <span><?= htmlspecialchars($data['nama']) ?></span>
                </p>
                <p class="flex items-center gap-2">Kelas : 
                    <span><?= htmlspecialchars($data['kelas']) ?></span>
                </p>
                <p class="flex items-center gap-2">Tanggal Pengaduan :
                    <span><?= date('d M Y', strtotime($data['created_at'])) ?></span>
                </p>
                <p class="flex items-center gap-2">Status Pengaduan :
                <span class="px-3 py-1 rounded-full text-sm font-semibold
                    <?php
                        switch ($data['status']) {
                            case 'dikirim':
                                echo 'bg-yellow-100 text-yellow-700';
                                break;
                            case 'diproses':
                                echo 'bg-blue-100 text-blue-700';
                                break;
                            case 'selesai':
                                echo 'bg-emerald-100 text-emerald-700';
                                break;
                            default:
                                echo 'bg-violet-50 text-gray-700';
                        }
                    ?>">
                    <?= ucfirst($data['status']); ?>
                </span>
            </div>

            <!-- Form Update Status -->
            <form action="../aksi/aksi_update_status.php" method="POST" class="mt-6 flex items-center gap-4">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">

                <select name="status" class="border px-4 py-2 rounded">
                    <option value="dikirim" <?= $data['status']=='dikirim'?'selected':''; ?>>Dikirim</option>
                    <option value="diproses" <?= $data['status']=='diproses'?'selected':''; ?>>Diproses</option>
                    <option value="selesai" <?= $data['status']=='selesai'?'selected':''; ?>>Selesai</option>
                </select>

                <button type="submit" class="bg-teal text-white px-5 py-2 rounded">
                    Perbarui Status
                </button>
            </form>
        </div>

        <!-- Tanggapan Pengaduan & Form Balasan -->
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <!-- Tanggapan Pengaduan -->
            <div>
                <h2 class="text-xl font-semibold text-navy mb-4">Tanggapan</h2>
                <?php while ($row = mysqli_fetch_assoc($tanggapan)): ?>
                    <div class="<?= $row['pengirim'] == 'admin' ? 'text-right' : 'text-left' ?> mb-3">
                        <div class="inline-block max-w-[75%] px-4 py-2 rounded-lg
                            <?= $row['pengirim'] == 'admin'? 'bg-navy text-white': 'bg-mint text-navy' ?>">
                            <p class="text-sm font-semibold">
                                <?= ucfirst($row['pengirim']) ?>
                            </p>
                            <p class="text-sm">
                                <?= nl2br(htmlspecialchars($row['pesan'])) ?>
                            </p>
                            <span class="text-xs opacity-70">
                                <?= date('d M Y H:i', strtotime($row['created_at'])) ?>
                            </span>
                        </div>
                    </div>
                <?php endwhile; ?>
                
                <!-- Jika tidak ada tanggapan -->
                <?php if (mysqli_num_rows($tanggapan) == 0): ?>
                    <p class="text-gray-500 italic text-center">
                        Belum ada tanggapan.
                    </p>
                <?php endif; ?>
            </div>

            <!-- Form Kirim Tanggapan -->
            <form action="../aksi/kirim_tanggapan_admin.php" method="post" class="space-y-4">
                <input type="hidden" name="pengaduan_id" value="<?= $data['id'] ?>">
                <textarea
                    name="isi"
                    rows="3"
                    required
                    placeholder="Tulis balasan untuk siswa..."
                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-navy"
                ></textarea>
                <div class="flex justify-end items-center">
                    <button class="bg-navy text-white px-6 py-2 rounded-lg">
                        Kirim Balasan
                    </button>
                </div>
            </form>
        </div>

    </div>
    </main>
</body>
</html>
