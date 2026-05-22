<?php
wajib_masuk();
$pengguna = pengguna_masuk();
if (!isset($judul_halaman)) {
    $judul_halaman = 'Panel Admin';
}
if (!isset($menu_aktif)) {
    $menu_aktif = '';
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
<body class="admin-body">
<div class="admin-wrapper">
    <aside class="admin-sidebar">
        <div class="sidebar-brand">
            <a href="<?php echo url('pages/dashboard.php'); ?>" class="sidebar-brand-link">
                <img src="<?php echo url(APP_LOGO); ?>" alt="Logo Universitas Pattimura" class="app-logo sidebar-logo">
                <span class="sidebar-brand-text">
                    E-Jurnal
                    <small>Universitas Pattimura</small>
                </span>
            </a>
        </div>
        <div class="sidebar-user">
            <strong><?php echo e($pengguna['nama']); ?></strong>
            <span><?php echo e(label_peran($pengguna['peran'])); ?></span>
        </div>
        <ul class="sidebar-nav">
            <li>
                <a href="<?php echo url('pages/dashboard.php'); ?>" class="<?php echo $menu_aktif === 'dashboard' ? 'active' : ''; ?>">
                    Beranda
                </a>
            </li>
            <li>
                <a href="<?php echo url('pages/jurnal/index.php'); ?>" class="<?php echo $menu_aktif === 'jurnal' ? 'active' : ''; ?>">
                    Manajemen Jurnal
                </a>
            </li>
            <?php if ($pengguna['peran'] === 'admin'): ?>
            <li>
                <a href="<?php echo url('pages/pengguna/index.php'); ?>" class="<?php echo $menu_aktif === 'pengguna' ? 'active' : ''; ?>">
                    Manajemen Pengguna
                </a>
            </li>
            <?php endif; ?>
            <li><div class="nav-divider"></div></li>
            <li>
                <a href="<?php echo url('logout.php'); ?>" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                    Keluar
                </a>
            </li>
        </ul>
    </aside>
    <div class="admin-content">
        <header class="admin-topbar">
            <div class="topbar-title">
                <img src="<?php echo url(APP_LOGO); ?>" alt="Logo UNPATTI" class="app-logo topbar-logo">
                <h1><?php echo e($judul_halaman); ?></h1>
            </div>
        </header>
        <main class="admin-main">
            <?php include ROOT_PATH . '/includes/alert.php'; ?>
