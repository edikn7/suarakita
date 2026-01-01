
<?php
session_start();
include '../config.php';


//ambil data admin dari session
$adminUsername = $_SESSION['admin_username'];

$id = $_GET['id'];
$sekolah_id = $_SESSION['sekolah_id'];

$data = mysqli_query($config, "
    SELECT * FROM users 
    WHERE id='$id' 
    AND level='siswa' 
    AND sekolah_id='$sekolah_id'
");

$siswa = mysqli_fetch_assoc($data);

if (!$siswa) {
    header("Location: kelola_siswa.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
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
    <h1 class="text-2xl font-bold text-navy mb-6 ml-56">Edit Data Siswa</h1>

    <form action="../aksi/aksi_edit_siswa.php" method="POST" class="bg-white p-6 rounded-lg ml-56 shadow space-y-4">
        <input type="hidden" name="id" value="<?= $siswa['id']; ?>">

        <div>
            <label class="text-sm font-semibold">Nama</label>
            <input type="text" name="nama" value="<?= $siswa['nama']; ?>" required
                class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label class="text-sm font-semibold">NIS</label>
            <input type="text" name="nis" value="<?= $siswa['nis']; ?>" required
                class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label class="text-sm font-semibold">Kelas</label>
            <input type="text" name="kelas" value="<?= $siswa['kelas']; ?>" required
                class="w-full border px-4 py-2 rounded">
        </div>

        <div class="flex justify-end gap-3">
            <a href="kelola_siswa.php" class="px-4 py-2 border rounded">Batal</a>
            <button type="submit" class="bg-green text-white px-5 py-2 rounded">
                Simpan Perubahan
            </button>
        </div>
    </form>
</section>

</main>
</body>
</html>
