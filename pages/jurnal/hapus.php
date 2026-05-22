<?php
require_once __DIR__ . '/../../config/bootstrap.php';
wajib_masuk();

$id = (int) ($_GET['id'] ?? 0);

$data = mysqli_query($koneksi, "SELECT file FROM jurnal WHERE id='$id'");
$d = mysqli_fetch_assoc($data);

if ($d) {
    $path = UPLOAD_JURNAL_PATH . $d['file'];
    if (file_exists($path)) {
        unlink($path);
    }
    mysqli_query($koneksi, "DELETE FROM jurnal WHERE id='$id'");
    set_pesan('sukses', 'Data jurnal berhasil dihapus.');
} else {
    set_pesan('gagal', 'Data jurnal tidak ditemukan.');
}

redirect_ke('pages/jurnal/index.php');
