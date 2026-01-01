<?php
session_start();
include '../config.php';

// Validasi login admin
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../login.php");
}

$id    = $_POST['id'];
$nama  = $_POST['nama'];
$nis   = $_POST['nis'];
$kelas = $_POST['kelas'];
$sekolah_id = $_SESSION['sekolah_id'];

mysqli_query($config, "
    UPDATE users SET
        nama='$nama',
        nis='$nis',
        kelas='$kelas'
    WHERE id='$id'
    AND level='siswa'
    AND sekolah_id='$sekolah_id'
");

header("Location: ../admin/kelola_siswa.php");
