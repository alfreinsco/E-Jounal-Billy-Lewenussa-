<?php
require_once __DIR__ . '/../../config/bootstrap.php';

$id = (int) ($_GET['id'] ?? 0);
$data = mysqli_query($koneksi, "SELECT * FROM jurnal WHERE id='$id'");
$d = mysqli_fetch_assoc($data);

if (!$d) {
    set_pesan('gagal', 'Data jurnal tidak ditemukan.');
    redirect_ke('pages/jurnal/index.php');
}

$judul_halaman = 'Ubah Jurnal';
$menu_aktif = 'jurnal';

require_once ROOT_PATH . '/includes/layout_awal.php';
?>

<div class="card-panel">
    <form method="post" action="<?php echo url('pages/jurnal/update.php'); ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo (int) $d['id']; ?>">

        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="<?php echo e($d['judul']); ?>" required>
        </div>
        <div class="form-group">
            <label>Pengarang</label>
            <input type="text" name="pengarang" class="form-control" value="<?php echo e($d['pengarang']); ?>" required>
        </div>
        <div class="form-group">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" value="<?php echo e($d['tahun']); ?>" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Volume</label>
                <input type="text" name="volume" class="form-control" value="<?php echo e($d['volume']); ?>">
            </div>
            <div class="form-group col-md-4">
                <label>Nomor</label>
                <input type="text" name="no" class="form-control" value="<?php echo e($d['no']); ?>">
            </div>
            <div class="form-group col-md-4">
                <label>Halaman</label>
                <input type="text" name="halaman" class="form-control" value="<?php echo e($d['halaman']); ?>">
            </div>
        </div>
        <div class="form-group">
            <label>Berkas PDF (kosongkan jika tidak diganti)</label><br>
            <small>Berkas lama:
                <a href="<?php echo url(UPLOAD_JURNAL_URL . $d['file']); ?>" target="_blank"><?php echo e($d['file']); ?></a>
            </small>
            <input type="file" name="file" class="form-control-file mt-1" accept="application/pdf">
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="<?php echo url('pages/jurnal/index.php'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php require_once ROOT_PATH . '/includes/layout_akhir.php'; ?>
