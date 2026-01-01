
<?php
session_start();
include '../config.php';

//ambil data admin dari session
$adminUsername = $_SESSION['admin_username'];


if (!isset($_SESSION['sekolah_id'])) {
    header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <section class="p-6 mt-20 max-w-2xl">

        <h1 class="text-2xl font-bold text-navy mb-6 ml-56">Tambah Data Siswa</h1>

        <form action="../aksi/aksi_tambah_siswa.php" method="POST" class="bg-white ml-56 shadow rounded-lg p-6 space-y-4">

            <div>
                <label class="block text-sm font-semibold mb-1">Nama Lengkap</label>
                <input type="text" name="nama" required
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-green">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">NIS</label>
                <input type="text" name="nis" required
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-green">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Kelas</label>
                <input type="text" name="kelas" required
                    class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:ring-green">
            </div>

            <!-- Info otomatis -->
            <div class="bg-mint text-sm text-navy p-3 rounded">
                Username & password akan dibuat otomatis oleh sistem
            </div>

            <div class="flex justify-end gap-3">
                <a href="kelola_siswa.php"
                   class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                    Batal
                </a>
                <button type="submit"
                    class="bg-green text-white px-5 py-2 rounded-lg hover:bg-teal transition">
                    Simpan
                </button>
            </div>

        </form>
    </section>
</main>

</body>
</html>
