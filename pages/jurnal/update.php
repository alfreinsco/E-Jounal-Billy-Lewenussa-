<?php
require_once __DIR__ . '/../../config/bootstrap.php';
wajib_masuk();

$id        = (int) ($_POST['id'] ?? 0);
$judul     = mysqli_real_escape_string($koneksi, $_POST['judul'] ?? '');
$pengarang = mysqli_real_escape_string($koneksi, $_POST['pengarang'] ?? '');
$tahun     = (int) ($_POST['tahun'] ?? 0);
$volume    = mysqli_real_escape_string($koneksi, $_POST['volume'] ?? '');
$no        = mysqli_real_escape_string($koneksi, $_POST['no'] ?? '');
$halaman   = mysqli_real_escape_string($koneksi, $_POST['halaman'] ?? '');

$data = mysqli_query($koneksi, "SELECT file FROM jurnal WHERE id='$id'");
$d = mysqli_fetch_assoc($data);

if (!$d) {
    set_pesan('gagal', 'Data jurnal tidak ditemukan.');
    redirect_ke('pages/jurnal/index.php');
}

$fileLama = $d['file'];

if (!empty($_FILES['file']['name'])) {
    $allowed_ext = ['pdf'];
    $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed_ext, true)) {
        set_pesan('peringatan', 'Ekstensi berkas tidak diperbolehkan. Gunakan PDF saja.');
        redirect_ke('pages/jurnal/edit.php?id=' . $id);
    }

    if ($_FILES['file']['size'] > 5000000) {
        set_pesan('peringatan', 'Ukuran berkas terlalu besar. Maksimal 5 MB.');
        redirect_ke('pages/jurnal/edit.php?id=' . $id);
    }

    $newName = 'jurnal-' . time() . '.' . $ext;
    move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD_JURNAL_PATH . $newName);

    $fileLamaPath = UPLOAD_JURNAL_PATH . $fileLama;
    if (file_exists($fileLamaPath)) {
        unlink($fileLamaPath);
    }

    $file = $newName;
} else {
    $file = mysqli_real_escape_string($koneksi, $fileLama);
}

mysqli_query($koneksi, "UPDATE jurnal SET judul='$judul', pengarang='$pengarang', tahun='$tahun', volume='$volume', no='$no', halaman='$halaman', file='$file' WHERE id='$id'");

set_pesan('sukses', 'Data jurnal berhasil diperbarui.');
redirect_ke('pages/jurnal/index.php');
