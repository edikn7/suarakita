<?php
session_start();
include '../config.php';

if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../login.php");
}

$nama   = $_POST['nama'];
$nis    = $_POST['nis'];
$kelas  = $_POST['kelas'];
$sekolah_id = $_SESSION['sekolah_id'];

// username & password otomatis
$username = strtolower(str_replace(' ', '', $nama)) . rand(100,999);
$password = $nis; // password = NIS dulu (simple)

// simpan ke database
mysqli_query($config, "
    INSERT INTO users (nama, username, password, nis, kelas, level, sekolah_id)
    VALUES (
        '$nama',
        '$username',
        '$password',
        '$nis',
        '$kelas',
        'siswa',
        '$sekolah_id'
    )
");

header("Location: ../admin/kelola_siswa.php");
?>
