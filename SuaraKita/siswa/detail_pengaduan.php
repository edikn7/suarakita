<?php
session_start();
include '../config.php';

// Ambil data siswa dari session
$siswaUsername = $_SESSION['siswa_username'];

// Ambil detail pengaduan untuk ringkasan terakhir
$pengaduan_id = $_GET['id'];
$sekolah_id   = $_SESSION['sekolah_id'];

// Ambil detail pengaduan
$pengaduan = mysqli_query(
    $config,
    "SELECT p.*, u.nama, u.kelas
     FROM pengaduan p
     JOIN users u ON p.siswa_id = u.id
     WHERE p.id='$pengaduan_id'
     AND p.sekolah_id='$sekolah_id'"
);

$data = mysqli_fetch_assoc($pengaduan);

// Ambil tanggapan pengaduan
$tanggapan = mysqli_query(
    $config,
    "SELECT * FROM tanggapan_pengaduan
     WHERE pengaduan_id='$pengaduan_id'
     ORDER BY created_at ASC"
);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div class="text-gray-700 leading-relaxed min-h-[150px] ">
                <?= nl2br(htmlspecialchars($data['isi'])) ?>
            </div>

            <!-- Meta -->
            <div class="text-sm text-gray-500 flex flex-wrap gap-4 border-t border-mint pt-4">
                <span>👤 <?= htmlspecialchars($data['nama']) ?> | <?= $data['kelas'] ?></span>
                <span>📅 <?= date('d M Y', strtotime($data['created_at'])) ?></span>
                <span>Status :
                    <?php
                    if ($data['status'] == 'dikirim') {
                        echo '<span class="text-yellow-500 font-semibold">Dikirim</span>';
                    } elseif ($data['status'] == 'diproses') {
                        echo '<span class="text-blue-500 font-semibold">Diproses</span>';
                    } elseif ($data['status'] == 'selesai') {
                        echo '<span class="text-emerald-600 font-semibold">Selesai</span>';
                    }
                    ?>
                </span>
            </div>
        </div>

        <!-- Chat / Tanggapan Pengaduan -->
        <div class="bg-white rounded-lg shadow p-6 space-y-4">
            <h3 class="text-xl font-semibold text-navy">
                Tanggapan
            </h3>

            <?php if (mysqli_num_rows($tanggapan) == 0): ?>
                <p class="text-gray-500 italic text-center">
                    Belum ada tanggapan.
                </p>
            <?php endif; ?>

            <?php while ($row = mysqli_fetch_assoc($tanggapan)): ?>
                <div class="<?= $row['pengirim'] == 'siswa' ? 'text-right' : 'text-left' ?>">
                    <div class="
                        inline-block
                        max-w-[75%]
                        px-4 py-2 rounded-lg
                        <?= $row['pengirim'] == 'siswa'
                            ? 'bg-teal text-white'
                            : 'bg-mint text-navy'
                        ?>
                    ">
                        <p class="text-sm font-semibold mb-1">
                            <?= ucfirst($row['pengirim']) ?>
                        </p>
                        <p class="text-sm">
                            <?= nl2br(htmlspecialchars($row['pesan'])) ?>
                        </p>
                        <span class="block text-xs opacity-70 mt-1">
                            <?= date('d M Y H:i', strtotime($row['created_at'])) ?>
                        </span>
                    </div>
                </div>
            <?php endwhile; ?>
                
            <!-- Form Kirim Tanggapan -->
            <form action="../aksi/kirim_tanggapan_siswa.php" method="post">
                <input type="hidden" name="pengaduan_id" value="<?= $pengaduan_id ?>">

                <textarea
                    name="isi"
                    rows="3"
                    required
                    placeholder="Tulis tanggapan atau pertanyaan..."
                    class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-teal"
                ></textarea>

                <div class="flex justify-end mt-4">
                    <button
                        type="submit"
                        class="bg-teal text-white px-6 py-2 rounded-lg hover:bg-navy transition"
                    >Kirim
                    </button>
                </div>
            </form>
        </div>

    </div>
</main>

    
    
</body>
</html>