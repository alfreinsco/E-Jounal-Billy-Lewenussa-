<?php
/**
 * Variabel yang diperlukan:
 * $halaman_aktif, $total_halaman, $total_data, $per_halaman
 * $path_paginasi, $params_paginasi (array, opsional)
 */
if (!isset($params_paginasi) || !is_array($params_paginasi)) {
    $params_paginasi = [];
}
unset($params_paginasi['halaman']);

$mulai = ($halaman_aktif - 1) * $per_halaman + 1;
$akhir = min($halaman_aktif * $per_halaman, $total_data);

if ($total_data === 0) {
    return;
}
?>
<div class="paginasi-wrap d-flex flex-wrap justify-content-between align-items-center mt-3">
    <p class="paginasi-info text-muted mb-2 mb-md-0">
        Menampilkan <?php echo (int) $mulai; ?>–<?php echo (int) $akhir; ?>
        dari <?php echo (int) $total_data; ?> data
    </p>
    <?php if ($total_halaman > 1): ?>
    <nav aria-label="Navigasi halaman">
        <ul class="pagination pagination-sm mb-0">
            <li class="page-item <?php echo $halaman_aktif <= 1 ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?php echo $halaman_aktif <= 1 ? '#' : url_dengan_paginasi($path_paginasi, $params_paginasi, $halaman_aktif - 1); ?>">Sebelumnya</a>
            </li>
            <?php
            $rentang = 2;
            $awal = max(1, $halaman_aktif - $rentang);
            $akhir_hal = min($total_halaman, $halaman_aktif + $rentang);

            if ($awal > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo url_dengan_paginasi($path_paginasi, $params_paginasi, 1); ?>">1</a>
            </li>
            <?php if ($awal > 2): ?>
            <li class="page-item disabled"><span class="page-link">…</span></li>
            <?php endif;
            endif;

            for ($i = $awal; $i <= $akhir_hal; $i++): ?>
            <li class="page-item <?php echo $i === $halaman_aktif ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo url_dengan_paginasi($path_paginasi, $params_paginasi, $i); ?>"><?php echo $i; ?></a>
            </li>
            <?php endfor;

            if ($akhir_hal < $total_halaman): ?>
            <?php if ($akhir_hal < $total_halaman - 1): ?>
            <li class="page-item disabled"><span class="page-link">…</span></li>
            <?php endif; ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo url_dengan_paginasi($path_paginasi, $params_paginasi, $total_halaman); ?>"><?php echo (int) $total_halaman; ?></a>
            </li>
            <?php endif; ?>
            <li class="page-item <?php echo $halaman_aktif >= $total_halaman ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?php echo $halaman_aktif >= $total_halaman ? '#' : url_dengan_paginasi($path_paginasi, $params_paginasi, $halaman_aktif + 1); ?>">Berikutnya</a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
</div>
