<?php
require_once __DIR__ . '/../../config/bootstrap.php';
wajib_admin();

$nama     = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$peran    = $_POST['peran'] ?? 'petugas';

if ($nama === '' || $username === '' || $password === '') {
    set_pesan('gagal', 'Semua field wajib diisi.');
    redirect_ke('pages/pengguna/tambah.php');
}

if (strlen($password) < 6) {
    set_pesan('gagal', 'Kata sandi minimal 6 karakter.');
    redirect_ke('pages/pengguna/tambah.php');
}

if (!in_array($peran, ['admin', 'petugas'], true)) {
    $peran = 'petugas';
}

$cek = mysqli_prepare($koneksi, 'SELECT id FROM pengguna WHERE username = ? LIMIT 1');
mysqli_stmt_bind_param($cek, 's', $username);
mysqli_stmt_execute($cek);
if (mysqli_fetch_assoc(mysqli_stmt_get_result($cek))) {
    mysqli_stmt_close($cek);
    set_pesan('gagal', 'Nama pengguna sudah digunakan.');
    redirect_ke('pages/pengguna/tambah.php');
}
mysqli_stmt_close($cek);

$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = mysqli_prepare($koneksi, 'INSERT INTO pengguna (nama, username, password, peran) VALUES (?, ?, ?, ?)');
mysqli_stmt_bind_param($stmt, 'ssss', $nama, $username, $hash, $peran);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

set_pesan('sukses', 'Pengguna berhasil ditambahkan.');
redirect_ke('pages/pengguna/index.php');
