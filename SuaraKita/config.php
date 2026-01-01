<!-- konfigurasi database -->
<?php
$host = "localhost"; // nama host
$user = "root"; // username database
$pass = ""; // password database
$db   = "suarakita"; // nama database

// koneksi ke database
$config = mysqli_connect($host, $user, $pass, $db);

// cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit;
}

