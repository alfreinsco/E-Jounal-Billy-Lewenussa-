<?php
require_once __DIR__ . '/../../config/bootstrap.php';
wajib_admin();

$id = (int) ($_GET['id'] ?? 0);
$stmt = mysqli_prepare($koneksi, 'SELECT id, nama, username, peran FROM pengguna WHERE id = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$d = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$d) {
    set_pesan('gagal', 'Data pengguna tidak ditemukan.');
    redirect_ke('pages/pengguna/index.php');
}

$judul_halaman = 'Ubah Pengguna';
$menu_aktif = 'pengguna';

require_once ROOT_PATH . '/includes/layout_awal.php';
?>

<div class="card-panel">
    <form method="post" action="<?php echo url('pages/pengguna/update.php'); ?>">
        <input type="hidden" name="id" value="<?php echo (int) $d['id']; ?>">

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="<?php echo e($d['nama']); ?>" required>
        </div>
        <div class="form-group">
            <label>Nama Pengguna</label>
            <input type="text" name="username" class="form-control" value="<?php echo e($d['username']); ?>" required>
        </div>
        <div class="form-group">
            <label>Kata Sandi Baru</label>
            <input type="password" name="password" class="form-control" minlength="6" autocomplete="new-password">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah kata sandi</small>
        </div>
        <div class="form-group">
            <label>Peran</label>
            <select name="peran" class="form-control" required>
                <option value="petugas" <?php echo $d['peran'] === 'petugas' ? 'selected' : ''; ?>>Petugas</option>
                <option value="admin" <?php echo $d['peran'] === 'admin' ? 'selected' : ''; ?>>Administrator</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="<?php echo url('pages/pengguna/index.php'); ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>

<?php require_once ROOT_PATH . '/includes/layout_akhir.php'; ?>
