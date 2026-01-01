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
<main class="ml-64 min-h-screen">
    <!-- Header siswa -->
    <?php include 'partials/header.php'; ?>

    <!-- Konten Buat Pengaduan -->
     <div class="max-w-3xl mx-auto mt-28 mb-12 bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-bold text-navy mb-4">
        Form Pengaduan Siswa
    </h2>

    <form action="../aksi/aksi_pengaduan.php" method="POST" class="space-y-4">

        <!-- Judul -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Judul Pengaduan
            </label>
            <input type="text" name="judul" required
                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:ring-green">
        </div>

        <!-- Isi -->
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">
                Isi Pengaduan
            </label>
            <textarea name="isi" rows="5" required
                class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:ring-green"></textarea>
        </div>

        <!-- Submit -->
        <div>
            <button type="submit"
                class="bg-green text-white px-6 py-2 rounded hover:bg-teal focus:outline-none focus:ring focus:ring-green">
                Kirim Pengaduan
            </button>
        </div>

    </form>
</div>
</main>

</body>
</html>
