<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $tmp = $_FILES['foto']['tmp_name'];
    $folder = "image/";
    $nama_file = $_FILES['foto']['name'];

    move_uploaded_file($tmp, "$folder/$nama_file");
    $a = mysqli_query($koneksi, "INSERT INTO tb_menu VALUES(null,'$_POST[menu]','$_POST[jenis]','$_POST[harga]','$_POST[status]','$nama_file','$_POST[kategori]')");
    echo "<script>alert('Berhasil Tersimpan');document.location.href='menu.php'</script>";
}

if (isset($_GET['hapus'])) {
    // Hapus data yang terkait di tb_keranjang berdasarkan menu_id
    $hapus_keranjang = mysqli_query($koneksi, "DELETE FROM tb_keranjang WHERE menu_id = '$_GET[id]'");

    // Hapus data menu dari tb_menu
    $hapus_menu = mysqli_query($koneksi, "DELETE FROM tb_menu WHERE kd_menu = '$_GET[id]'");

    // Validasi apakah kedua query berhasil
    if ($hapus_keranjang && $hapus_menu) {
        echo "<script>alert('Menu dan data terkait berhasil dihapus');document.location.href='menu.php'</script>";
    } else {
        // Tampilkan pesan error jika ada kegagalan
        echo "Error: " . mysqli_error($koneksi);
    }
}


if (isset($_GET['edit'])) {
    $edit = "SELECT * FROM tb_menu WHERE kd_menu = '$_GET[id]'";
    $take = mysqli_query($koneksi, $edit);
    $ambil = mysqli_fetch_array($take);
}

if (isset($_POST['update'])) {
    $tmp = $_FILES['foto']['tmp_name'];
    $folder = "image/";
    $nama_file = $_FILES['foto']['name'];

    if (!empty($nama_file)) {
        move_uploaded_file($tmp, "$folder/$nama_file");
    } else {
        $nama_file = $_POST['foto_lama'];
    }

    $c = mysqli_query($koneksi, "UPDATE tb_menu SET 
        menu = '$_POST[menu]', 
        jenis = '$_POST[jenis]',
        harga = '$_POST[harga]', 
        status = '$_POST[status]', 
        foto = '$nama_file', 
        kd_kategori = '$_POST[kategori]' 
        WHERE kd_menu = '$_GET[id]'");

    if ($c) {
        echo "<script>alert('Berhasil Diubah');document.location.href='menu.php'</script>";
    } else {
        echo "<script>alert('Gagal Mengubah Data');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <!-- Sidebar Navigation -->
    <nav>
        <img src="../aset/logo/Logo Minkop.png" alt="Cafe Logo">
        <a href="dashboard.php">Dashboard</a>
        <a href="menu.php" class="active">Menu</a>
        <a href="kategori.php">Kategori</a>

        <div class="logout-btn" onclick="confirmLogout()">Log Out</div>

        <script>
            function confirmLogout() {
                if (confirm('Apa anda yakin ingin keluar?')) {
                    window.location.href = 'logout.php'; // Mengarahkan ke halaman logout.php
                }
            }
        </script>
    </nav>

    <!-- Content Area -->
    <div class="container">
        <h1>Kelola Menu</h1>
        <form method="post" enctype="multipart/form-data" class="row g-3 mt-4">
            <div class="col-md-6">
                <label for="menu" class="form-label">Nama Menu</label>
                <input type="text" class="form-control" id="menu" name="menu" value="<?php echo @$ambil['menu']; ?>"
                    required>
            </div>
            <div class="col-md-6">
                <label for="jenis" class="form-label">Jenis</label>
                <select class="form-select" id="jenis" name="jenis">
                    <option value="Makanan" <?php echo (@$ambil['jenis'] == 'Makanan') ? 'selected' : ''; ?>>Makanan
                    </option>
                    <option value="Minuman" <?php echo (@$ambil['jenis'] == 'Minuman') ? 'selected' : ''; ?>>Minuman
                    </option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga"
                    value="<?php echo @$ambil['harga']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="Tersedia" <?php echo (@$ambil['status'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia
                    </option>
                    <option value="Habis" <?php echo (@$ambil['status'] == 'Habis') ? 'selected' : ''; ?>>Habis</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
                <input type="hidden" name="foto_lama" value="<?php echo @$ambil['foto']; ?>">
                <?php if (!empty($ambil['foto'])): ?>
                    <img src="image/<?php echo $ambil['foto']; ?>" alt="Foto Menu" class="img-thumbnail mt-2" width="150">
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select" id="kategori" name="kategori">
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                    while ($kategori = mysqli_fetch_array($query)) {
                        $selected = (@$ambil['kd_kategori'] == $kategori['kd_kategori']) ? 'selected' : '';
                        echo "<option value='{$kategori['kd_kategori']}' $selected>{$kategori['kategori']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 text-end">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <button type="submit" name="update" class="btn btn-warning">Update</button>
            </div>
        </form>

        <table class="table mt-5 text-center">
            <thead>
                <tr>
                    <th>Kode Menu</th>
                    <th>Menu</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Foto</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($koneksi, "SELECT * FROM tb_menu");
                while ($row = mysqli_fetch_array($result)) {
                    echo "
                    <tr>
                        <td>{$row['kd_menu']}</td>
                        <td>{$row['menu']}</td>
                        <td>{$row['jenis']}</td>
                        <td>Rp. " . number_format($row['harga'], 2, ',', '.') . "</td>
                        <td>{$row['status']}</td>
                        <td><img src='image/{$row['foto']}' alt='Menu' width='100'></td>
                        <td>{$row['kd_kategori']}</td>
                        <td>
                            <a href='menu.php?edit&id={$row['kd_menu']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='menu.php?hapus&id={$row['kd_menu']}' class='btn btn-danger btn-sm'>Hapus</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>