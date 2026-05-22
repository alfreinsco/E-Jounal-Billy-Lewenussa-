<?php
require_once __DIR__ . '/config/bootstrap.php';

$judul_halaman = 'Pencarian Jurnal';
$kata_kunci = trim($_GET['q'] ?? '');
$tahun = trim($_GET['tahun'] ?? '');
$ada_filter = $kata_kunci !== '' || $tahun !== '';

$sql_dasar = 'FROM jurnal WHERE 1=1';
$types = '';
$params = [];

if ($kata_kunci !== '') {
    $like = '%' . $kata_kunci . '%';
    $sql_dasar .= ' AND (judul LIKE ? OR pengarang LIKE ? OR halaman LIKE ?)';
    $types .= 'sss';
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
}

if ($tahun !== '' && ctype_digit($tahun)) {
    $sql_dasar .= ' AND tahun = ?';
    $types .= 'i';
    $params[] = (int) $tahun;
}

$stmt_count = mysqli_prepare($koneksi, 'SELECT COUNT(*) AS jumlah ' . $sql_dasar);
if ($types !== '') {
    mysqli_stmt_bind_param($stmt_count, $types, ...$params);
}
mysqli_stmt_execute($stmt_count);
$total_data = (int) mysqli_fetch_assoc(mysqli_stmt_get_result($stmt_count))['jumlah'];
mysqli_stmt_close($stmt_count);

$per_halaman = PER_HALAMAN;
$halaman_aktif = halaman_aktif();
$total_halaman = total_halaman_paginasi($total_data, $per_halaman);
$halaman_aktif = halaman_paginasi_valid($halaman_aktif, $total_halaman);
$offset = offset_paginasi($halaman_aktif, $per_halaman);

$sql_data = 'SELECT * ' . $sql_dasar . ' ORDER BY tahun DESC, id DESC LIMIT ?, ?';
$types_data = $types . 'ii';
$params_data = array_merge($params, [$offset, $per_halaman]);

$stmt = mysqli_prepare($koneksi, $sql_data);
mysqli_stmt_bind_param($stmt, $types_data, ...$params_data);
mysqli_stmt_execute($stmt);
$hasil = mysqli_stmt_get_result($stmt);

$path_paginasi = 'pencarian.php';
$params_paginasi = [];
if ($kata_kunci !== '') {
    $params_paginasi['q'] = $kata_kunci;
}
if ($tahun !== '') {
    $params_paginasi['tahun'] = $tahun;
}

require_once ROOT_PATH . '/includes/layout_publik_awal.php';
?>

<section class="publik-hero">
    <h1>Pencarian Jurnal</h1>
    <p class="text-muted mb-0">Cari dan unduh jurnal elektronik Universitas Pattimura tanpa perlu masuk.</p>
</section>

<div class="card-panel mb-4">
    <form method="get" action="<?php echo url('pencarian.php'); ?>" class="pencarian-form">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="q">Kata Kunci</label>
                <input type="text" name="q" id="q" class="form-control"
                       value="<?php echo e($kata_kunci); ?>"
                       placeholder="Judul, pengarang, atau halaman...">
            </div>
            <div class="form-group col-md-4">
                <label for="tahun">Tahun</label>
                <input type="number" name="tahun" id="tahun" class="form-control"
                       value="<?php echo e($tahun); ?>"
                       placeholder="Contoh: 2024" min="1900" max="2100">
            </div>
        </div>
        <div class="d-flex flex-wrap gap-actions">
            <button type="submit" class="btn btn-primary">Cari</button>
            <?php if ($ada_filter): ?>
            <a href="<?php echo url('pencarian.php'); ?>" class="btn btn-outline-secondary">Reset</a>
            <?php endif; ?>
        </div>
    </form>
</div>

<?php if ($ada_filter): ?>
<p class="hasil-info">
    <?php if ($total_data > 0): ?>
        Ditemukan <strong><?php echo $total_data; ?></strong> jurnal
        <?php if ($kata_kunci !== ''): ?> untuk &ldquo;<?php echo e($kata_kunci); ?>&rdquo;<?php endif; ?>
        <?php if ($tahun !== ''): ?> tahun <strong><?php echo e($tahun); ?></strong><?php endif; ?>.
    <?php else: ?>
        Tidak ada jurnal yang sesuai dengan pencarian Anda.
    <?php endif; ?>
</p>
<?php else: ?>
<p class="hasil-info text-muted">
    Menampilkan semua jurnal (<?php echo $total_data; ?> data). Gunakan form di atas untuk memfilter hasil.
</p>
<?php endif; ?>

<div class="card-panel">
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-light text-center">
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Vol</th>
                    <th>No</th>
                    <th>Halaman</th>
                    <th width="100">Berkas</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($total_data === 0): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <?php echo $ada_filter ? 'Tidak ada hasil. Coba kata kunci atau tahun lain.' : 'Belum ada jurnal tersedia.'; ?>
                    </td>
                </tr>
                <?php else: ?>
                <?php while ($d = mysqli_fetch_assoc($hasil)): ?>
                <tr>
                    <td><?php echo e($d['judul']); ?></td>
                    <td><?php echo e($d['pengarang']); ?></td>
                    <td class="text-center"><?php echo e($d['tahun']); ?></td>
                    <td class="text-center"><?php echo e($d['volume']); ?></td>
                    <td class="text-center"><?php echo e($d['no']); ?></td>
                    <td class="text-center"><?php echo e($d['halaman']); ?></td>
                    <td class="text-center">
                        <a href="<?php echo url(UPLOAD_JURNAL_URL . $d['file']); ?>" target="_blank" rel="noopener"
                           class="btn btn-sm btn-primary">PDF</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php include ROOT_PATH . '/includes/paginasi.php'; ?>
</div>

<?php
mysqli_stmt_close($stmt);
require_once ROOT_PATH . '/includes/layout_publik_akhir.php';
