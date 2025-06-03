<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['level'] == "") {
    header("location:index.php");
    exit;
} elseif ($_SESSION['level'] == "kasir") {
    header("location:dash_kasir.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $sql = mysqli_query($koneksi, "INSERT INTO tb_kategori VALUES(null, '$_POST[kategori]')");
    echo "<script>alert('Data Tersimpan');document.location.href='?menu=kategori'</script>";
}

$perintah = new oop();
$table = "tb_kategori";
$redirect = "?menu=kategori";
@$where = "kd_kategori = $_GET[id]";


// Edit kategori
if (isset($_GET['edit']) && isset($_GET['id'])) {
    $sql = mysqli_query($koneksi, "SELECT * FROM tb_kategori WHERE kd_kategori = '$_GET[id]'");
    $edit = mysqli_fetch_array($sql);
}

// Update kategori dan update menu yang terkait
if (isset($_POST['update']) && isset($_GET['id'])) {
    // Update kategori di tb_kategori
    $update_kategori = mysqli_query($koneksi, "UPDATE tb_kategori SET kategori='$_POST[kategori]' WHERE kd_kategori='$_GET[id]'");

    // Update kategori pada semua menu yang memiliki kategori ini
    $update_menu = mysqli_query($koneksi, "UPDATE tb_menu SET kd_kategori='$_GET[id]' WHERE kd_kategori='$_GET[id]'");

    if ($update_kategori && $update_menu) {
        echo "<script>alert('Data Kategori dan Menu Berhasil Terupdate');document.location.href='kategori.php'</script>";
    } else {
        echo printf("Error : %s\n", mysqli_error($koneksi));
        exit();
    }
}

// Hapus kategori dan semua menu terkait
if (isset($_GET['hapus']) && isset($_GET['id'])) {
    $id_kategori = mysqli_real_escape_string($koneksi, $_GET['id']); // Sanitasi input

    // Hapus data di tb_keranjang yang terkait dengan menu dari kategori ini
    $hapus_keranjang = mysqli_query($koneksi, "
        DELETE tb_keranjang
        FROM tb_keranjang
        INNER JOIN tb_menu ON tb_keranjang.menu_id = tb_menu.kd_menu
        WHERE tb_menu.kd_kategori = '$id_kategori'
    ");

    // Hapus semua menu yang memiliki kategori ini
    $hapus_menu = mysqli_query($koneksi, "DELETE FROM tb_menu WHERE kd_kategori = '$id_kategori'");

    // Hapus kategori dari tb_kategori
    $hapus_kategori = mysqli_query($koneksi, "DELETE FROM tb_kategori WHERE kd_kategori = '$id_kategori'");

    // Validasi apakah semua query berhasil
    if ($hapus_keranjang && $hapus_menu && $hapus_kategori) {
        echo "<script>alert('Kategori dan Menu Terkait Terhapus');document.location.href='?menu=kategori'</script>";
    } else {
        // Tampilkan error jika ada query yang gagal
        echo "Error: " . mysqli_error($koneksi);
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <!-- Sidebar -->
    <nav>
        <img src="../aset/logo/Logo Minkop.png" alt="Cafe Logo">
        <a href="dashboard.php">Dashboard</a>
        <a href="menu.php">Menu</a>
        <a href="kategori.php" class="active">Kategori</a>

        <div class="logout-btn" onclick="confirmLogout()">Log Out</div>

        <script>
            function confirmLogout() {
                if (confirm('Apa anda yakin ingin keluar?')) {
                    window.location.href = 'logout.php'; // Mengarahkan ke halaman logout.php
                }
            }
        </script>
    </nav>

    <!-- Content -->
    <div class="container">
        <h1>Kelola Kategori</h1>

        <!-- Form Input Kategori -->
        <div class="row mb-4">
            <div class="col-md-6 offset-md-3">
                <div class="card p-4">
                    <form method="post">
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori"
                                value="<?php echo @$edit['kategori']; ?>" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="simpan" class="btn btn-custom me-2">Simpan</button>
                            <button type="submit" name="update" class="btn btn-custom">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table Kategori -->
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Kode Kategori</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                            while ($row = mysqli_fetch_array($sql)) {
                                echo "
                                    <tr>
                                        <td>{$row['kd_kategori']}</td>
                                        <td>{$row['kategori']}</td>
                                        <td>
                                            <a href='?edit&id={$row['kd_kategori']}' class='btn btn-warning btn-sm'>Edit</a>
                                            <a href='?hapus&id={$row['kd_kategori']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Hapus kategori dan menu terkait?\")'>Hapus</a>
                                        </td>
                                    </tr>
                                ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>