<?php
session_start();
include '../../config/koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user'])) {
    header('Location: ../logincos.php');
    exit();
}

if (isset($_GET['pesanan_id'])) {
    $pesanan_id = intval($_GET['pesanan_id']);

    // Update status pesanan menjadi dibatalkan
    $query_batal = "UPDATE tb_pesanan SET status = 'dibatalkan' WHERE id = $pesanan_id";
    if (mysqli_query($koneksi, $query_batal)) {
        // Redirect ke halaman orderan_kamu.php dengan pesan sukses
        header('Location: orderan_kamu.php?message=Pesanan berhasil dibatalkan');
    } else {
        // Redirect dengan pesan error
        header('Location: orderan_kamu.php?message=Gagal membatalkan pesanan');
    }
} else {
    header('Location: orderan_kamu.php');
}
?>
