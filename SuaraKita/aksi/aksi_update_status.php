<?php
session_start();
include '../config.php';

// Validasi login admin
if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../login.php");
}

$id = $_POST['id'];
$status = $_POST['status'];
$sekolah_id = $_SESSION['sekolah_id'];

// Update status pengaduan (AMAN, PER SEKOLAH)
mysqli_query($config, "
    UPDATE pengaduan
    SET status = '$status'
    WHERE id = '$id'
    AND sekolah_id = '$sekolah_id'
");

header("Location: ../admin/detail_pengaduan.php?id=$id");
