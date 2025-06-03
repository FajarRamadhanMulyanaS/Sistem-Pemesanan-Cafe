<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$pesanan_id = isset($_GET['pesanan_id']) ? intval($_GET['pesanan_id']) : 0;
$status = isset($_GET['status']) ? $_GET['status'] : '';

if ($pesanan_id && in_array($status, ['sudah_bayar', 'dibatalkan'])) {
    $query = "UPDATE tb_pesanan SET status = '$status' WHERE id = $pesanan_id";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Status pesanan diperbarui!'); window.location.href='orderan_kamu.php';</script>";
    } else {
        echo "Gagal memperbarui status.";
    }
} else {
    echo "Data tidak valid.";
}
?>
