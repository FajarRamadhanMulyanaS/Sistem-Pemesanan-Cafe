<?php
session_start();
include '../../config/koneksi.php';
include 'midtrans_config.php';

if (!isset($_SESSION['user'])) {
    echo "<div style='text-align:center; font-family:sans-serif; margin-top:20%;'>
            <h2>Anda harus login untuk checkout</h2>
            <a href='login.php' style='text-decoration:none; color:white; background-color:blue; padding:10px 20px; border-radius:5px;'>Login</a>
          </div>";
    exit;
}

$id_user = $_SESSION['id_user'];
if (!is_numeric($id_user)) {
    die("Invalid user ID.");
}

// Ambil nomor meja dari link
$no_meja = isset($_GET['meja']) ? intval($_GET['meja']) : 0;

// Ambil data keranjang
$query_cart = "SELECT k.*, m.harga, m.menu 
               FROM tb_keranjang k
               JOIN tb_menu m ON k.menu_id = m.kd_menu
               WHERE k.user_id = $id_user";
$result_cart = mysqli_query($koneksi, $query_cart);

if (mysqli_num_rows($result_cart) > 0) {
    $total_harga = 0;
    $items = [];

    // Buat pesanan baru di `tb_pesanan`
    $insert_pesanan = "INSERT INTO tb_pesanan (user_id, no_meja, status, total_harga, created_at) 
                        VALUES ($id_user, $no_meja, 'belum_bayar', 0, NOW())";
    if (!mysqli_query($koneksi, $insert_pesanan)) {
        echo "Gagal membuat pesanan.";
        exit;
    }
    $pesanan_id = mysqli_insert_id($koneksi);

    // Tambahkan detail pesanan
    while ($row = mysqli_fetch_assoc($result_cart)) {
        $total_harga += $row['jumlah'] * $row['harga'];
        $items[] = [
            'id' => $row['menu_id'],
            'price' => $row['harga'],
            'quantity' => $row['jumlah'],
            'name' => $row['menu']
        ];

        $insert_detail = "INSERT INTO tb_detail_pesanan (pesanan_id, menu_id, jumlah, harga, catatan ) 
                          VALUES ($pesanan_id, {$row['menu_id']}, {$row['jumlah']}, {$row['harga']}, '{$row['catatan']}')";
        mysqli_query($koneksi, $insert_detail);
    }

    // Perbarui total harga di `tb_pesanan`
    $update_total = "UPDATE tb_pesanan SET total_harga = $total_harga WHERE id = $pesanan_id";
    mysqli_query($koneksi, $update_total);

    // Hapus data keranjang
    $delete_cart_query = "DELETE FROM tb_keranjang WHERE user_id = $id_user";
    mysqli_query($koneksi, $delete_cart_query);

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

        echo "<div style='text-align:center; margin-top:20%; font-family:sans-serif;'>
                <h2>Proses Pembayaran</h2>
                <p>Mohon tunggu...</p>
              </div>";
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
            <h2>Keranjang Anda kosong.</h2>
            <a href='daftarmenu.php' style='text-decoration:none; color:white; background-color:blue; padding:10px 20px; border-radius:5px;'>Kembali ke Menu</a>
          </div>";
}
?>