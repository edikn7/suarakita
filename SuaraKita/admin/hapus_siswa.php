<?php
session_start();
include '../config.php';

if (!isset($_SESSION['login']) || $_SESSION['level'] != 'admin') {
    header("Location: ../login.php");
}

$id = $_GET['id'];
$sekolah_id = $_SESSION['sekolah_id'];

mysqli_query($config, "
    DELETE FROM users 
    WHERE id='$id'
    AND level='siswa'
    AND sekolah_id='$sekolah_id'
");

header("Location: kelola_siswa.php");
?>