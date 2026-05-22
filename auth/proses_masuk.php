<?php
require_once __DIR__ . '/../config/bootstrap.php';

if (sudah_masuk()) {
    redirect_ke('pages/dashboard.php');
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    set_pesan('gagal', 'Nama pengguna dan kata sandi wajib diisi.');
    redirect_ke('login.php');
}

$stmt = mysqli_prepare($koneksi, 'SELECT id, nama, username, password, peran FROM pengguna WHERE username = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);
$pengguna = mysqli_fetch_assoc($hasil);
mysqli_stmt_close($stmt);

if (!$pengguna || !password_verify($password, $pengguna['password'])) {
    set_pesan('gagal', 'Nama pengguna atau kata sandi salah.');
    redirect_ke('login.php');
}

masukkan_pengguna($pengguna);
set_pesan('sukses', 'Selamat datang, ' . $pengguna['nama'] . '!');
redirect_ke('pages/dashboard.php');
