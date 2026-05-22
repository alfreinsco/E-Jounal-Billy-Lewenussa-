<?php
require_once __DIR__ . '/config/bootstrap.php';

if (sudah_masuk()) {
    redirect_ke('pages/dashboard.php');
}

redirect_ke('pencarian.php');
