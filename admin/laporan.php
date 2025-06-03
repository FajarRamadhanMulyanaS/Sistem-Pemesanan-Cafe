<?php
include '../config/koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="aset/logo/Logo Minkop.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="aset/logo/Logo Minkop.png" sizes="16x16" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f1e7;
        }

        nav {
            background-color: #6f4e37;
        }

        nav a {
            color: #fff;
        }

        nav a:hover {
            color: #f8f1e7;
        }

        .btn-custom {
            background-color: #6f4e37;
            color: #fff;
        }

        .btn-custom:hover {
            background-color: #a67c52;
        }

        table {
            margin-top: 20px;
            background-color: white;
        }

        th {
            background-color: #bdbdbd;
            color: black;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Laporan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>
                    <li class="nav-item"><a class="nav-link" href="user.php">Kelola User</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php"
                            onclick="return confirm('Apa anda yakin ?')">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Filter Form -->
    <div class="container mt-5">
        <h1 class="text-center text-brown mb-4">Laporan Transaksi</h1>
        <form method="post">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <label for="tgl_awal" class="form-label">Tanggal Awal</label>
                    <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tgl_akhir" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" name="filter" class="btn btn-custom w-100">Filter</button>
                </div>
            </div>
        </form>

        <!-- Table -->
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Kode Transaksi</th>
                    <th>Nama Menu</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    <th>Tanggal Transaksi</th>
                    <th>No Meja</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['filter'])) {
                    $tanggal_awal = $_POST['tgl_awal'];
                    $tanggal_akhir = $_POST['tgl_akhir'];
                    $query = mysqli_query($koneksi, "SELECT * FROM laporan WHERE tgl_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'");
                } else {
                    $query = mysqli_query($koneksi, "SELECT * FROM laporan");
                }
                $i = 0;
                while ($row = mysqli_fetch_array($query)) {
                    $i++;
                    echo "
                        <tr>
                            <td>{$i}</td>
                            <td>{$row['kode_transaksi']}</td>
                            <td>{$row['nama_menu']}</td>
                            <td>Rp." . number_format($row['harga'], 2, ',', '.') . "</td>
                            <td>Rp." . number_format($row['subtotal'], 2, ',', '.') . "</td>
                            <td>{$row['tgl_transaksi']}</td>
                            <td>{$row['no_meja']}</td>
                        </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>