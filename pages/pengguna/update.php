<?php
require_once __DIR__ . '/../../config/bootstrap.php';
wajib_admin();

$id       = (int) ($_POST['id'] ?? 0);
$nama     = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$peran    = $_POST['peran'] ?? 'petugas';

if ($nama === '' || $username === '') {
    set_pesan('gagal', 'Nama dan nama pengguna wajib diisi.');
    redirect_ke('pages/pengguna/edit.php?id=' . $id);
}

if ($password !== '' && strlen($password) < 6) {
    set_pesan('gagal', 'Kata sandi minimal 6 karakter.');
    redirect_ke('pages/pengguna/edit.php?id=' . $id);
}

if (!in_array($peran, ['admin', 'petugas'], true)) {
    $peran = 'petugas';
}

$cek = mysqli_prepare($koneksi, 'SELECT id FROM pengguna WHERE username = ? AND id != ? LIMIT 1');
mysqli_stmt_bind_param($cek, 'si', $username, $id);
mysqli_stmt_execute($cek);
if (mysqli_fetch_assoc(mysqli_stmt_get_result($cek))) {
    mysqli_stmt_close($cek);
    set_pesan('gagal', 'Nama pengguna sudah digunakan.');
    redirect_ke('pages/pengguna/edit.php?id=' . $id);
}
mysqli_stmt_close($cek);

if ($password !== '') {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($koneksi, 'UPDATE pengguna SET nama = ?, username = ?, password = ?, peran = ? WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'ssssi', $nama, $username, $hash, $peran, $id);
} else {
    $stmt = mysqli_prepare($koneksi, 'UPDATE pengguna SET nama = ?, username = ?, peran = ? WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'sssi', $nama, $username, $peran, $id);
}

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if ($id === (int) $_SESSION['user_id']) {
    $_SESSION['nama'] = $nama;
    $_SESSION['username'] = $username;
    $_SESSION['peran'] = $peran;
}

set_pesan('sukses', 'Data pengguna berhasil diperbarui.');
redirect_ke('pages/pengguna/index.php');
