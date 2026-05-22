<?php
require_once __DIR__ . '/../../config/bootstrap.php';
wajib_admin();

$judul_halaman = 'Manajemen Pengguna';
$menu_aktif = 'pengguna';
$gunakan_datatable = true;

$data = mysqli_query($koneksi, 'SELECT id, nama, username, peran, dibuat_pada FROM pengguna ORDER BY id DESC');
$pengguna_masuk = pengguna_masuk();

require_once ROOT_PATH . '/includes/layout_awal.php';
?>

<div class="mb-3">
    <a href="<?php echo url('pages/pengguna/tambah.php'); ?>" class="btn btn-primary btn-sm">Tambah Pengguna</a>
</div>

<div class="card-panel">
    <div class="table-responsive">
        <table id="tabel-pengguna" class="table table-bordered table-striped mb-0 datatable-admin" data-no-order="4">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Nama</th>
                    <th>Nama Pengguna</th>
                    <th>Peran</th>
                    <th>Dibuat</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($d = mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?php echo e($d['nama']); ?></td>
                    <td><?php echo e($d['username']); ?></td>
                    <td class="text-center"><?php echo e(label_peran($d['peran'])); ?></td>
                    <td class="text-center"><?php echo e(date('d/m/Y H:i', strtotime($d['dibuat_pada']))); ?></td>
                    <td class="text-center text-nowrap">
                        <a href="<?php echo url('pages/pengguna/edit.php?id=' . $d['id']); ?>" class="btn btn-sm btn-warning">Ubah</a>
                        <?php if ((int) $d['id'] !== (int) $pengguna_masuk['id']): ?>
                        <a href="<?php echo url('pages/pengguna/hapus.php?id=' . $d['id']); ?>"
                           onclick="return confirm('Yakin ingin menghapus pengguna ini?')"
                           class="btn btn-sm btn-danger">Hapus</a>
                        <?php else: ?>
                        <span class="badge badge-secondary">Anda</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once ROOT_PATH . '/includes/layout_akhir.php'; ?>
