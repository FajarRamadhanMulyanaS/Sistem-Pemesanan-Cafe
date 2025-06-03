<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['user'])) {
    echo json_encode([]);
    exit;
}

$userId = $_SESSION['id_user'];
$query = "SELECT k.*, m.menu, m.foto, m.harga, k.total_harga, k.catatan
          FROM tb_keranjang k
          JOIN tb_menu m ON k.menu_id = m.kd_menu
          WHERE k.user_id = '$userId'";

$result = mysqli_query($koneksi, $query);

$cart = [];
while ($row = mysqli_fetch_assoc($result)) {
    $cart[] = $row;
}

echo json_encode($cart);
?>
