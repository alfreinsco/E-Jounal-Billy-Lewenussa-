<?php
require_once __DIR__ . '/../../config/bootstrap.php';
wajib_masuk();

$judul     = mysqli_real_escape_string($koneksi, $_POST['judul'] ?? '');
$pengarang = mysqli_real_escape_string($koneksi, $_POST['pengarang'] ?? '');
$tahun     = (int) ($_POST['tahun'] ?? 0);
$volume    = mysqli_real_escape_string($koneksi, $_POST['volume'] ?? '');
$no        = mysqli_real_escape_string($koneksi, $_POST['no'] ?? '');
$halaman   = mysqli_real_escape_string($koneksi, $_POST['halaman'] ?? '');

if (empty($_FILES['file']['name'])) {
    set_pesan('peringatan', 'Berkas PDF wajib diunggah.');
    redirect_ke('pages/jurnal/tambah.php');
}

$allowed_ext = ['pdf'];
$filename = $_FILES['file']['name'];
$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

if (!in_array($ext, $allowed_ext, true)) {
    set_pesan('peringatan', 'Ekstensi berkas tidak diperbolehkan. Gunakan PDF saja.');
    redirect_ke('pages/jurnal/tambah.php');
}

if ($_FILES['file']['size'] > 5000000) {
    set_pesan('peringatan', 'Ukuran berkas terlalu besar. Maksimal 5 MB.');
    redirect_ke('pages/jurnal/tambah.php');
}

$newName = 'jurnal-' . time() . '.' . $ext;
move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD_JURNAL_PATH . $newName);

mysqli_query($koneksi, "INSERT INTO jurnal (judul,pengarang,tahun,volume,no,halaman,file) 
VALUES ('$judul','$pengarang','$tahun','$volume','$no','$halaman','$newName')");

set_pesan('sukses', 'Data jurnal berhasil disimpan.');
redirect_ke('pages/jurnal/index.php');
