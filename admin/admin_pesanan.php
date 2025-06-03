<?php
include '../config/koneksi.php';

$query_admin_order = "SELECT p.*, dp.*, u.Nama AS username, m.menu 
                      FROM tb_pesanan p
                      JOIN tb_detail_pesanan dp ON p.id = dp.pesanan_id
                      JOIN tb_menu m ON dp.menu_id = m.kd_menu
                      JOIN user u ON p.user_id = u.id_user
                      ORDER BY p.created_at DESC";

$result_admin_order = mysqli_query($koneksi, $query_admin_order);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pesanan</title>
    <style>
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .proses {
            background-color: #007bff;
            color: white;
        }
        .selesai {
            background-color: #28a745;
            color: white;
        }
        .done {
            background-color: #6c757d;
            color: white;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <h2>Pesanan</h2>
    <div id="pesanan-container">
        <?php if (mysqli_num_rows($result_admin_order) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result_admin_order)): ?>
                <div style="border: 1px solid #ddd; margin-bottom: 20px; padding: 10px;" id="pesanan-<?= $row['id']; ?>">
                    <p><strong>Nama Pembeli:</strong> <?= $row['username']; ?></p>
                    <p><strong>Menu:</strong> <?= $row['menu']; ?></p>
                    <p><strong>Jumlah:</strong> <?= $row['jumlah']; ?></p>
                    <p><strong>Catatan:</strong> <?= $row['catatan']; ?></p>
                    <p><strong>Status:</strong> <span id="status-<?= $row['id']; ?>"><?= ucfirst($row['status']); ?></span></p>
                    
                    <?php if ($row['status'] == 'sudah_bayar'): ?>
                        <button class="proses" onclick="updateStatus(<?= $row['id']; ?>, 'diproses')">Proses Pesanan</button>
                    <?php elseif ($row['status'] == 'diproses'): ?>
                        <button class="selesai" onclick="updateStatus(<?= $row['id']; ?>, 'selesai')">Pesanan Selesai</button>
                    <?php else: ?>
                        <button class="done" disabled>Selesai</button>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada pesanan.</p>
        <?php endif; ?>
    </div>

    <script>
        function updateStatus(pesananId, newStatus) {
            const formData = new FormData();
            formData.append('pesanan_id', pesananId);
            formData.append('status', newStatus);

            fetch('ubah_status.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`status-${pesananId}`).innerText = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
                    const buttonContainer = document.getElementById(`pesanan-${pesananId}`);
                    if (newStatus === 'diproses') {
                        buttonContainer.innerHTML += `<button class="selesai" onclick="updateStatus(${pesananId}, 'selesai')">Pesanan Selesai</button>`;
                    } else if (newStatus === 'selesai') {
                        buttonContainer.innerHTML = `<p><strong>Status:</strong> <span>Selesai</span></p>`;
                    }
                } else {
                    alert(data.message || 'Gagal memperbarui status.');
                }
            })
            .catch(err => {
                console.error('Error:', err);
                alert('Terjadi kesalahan saat memperbarui status.');
            });
        }
    </script>
</body>
</html>
