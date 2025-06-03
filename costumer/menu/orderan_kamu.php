<?php
session_start();
include '../../config/koneksi.php';

if (!isset($_SESSION['user'])) {
    echo "<div style='text-align:center; font-family:sans-serif; margin-top:20%;'>
            <h2>Anda harus login untuk melihat orderan</h2>
            <a href='../logincos.php' style='text-decoration:none; color:white; background-color:blue; padding:10px 20px; border-radius:5px;'>Login</a>
          </div>";
    exit;
}

$id_user = $_SESSION['id_user'];
$query_order = "SELECT p.*, dp.*, m.menu, dp.catatan 
                FROM tb_pesanan p
                JOIN tb_detail_pesanan dp ON p.id = dp.pesanan_id
                JOIN tb_menu m ON dp.menu_id = m.kd_menu
                WHERE p.user_id = $id_user AND p.status IN ('belum_bayar', 'sudah_bayar','diproses') 
                ORDER BY p.created_at DESC";

$result_order = mysqli_query($koneksi, $query_order);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orderan Kamu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        :root {
            --primary-color: #1f2a38;
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
        }

        .status.belum_bayar {
            background-color: var(--warning-color);
            color: white;
        }

        .status.sudah_bayar {
            background-color: var(--success-color);
            color: white;
        }

        .status.diproses {
            background-color: #9b59b6;
            color: white;
        }

        .actions {
            margin-top: 10px;
        }

        .actions a {
            display: inline-block;
            margin-right: 10px;
            padding: 8px 15px;
            font-size: 0.9rem;
            border-radius: 4px;
            text-decoration: none;
            color: white;
        }

        .actions .bayar {
            background-color: var(--primary-color);
        }

        .actions .batal {
            background-color: var(--danger-color);
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
        <a href="riwayat_pesanan.php"><i class="fas fa-history"></i> Riwayat</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="judul">Orderan Kamu</div>

    <div class="container">
        <?php if (mysqli_num_rows($result_order) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result_order)): ?>
                <div class="order-item">
                    <div class="menu-title"><?php echo $row['menu']; ?></div>
                    <div class="order-details">
                        <p><span>Jumlah:</span> <?php echo $row['jumlah']; ?></p>
                        <p><span>Catatan:</span> <?php echo $row['catatan'] ?: 'Tidak ada'; ?></p>
                        <p><span>Status:</span>
                            <span class="status <?php echo strtolower($row['status']); ?>">
                                <?php echo ucfirst(str_replace('_', ' ', $row['status'])); ?>
                            </span>
                        </p>
                    </div>
                    <div class="actions">
                        <?php if ($row['status'] == 'belum_bayar'): ?>
                            <a href="bayar.php?pesanan_id=<?php echo $row['pesanan_id']; ?>" class="bayar">Bayar</a>
                            <a href="batal.php?pesanan_id=<?php echo $row['pesanan_id']; ?>" class="batal">Batalkan</a>
                        <?php elseif ($row['status'] == 'sudah_bayar'): ?>
                            <span style="color: var(--success-color); font-weight: bold;">Menunggu proses</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty">
                <p>Belum ada pesanan.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
