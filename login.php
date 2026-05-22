<?php
require_once __DIR__ . '/config/bootstrap.php';

if (sudah_masuk()) {
    redirect_ke('pages/dashboard.php');
}

$pesan = ambil_pesan();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - E-Jurnal UNPATTI</title>
    <?php include __DIR__ . '/includes/head.php'; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo url('assets/css/admin.css'); ?>">
</head>
<body>
<div class="login-page">
    <div class="login-card">
        <div class="login-brand">
            <img src="<?php echo url(APP_LOGO); ?>" alt="Logo Universitas Pattimura" class="app-logo login-logo">
        </div>
        <h2>E-Jurnal</h2>
        <p class="subtitle">Universitas Pattimura — Silakan masuk ke akun Anda</p>

        <?php if ($pesan): ?>
            <?php
            $kelas = $pesan['tipe'] === 'sukses' ? 'success' : ($pesan['tipe'] === 'peringatan' ? 'warning' : 'danger');
            ?>
            <div class="alert alert-<?php echo $kelas; ?>"><?php echo e($pesan['isi']); ?></div>
        <?php endif; ?>

        <form method="post" action="<?php echo url('auth/proses_masuk.php'); ?>">
            <div class="form-group">
                <label for="username">Nama Pengguna</label>
                <input type="text" name="username" id="username" class="form-control" required autofocus
                       placeholder="Masukkan nama pengguna">
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control" required
                       placeholder="Masukkan kata sandi">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </form>
        <p class="text-muted text-center mt-3 mb-0" style="font-size:0.8rem;">
            Default: admin / admin123
        </p>
        <p class="text-center mt-2 mb-0">
            <a href="<?php echo url('pencarian.php'); ?>">Kembali ke pencarian jurnal</a>
        </p>
    </div>
</div>
</body>
</html>
