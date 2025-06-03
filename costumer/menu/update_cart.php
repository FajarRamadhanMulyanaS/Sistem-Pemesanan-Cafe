<?php
session_start();
include '../../config/koneksi.php';

$cartId = $_POST['id'];
$newQuantity = $_POST['jumlah'];
$catatan = $_POST['catatan'];

// Ambil harga per menu
$query = "SELECT m.harga FROM tb_keranjang k
          JOIN tb_menu m ON k.menu_id = m.kd_menu
          WHERE k.id = '$cartId'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
$price = $row['harga'];

// Hitung total harga
$totalPrice = $price * $newQuantity;

// Update jumlah dan total harga di keranjang
$newQuantity = isset($_POST['jumlah']) ? $_POST['jumlah'] : null;
if ($newQuantity !== null) {
    $query = "UPDATE tb_keranjang SET jumlah = '$newQuantity', total_harga = '$totalPrice'WHERE id = '$cartId'";
    mysqli_query($koneksi, $query);
}

$catatan = isset($_POST['catatan']) ? $_POST['catatan'] : null;
if ($catatan !== null) {
    $query = "UPDATE tb_keranjang SET catatan = '$catatan' WHERE id = $cartId";
    mysqli_query($koneksi, $query);
}



echo json_encode(['status' => 'success']);
?>
