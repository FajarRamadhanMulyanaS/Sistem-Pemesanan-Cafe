<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$id_user = $_SESSION['id_user'];

$query_riwayat = "SELECT p.*, dp.*, m.menu, dp.catatan 
                  FROM tb_pesanan p
                  JOIN tb_detail_pesanan dp ON p.id = dp.pesanan_id
                  JOIN tb_menu m ON dp.menu_id = m.kd_menu
                  WHERE p.user_id = $id_user AND p.status IN ('selesai', 'dibatalkan')
                  ORDER BY p.created_at DESC";

$result_riwayat = mysqli_query($koneksi, $query_riwayat);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        :root {
            --primary-color:#1f2a38;
            --danger-color: #e74c3c;
            --success-color: #2ecc71;
            --warning-color: #f1c40f;
            --bg-light: #f7f7f7;
            --text-color: #333;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--bg-light);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: var(--primary-color);
            padding: 10px 0;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        .judul {
            background-color: white;
            padding: 15px 20px;
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 0 15px;
        }

        .order-item {
            background: white;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            padding: 15px 20px;
        }

        .menu-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 8px;
            color: var(--text-color);
        }

        .order-details p {
            margin: 5px 0;
            color: #555;
        }

        .order-details span {
            font-weight: 500;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-top: 10px;
        }

        .status.selesai {
            background-color: var(--success-color);
            color: white;
        }

        .status.dibatalkan {
            background-color: var(--danger-color);
            color: white;
        }

        .empty {
            text-align: center;
            margin-top: 50px;
            color: #888;
        }

        @media (max-width: 600px) {
            .judul {
                font-size: 1.4rem;
            }
            .menu-title {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="daftarmenu.php"><i class="fas fa-utensils"></i> Menu</a>
    <a href="orderan_kamu.php"><i class="fas fa-box"></i> Orderan</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="judul">Riwayat Pesanan</div>

<div class="container">
    <?php if (mysqli_num_rows($result_riwayat) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result_riwayat)): ?>
            <div class="order-item">
                <div class="menu-title"><?php echo $row['menu']; ?></div>
                <div class="order-details">
                    <p><span>Jumlah:</span> <?php echo $row['jumlah']; ?></p>
                    <p><span>Catatan:</span> <?php echo $row['catatan'] ?: 'Tidak ada catatan'; ?></p>
                    <p><span>Total Harga:</span> Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></p>
                </div>
                <div class="status <?php echo $row['status']; ?>">
                    Status: <?php echo ucfirst($row['status']); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="empty">
            <p>Anda belum memiliki riwayat pesanan.</p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
