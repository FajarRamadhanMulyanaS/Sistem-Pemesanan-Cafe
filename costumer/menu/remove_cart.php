<?php
session_start();
include '../../config/koneksi.php';

$cartId = $_POST['id'];
$query = "DELETE FROM tb_keranjang WHERE id = '$cartId'";
mysqli_query($koneksi, $query);
?>
