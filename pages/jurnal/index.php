<?php
require_once __DIR__ . '/../../config/bootstrap.php';

$judul_halaman = 'Manajemen Jurnal';
$menu_aktif = 'jurnal';
$gunakan_datatable = true;

$data = mysqli_query($koneksi, 'SELECT * FROM jurnal ORDER BY id DESC');

require_once ROOT_PATH . '/includes/layout_awal.php';
?>

<div class="mb-3">
    <a href="<?php echo url('pages/jurnal/tambah.php'); ?>" class="btn btn-primary btn-sm">Tambah Jurnal</a>
</div>

<div class="card-panel">
    <div class="table-responsive">
        <table id="tabel-jurnal" class="table table-bordered table-striped mb-0 datatable-admin" data-no-order="6,7">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Vol</th>
                    <th>No</th>
                    <th>Halaman</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($d = mysqli_fetch_array($data)): ?>
                <tr>
                    <td><?php echo e($d['judul']); ?></td>
                    <td><?php echo e($d['pengarang']); ?></td>
                    <td class="text-center"><?php echo e($d['tahun']); ?></td>
                    <td class="text-center"><?php echo e($d['volume']); ?></td>
                    <td class="text-center"><?php echo e($d['no']); ?></td>
                    <td class="text-center"><?php echo e($d['halaman']); ?></td>
                    <td class="text-center">
                        <a href="<?php echo url(UPLOAD_JURNAL_URL . $d['file']); ?>" target="_blank" class="btn btn-sm btn-primary">PDF</a>
                    </td>
                    <td class="text-center text-nowrap">
                        <a href="<?php echo url('pages/jurnal/edit.php?id=' . $d['id']); ?>" class="btn btn-sm btn-warning">Ubah</a>
                        <a href="<?php echo url('pages/jurnal/hapus.php?id=' . $d['id']); ?>"
                           onclick="return confirm('Yakin ingin menghapus jurnal ini?')"
                           class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once ROOT_PATH . '/includes/layout_akhir.php'; ?>
