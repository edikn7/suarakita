<?php
session_start();
include '../config.php';

// Validasi login siswa
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'siswa') {
    header("Location: ../auth/login.php");
}

// Ambil data
$pengaduan_id = $_POST['pengaduan_id'];
$isi          = trim($_POST['isi']);
$sekolah_id   = $_SESSION['sekolah_id'];
$siswa_id     = $_SESSION['siswa_id'];

if ($isi == '') {
    header("Location: ../siswa/detail_pengaduan.php?id=$pengaduan_id");
}

// Simpan tanggapan siswa
mysqli_query(
    $config,
    "INSERT INTO tanggapan_pengaduan 
     (pengaduan_id, pengirim, pesan, created_at)
     VALUES 
     ('$pengaduan_id', 'siswa', '$isi', NOW())"
);

// (opsional) kembalikan status ke diproses
mysqli_query(
    $config,
    "UPDATE pengaduan 
     SET status='diproses'
     WHERE id='$pengaduan_id'
       AND sekolah_id='$sekolah_id'
       AND siswa_id='$siswa_id'"
);

// Redirect kembali
header("Location: ../siswa/detail_pengaduan.php?id=$pengaduan_id");
?>