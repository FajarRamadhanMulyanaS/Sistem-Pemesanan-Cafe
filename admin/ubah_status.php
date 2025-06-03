<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pesanan_id = intval($_POST['pesanan_id']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    $allowed_status = ['diproses', 'selesai'];

    if (!in_array($status, $allowed_status)) {
        echo json_encode(['success' => false, 'message' => 'Status tidak valid']);
        exit();
    }

    $query_update = "UPDATE tb_pesanan SET status = '$status' WHERE id = $pesanan_id";
    if (mysqli_query($koneksi, $query_update)) {
        echo json_encode(['success' => true, 'message' => 'Status berhasil diubah']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode tidak valid']);
}
