<?php
if (!isset($judul_halaman)) {
    $judul_halaman = 'Pencarian Jurnal';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($judul_halaman); ?> - E-Jurnal UNPATTI</title>
    <?php include ROOT_PATH . '/includes/head.php'; ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo url('assets/css/admin.css'); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body class="publik-body">
<header class="publik-header">
    <div class="container">
        <div class="publik-header-inner">
            <a href="<?php echo url('pencarian.php'); ?>" class="publik-brand">
                <img src="<?php echo url(APP_LOGO); ?>" alt="Logo Universitas Pattimura" class="app-logo publik-logo">
                <span>
                    <strong>E-Jurnal</strong>
                    <small>Universitas Pattimura</small>
                </span>
            </a>
            <nav class="publik-nav">
                <a href="<?php echo url('pencarian.php'); ?>" class="active">Pencarian</a>
                <?php if (sudah_masuk()): ?>
                <a href="<?php echo url('pages/dashboard.php'); ?>">Panel Admin</a>
                <a href="<?php echo url('logout.php'); ?>">Keluar</a>
                <?php else: ?>
                <a href="<?php echo url('login.php'); ?>">Masuk</a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>
<main class="publik-main">
    <div class="container">
