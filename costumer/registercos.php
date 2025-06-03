<?php
session_start();
include "../config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/daftar.css"> <!-- Menghubungkan file CSS terpisah -->
    <link rel="icon" type="image/png" href="../aset/logo/Logo Minkop.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../aset/logo/Logo Minkop.png" sizes="16x16" />
</head>
<body>

<?php
if(isset($_POST['username'])){
    $nama = $_POST['nama'];
    $nomer = $_POST['nomer'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']); // Menambahkan variabel untuk konfirmasi password

    // Mengecek apakah password dan konfirmasi password cocok
    if ($password == $confirm_password) {
        $query = mysqli_query($koneksi, "INSERT INTO user (Nama,No_Hp,Username,Password) VALUES('$nama','$nomer','$username','$password')");
        if($query){
            echo '<script>alert("Selamat, Pendaftaran anda berhasil, Silahkan Login");</script>';
        } else {
            echo '<script>alert("Pendaftaran gagal");</script>';
        }
    } else {
        echo '<script>alert("Password dan Konfirmasi Password tidak cocok!");</script>';
    }
}
?>

<!-- Latar belakang -->
<div class="background-container"></div>

<div class="container d-flex justify-content-center justify-content-lg-flex">
    <div class="register-container">
        <img src="../aset/logo/Logo Minkop.png" alt="Logo">
        <h3 style="color: #1C100B;">Pendaftaran Users</h3>
        <form method="post">
            <div class="form-group mb-3">
                <i class="fas fa-user"></i>
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group mb-3">
                <i class="fas fa-phone"></i>
                <input type="number" name="nomer" class="form-control" placeholder="Nomer Telpon" maxlength="15" oninput="limitInputLength(this, 15)" required>
            </div>
            <div class="form-group mb-3">
                <i class="fas fa-user-circle"></i>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group mb-4">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <!-- Input Konfirmasi Password -->
            <div class="form-group mb-4">
                <i class="fas fa-lock"></i>
                <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
            <p class="link-login">Sudah punya akun? <a href="logincos.php">Login</a></p>
        </form>
    </div>
</div>

<script>
function limitInputLength(element, maxLength) {
    if (element.value.length > maxLength) {
        element.value = element.value.slice(0, maxLength);
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
