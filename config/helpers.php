<?php

function base_url($path = '')
{
    static $base = null;
    if ($base === null) {
        $docRoot = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']));
        $rootPath = str_replace('\\', '/', ROOT_PATH);
        if ($docRoot && strpos($rootPath, $docRoot) === 0) {
            $base = rtrim(substr($rootPath, strlen($docRoot)), '/') . '/';
        } else {
            $base = '/';
        }
    }
    return $base . ltrim($path, '/');
}

function url($path = '')
{
    return base_url($path);
}

function e($string)
{
    return htmlspecialchars((string) $string, ENT_QUOTES, 'UTF-8');
}

function redirect_ke($path)
{
    header('Location: ' . url($path));
    exit;
}

function set_pesan($tipe, $pesan)
{
    $_SESSION['pesan_tipe'] = $tipe;
    $_SESSION['pesan_isi'] = $pesan;
}

function ambil_pesan()
{
    if (empty($_SESSION['pesan_isi'])) {
        return null;
    }
    $pesan = [
        'tipe' => $_SESSION['pesan_tipe'],
        'isi' => $_SESSION['pesan_isi'],
    ];
    unset($_SESSION['pesan_tipe'], $_SESSION['pesan_isi']);
    return $pesan;
}

function label_peran($peran)
{
    return $peran === 'admin' ? 'Administrator' : 'Petugas';
}
