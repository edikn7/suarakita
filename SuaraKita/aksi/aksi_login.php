<?php
session_start();
include '../config.php';

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Ambil user berdasarkan username
$query = mysqli_query($config, "SELECT * FROM users WHERE username='$username'");

// Cek user ada atau tidak
if (mysqli_num_rows($query) === 1) {

    $user = mysqli_fetch_assoc($query);

    // Cek password (basic dulu, sesuai request kamu)
    if ($password === $user['password']) {

        $_SESSION['login'] = true;
        $_SESSION['level'] = $user['level'];
        $_SESSION['sekolah_id'] = $user['sekolah_id'];

        // ===== ADMIN =====
        if ($user['level'] === 'admin') {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];

            header("Location: ../admin/dashboard_admin.php");
            exit;
        }

        // ===== SISWA =====
        if ($user['level'] === 'siswa') {
            $_SESSION['siswa_id'] = $user['id'];
            $_SESSION['siswa_username'] = $user['username'];

            header("Location: ../siswa/dashboard_siswa.php");
        }

    } else {
        header("Location: login.php?pesan=password_salah");
    }

} else {
    header("Location: login.php?pesan=username_tidak_ditemukan");
}
