<?php
session_start();
include '../../config/koneksi.php';
include 'midtrans_config.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['user'])) {
    echo "<div style='text-align:center; font-family:sans-serif; margin-top:20%;'>
            <h2>Anda harus login untuk melanjutkan</h2>
            <a href='../logincos.php' style='text-decoration:none; color:white; background-color:blue; padding:10px 20px; border-radius:5px;'>Login</a>
          </div>";
    exit;
}

$pesanan_id = isset($_GET['pesanan_id']) ? intval($_GET['pesanan_id']) : 0;
if (!$pesanan_id) {
    die("Pesanan tidak ditemukan.");
}

// Ambil detail pesanan
$query = "SELECT dp.*, m.menu, m.harga FROM tb_detail_pesanan dp
          JOIN tb_menu m ON dp.menu_id = m.kd_menu
          WHERE dp.pesanan_id = $pesanan_id";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    $total_harga = 0;
    $items = []; // Untuk data Midtrans

    while ($row = mysqli_fetch_assoc($result)) {
        $total_harga += $row['jumlah'] * $row['harga'];
        $items[] = [
            'id' => $row['menu_id'],
            'price' => $row['harga'],
            'quantity' => $row['jumlah'],
            'name' => $row['menu']
        ];
    }

    // Data transaksi Midtrans
    $transaction_details = [
        'order_id' => 'ORDER-' . $pesanan_id,
        'gross_amount' => $total_harga
    ];

    $customer_details = [
        'first_name' => $_SESSION['user']['Nama'],
        'phone' => $_SESSION['user']['No_Hp']
    ];

    $payload = [
        'transaction_details' => $transaction_details,
        'item_details' => $items,
        'customer_details' => $customer_details
    ];

    try {
        $snapToken = \Midtrans\Snap::getSnapToken($payload);

        echo "<script src='https://app.sandbox.midtrans.com/snap/snap.js' data-client-key='SB-Mid-client-Um-w6-srwguainWD'></script>";
        echo "<script>
            snap.pay('$snapToken', {
                onSuccess: function(result) {
                    alert('Pembayaran berhasil!');
                    window.location.href = 'update_status.php?pesanan_id=$pesanan_id&status=sudah_bayar';
                },
                onPending: function(result) {
                    alert('Transaksi tertunda.');
                    window.location.href = 'orderan_kamu.php';
                },
                onError: function(result) {
                    alert('Pembayaran gagal!');
                    window.location.href = 'orderan_kamu.php';
                },
                onClose: function() {
                    alert('Anda menutup popup pembayaran.');
                    window.location.href = 'orderan_kamu.php';
                }
            });
        </script>";
    } catch (Exception $e) {
        echo "<div style='text-align:center; font-family:sans-serif; margin-top:20%;'>
                <h2>Gagal memproses pembayaran</h2>
                <p>" . $e->getMessage() . "</p>
                <a href='orderan_kamu.php' style='text-decoration:none; color:white; background-color:blue; padding:10px 20px; border-radius:5px;'>Kembali</a>
              </div>";
    }
} else {
    echo "<div style='text-align:center; font-family:sans-serif; margin-top:20%;'>
            <h2>Pesanan tidak ditemukan.</h2>
            <a href='orderan_kamu.php' style='text-decoration:none; color:white; background-color:blue; padding:10px 20px; border-radius:5px;'>Kembali</a>
          </div>";
}
?>
