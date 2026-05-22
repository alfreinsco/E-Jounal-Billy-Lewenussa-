<?php
$pesan = ambil_pesan();
if ($pesan):
    $kelas = 'info';
    if ($pesan['tipe'] === 'sukses') {
        $kelas = 'success';
    } elseif ($pesan['tipe'] === 'peringatan') {
        $kelas = 'warning';
    } elseif ($pesan['tipe'] === 'gagal') {
        $kelas = 'danger';
    }
?>
<div class="alert alert-<?php echo $kelas; ?> alert-dismissible fade show" role="alert">
    <?php echo e($pesan['isi']); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>
