<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-gq6qsQHGNPvGwnS5YyKyYPKD';
\Midtrans\Config::$isProduction = false; // Ubah ke `true` untuk produksi
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;
?>
