<?php
require_once __DIR__ . '/../../config/bootstrap.php';
wajib_admin();

$judul_halaman = 'Tambah Pengguna';
$menu_aktif = 'pengguna';

require_once ROOT_PATH . '/includes/layout_awal.php';
?>

<div class="card-panel">
    <form method="post" action="<?php echo url('pages/pengguna/simpan.php'); ?>">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Nama Pengguna</label>
            <input type="text" name="username" class="form-control" required autocomplete="off">
        </div>
        <div class="form-group">
            <label>Kata Sandi</label>
            <input type="password" name="password" class="form-control" required minlength="6">
            <small class="form-text text-muted">Minimal 6 karakter</small>
        </div>
        <div class="form-group">
            <label>Peran</label>
            <select name="peran" class="form-control" required>
                <option value="petugas">Petugas</option>
                <option value="admin">Administrator</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?php echo url('pages/pengguna/index.php'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php require_once ROOT_PATH . '/includes/layout_akhir.php'; ?>
