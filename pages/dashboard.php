<?php
require_once __DIR__ . '/../config/bootstrap.php';

$judul_halaman = 'Beranda';
$menu_aktif = 'dashboard';
$gunakan_datatable = true;

$total_jurnal = mysqli_fetch_assoc(mysqli_query($koneksi, 'SELECT COUNT(*) AS jumlah FROM jurnal'))['jumlah'];
$total_pengguna = mysqli_fetch_assoc(mysqli_query($koneksi, 'SELECT COUNT(*) AS jumlah FROM pengguna'))['jumlah'];
$jurnal_terbaru = mysqli_query($koneksi, 'SELECT * FROM jurnal ORDER BY id DESC LIMIT 5');

require_once ROOT_PATH . '/includes/layout_awal.php';
?>

<div class="row mb-4">
    <div class="col-md-6 mb-3 mb-md-0">
        <div class="stat-card">
            <h3><?php echo (int) $total_jurnal; ?></h3>
            <p>Total Jurnal</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card" style="border-left-color:#10b981;">
            <h3><?php echo (int) $total_pengguna; ?></h3>
            <p>Total Pengguna</p>
        </div>
    </div>
</div>

<div class="card-panel">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Jurnal Terbaru</h5>
        <a href="<?php echo url('pages/jurnal/index.php'); ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="table-responsive">
        <table id="tabel-jurnal-terbaru" class="table table-bordered table-striped mb-0 datatable-admin" data-no-order="3">
            <thead class="thead-light text-center">
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($d = mysqli_fetch_assoc($jurnal_terbaru)): ?>
                <tr>
                    <td><?php echo e($d['judul']); ?></td>
                    <td><?php echo e($d['pengarang']); ?></td>
                    <td class="text-center"><?php echo e($d['tahun']); ?></td>
                    <td class="text-center">
                        <a href="<?php echo url(UPLOAD_JURNAL_URL . $d['file']); ?>" target="_blank" class="btn btn-sm btn-primary">PDF</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once ROOT_PATH . '/includes/layout_akhir.php'; ?>
