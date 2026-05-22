<?php

define('PER_HALAMAN', 10);

function halaman_aktif()
{
    $halaman = (int) ($_GET['halaman'] ?? 1);
    return max(1, $halaman);
}

function offset_paginasi($halaman, $per_halaman = PER_HALAMAN)
{
    return ($halaman - 1) * $per_halaman;
}

function total_halaman_paginasi($total_data, $per_halaman = PER_HALAMAN)
{
    return max(1, (int) ceil($total_data / $per_halaman));
}

function halaman_paginasi_valid($halaman, $total_halaman)
{
    return min(max(1, $halaman), $total_halaman);
}

function url_dengan_paginasi($path, $params, $halaman)
{
    $params['halaman'] = $halaman;
    $query = http_build_query($params);
    return url($path) . ($query !== '' ? '?' . $query : '');
}
