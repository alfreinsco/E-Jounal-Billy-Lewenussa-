<?php
require_once __DIR__ . '/../../config/bootstrap.php';

$judul_halaman = 'Tambah Jurnal';
$menu_aktif = 'jurnal';

require_once ROOT_PATH . '/includes/layout_awal.php';
?>

<div class="card-panel">
    <form method="post" action="<?php echo url('pages/jurnal/simpan.php'); ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Pengarang</label>
            <input type="text" name="pengarang" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Volume</label>
                <input type="text" name="volume" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Nomor</label>
                <input type="text" name="no" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Halaman</label>
                <input type="text" name="halaman" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label>Berkas PDF</label>
            <input type="file" name="file" class="form-control-file" accept="application/pdf" required>
            <small class="form-text text-muted">Hanya berkas .pdf, maksimal 5 MB</small>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?php echo url('pages/jurnal/index.php'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php require_once ROOT_PATH . '/includes/layout_akhir.php'; ?>
