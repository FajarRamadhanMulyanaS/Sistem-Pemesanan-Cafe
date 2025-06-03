<?php
session_start();
include '../config/koneksi.php';

// Query data checkout
$query_checkout = "SELECT c.*, u.Nama
                   FROM tb_checkout c 
                   JOIN user u ON c.id_user = u.id_user 
                   ORDER BY c.waktu_checkout DESC";
$result_checkout = mysqli_query($koneksi, $query_checkout);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Checkout</title>
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Daftar Checkout</h1>
        <table class="w-full bg-white rounded-lg shadow-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-4">Nama User</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Waktu Checkout</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_checkout)) : ?>
                <tr>
                    <td class="p-4"><?php echo $row['Nama']; ?></td>
                    <td>Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $row['status_pembayaran']; ?></td>
                    <td><?php echo $row['waktu_checkout']; ?></td>
                    <td>
                    <a href="../costumer/menu/detail_checkout.php?id=<?php echo $row['id_checkout']; ?>" class="text-blue-500">Detail</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
