<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['user'])) {
    echo "Anda harus login untuk menambahkan ke keranjang.";
    exit;
}

$userId = $_SESSION['id_user'];
$menuId = $_POST['menu_id'];
$jumlah = $_POST['jumlah'];
$catatan = $_POST['catatan'];
$totalHarga = $_POST['total_harga'];

$query = "INSERT INTO tb_keranjang (user_id, menu_id, jumlah, catatan, total_harga) 
          VALUES ('$userId', '$menuId', '$jumlah', '$catatan', '$totalHarga')";
if (mysqli_query($koneksi, $query)) {
    echo "Menu berhasil ditambahkan ke keranjang.";
} else {
    echo "Terjadi kesalahan: " . mysqli_error($koneksi);
}
?>

