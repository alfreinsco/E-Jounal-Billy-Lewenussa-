<?php
require_once __DIR__ . '/../../config/bootstrap.php';
wajib_admin();

$id = (int) ($_GET['id'] ?? 0);
$pengguna_masuk = pengguna_masuk();

if ($id === (int) $pengguna_masuk['id']) {
    set_pesan('gagal', 'Anda tidak dapat menghapus akun yang sedang digunakan.');
    redirect_ke('pages/pengguna/index.php');
}

$admin_count = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM pengguna WHERE peran = 'admin'"))['jumlah'];
$target = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT peran FROM pengguna WHERE id = '$id'"));

if ($target && $target['peran'] === 'admin' && (int) $admin_count <= 1) {
    set_pesan('gagal', 'Tidak dapat menghapus administrator terakhir.');
    redirect_ke('pages/pengguna/index.php');
}

$hapus = mysqli_query($koneksi, "DELETE FROM pengguna WHERE id = '$id'");

if ($hapus && mysqli_affected_rows($koneksi) > 0) {
    set_pesan('sukses', 'Pengguna berhasil dihapus.');
} else {
    set_pesan('gagal', 'Data pengguna tidak ditemukan.');
}

redirect_ke('pages/pengguna/index.php');
