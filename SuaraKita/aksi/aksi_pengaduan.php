<?php
session_start();
include '../config.php';

// Ambil data dari session (AMAN)
$siswa_id   = $_SESSION['siswa_id'];
$sekolah_id = $_SESSION['sekolah_id'];

// Ambil data dari form
$judul = $_POST['judul'];
$isi   = $_POST['isi'];

// Simpan ke database
$query = mysqli_query($config, "
    INSERT INTO pengaduan (siswa_id, sekolah_id, judul, isi)
    VALUES ('$siswa_id', '$sekolah_id', '$judul', '$isi')
");

// Redirect berdasarkan hasil query
if ($query) {
    header("Location: ../siswa/dashboard_siswa.php?pesan=berhasil");
} else {
    header("Location: ../siswa/buat_pengaduan.php?pesan=gagal");
}
?>
