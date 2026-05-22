<?php

function mulai_sesi()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function sudah_masuk()
{
    mulai_sesi();
    return !empty($_SESSION['user_id']);
}

function wajib_masuk()
{
    if (!sudah_masuk()) {
        redirect_ke('login.php');
    }
}

function wajib_admin()
{
    wajib_masuk();
    if (($_SESSION['peran'] ?? '') !== 'admin') {
        set_pesan('gagal', 'Anda tidak memiliki akses ke halaman ini.');
        redirect_ke('pages/dashboard.php');
    }
}

function pengguna_masuk()
{
    mulai_sesi();
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'nama' => $_SESSION['nama'] ?? '',
        'username' => $_SESSION['username'] ?? '',
        'peran' => $_SESSION['peran'] ?? '',
    ];
}

function masukkan_pengguna($user)
{
    mulai_sesi();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['peran'] = $user['peran'];
}

function keluar_pengguna()
{
    mulai_sesi();
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    session_destroy();
}
