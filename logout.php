<?php
require_once __DIR__ . '/config/bootstrap.php';

keluar_pengguna();
set_pesan('sukses', 'Anda telah berhasil keluar.');
redirect_ke('login.php');
