<?php
session_start();
include '../config.php';

// Validasi login admin
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../auth/login.php");
}

// Ambil data dari form
$pengaduan_id = $_POST['pengaduan_id'];
$isi          = trim($_POST['isi']);
$sekolah_id   = $_SESSION['sekolah_id'];

if ($isi == '') {
    header("Location: ../admin/detail_pengaduan.php?id=$pengaduan_id");
}

// Simpan tanggapan admin
mysqli_query(
    $config,
    "INSERT INTO tanggapan_pengaduan 
     (pengaduan_id, pengirim, pesan, created_at)
     VALUES 
     ('$pengaduan_id', 'admin', '$isi', NOW())"
);

// Kembali ke halaman detail
header("Location: ../admin/detail_pengaduan.php?id=$pengaduan_id");
