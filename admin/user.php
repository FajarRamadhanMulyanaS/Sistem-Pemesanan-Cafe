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
  $sql = mysqli_query($koneksi, "INSERT INTO tb_user VALUES(null,'$_POST[nama]','$_POST[nohp]','$_POST[username]','$_POST[password]','$_POST[level]')");

  echo "<script>alert('Data Tersimpan');document.location.href='?menu=user'</script>";
}
$perintah = new oop();
$table = "tb_user";
$redirect = "?menu=user";
@$where = "nama = $_GET[id]";


/*if(isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $nohp = $_POST['nohp'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $level = $_POST['level'];

  $value = "'','$nama','$nohp','$username','$password','$level'";
  $cek = $perintah->countWhere("username","username",$table,"username",$username);
  if ($cek['username'] > 0) {
      echo "<script>alert('username tidak boleh sama');document.location.href='user.php'</script>";
    }
    else{
      $perintah->simpan($table,$value,"user.php");
    }
}*/
if (isset($_GET['edit'])) {
  $sql = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE kd_user = '$_GET[id]'");
  $edit = mysqli_fetch_array($sql);
}
if (isset($_POST['updateuser'])) {
  $sql = mysqli_query($koneksi, "UPDATE tb_user SET nama='$_POST[nama]',no_hp='$_POST[nohp]', username='$_POST[username]',password='$_POST[password]',level='$_POST[level]' WHERE kd_user='$_GET[id]'");
  if ($sql) {

    echo "<script>alert('Data Berhasil Terupdate');document.location.href='user.php'</script>";
  } else {
    echo printf("Error : %s\n", mysqli_error($koneksi));
    exit();
  }
}
if (isset($_GET['hapus'])) {
  $sql = mysqli_query($koneksi, "DELETE FROM tb_user WHERE kd_user = '$_GET[id]'");

  echo "<script>alert('Data Terhapus');document.location.href='?menu=user'</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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

    h1 {
      color: #6f4e37;
    }

    .form-label {
      color: #6f4e37;
    }

    .btn-custom {
      background-color: #6f4e37;
      color: #fff;
    }

    .btn-custom:hover {
      background-color: #a67c52;
    }

    .table th {
      background-color: #6f4e37;
      color: white;
    }

    .table tbody tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="dashboard.php">Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>
          <li class="nav-item"><a class="nav-link" href="user.php">Kelola User</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php" onclick="return confirm('Apa anda yakin ?')">Log
              Out</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <h1 class="text-center mb-4">Kelola User</h1>

    <form method="post">
      <div class="row mb-3">
        <label for="nama" class="col-3 col-form-label">Nama Lengkap</label>
        <div class="col-9">
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan nama.." required
            value="<?php echo @$edit['nama']; ?>">
        </div>
      </div>

      <div class="row mb-3">
        <label for="ry" class="col-3 col-form-label">No HP</label>
        <div class="col-9">
          <input type="text" class="form-control" id="ry" name="nohp" placeholder="No HP" required
            value="<?php echo @$edit['no_hp']; ?>">
        </div>
      </div>

      <div class="row mb-3">
        <label for="us" class="col-3 col-form-label">Username</label>
        <div class="col-9">
          <input type="text" class="form-control" id="us" name="username" placeholder="Username" required
            value="<?php echo @$edit['username']; ?>">
        </div>
      </div>

      <div class="row mb-3">
        <label for="pw" class="col-3 col-form-label">Password</label>
        <div class="col-9">
          <input type="text" class="form-control" id="pw" name="password" placeholder="Password" required
            value="<?php echo @$edit['password']; ?>">
        </div>
      </div>

      <div class="row mb-3">
        <label for="lvl" class="col-3 col-form-label">Level</label>
        <div class="col-9">
          <select id="lvl" name="level" class="form-select">
            <option value="admin" <?php if (@$edit['level'] == 'admin')
              echo 'selected'; ?>>Admin</option>
            <option value="Owner" <?php if (@$edit['level'] == 'Owner')
              echo 'selected'; ?>>Owner</option>
            <option value="Dapur" <?php if (@$edit['level'] == 'Dapur')
              echo 'selected'; ?>>Dapur</option>
          </select>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col-9 offset-3">
          <input type="submit" class="btn btn-custom" name="simpan" value="Simpan">
          <input type="submit" class="btn btn-warning" name="updateuser" value="Update">
        </div>
      </div>
    </form>

    <form method="post" class="mb-3">
      <div class="d-flex justify-content-end">
        <input type="text" name="tcari" class="form-control w-50" value="<?php echo @$_POST['tcari']; ?>"
          placeholder="Cari...">
        <button type="submit" name="cari" class="btn btn-info ms-2">Cari</button>
      </div>
    </form>

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Kode User</th>
          <th>Nama</th>
          <th>No HP</th>
          <th>Username</th>
          <th>Password</th>
          <th>Level</th>
          <th colspan="2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = isset($_POST['cari']) ? "SELECT * FROM q_user WHERE nama LIKE '%$_POST[tcari]%'" : "SELECT * FROM q_user";
        $qry = mysqli_query($koneksi, $sql);
        while ($r = mysqli_fetch_array($qry)) {
          echo "
                    <tr>
                        <td>{$r['kd_user']}</td>
                        <td>{$r['nama']}</td>
                        <td>{$r['no_hp']}</td>
                        <td>{$r['username']}</td>
                        <td>{$r['password']}</td>
                        <td>{$r['level']}</td>
                        <td><a href='user.php?edit&id={$r['kd_user']}' class='btn btn-warning btn-sm'>Edit</a></td>
                        <td><a href='user.php?hapus&id={$r['kd_user']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a></td>
                    </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>