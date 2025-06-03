<?php
session_start();
include "../config/koneksi.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/daftar.css"> <!-- Menghubungkan file CSS terpisah -->
    <link rel="icon" type="image/png" href="../aset/logo/Logo Minkop.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../aset/logo/Logo Minkop.png" sizes="16x16" />
</head>

<body>

    <?php
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // Query untuk memeriksa login dengan nama kolom yang dimulai dengan huruf kapital
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$username' AND Password='$password'");

        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_array($query);

            // Menyimpan nama pengguna ke session
            $_SESSION['user'] = $data;  // Simpan seluruh data pengguna ke session
            $_SESSION['nama_user'] = $data['Nama']; // Simpan nama pengguna ke session
            $_SESSION['no_hp'] = $data['No_Hp']; //simpan no hp
            $_SESSION['id_user'] = $data['id_user']; // Set session saat login

    
            // Redirect dengan pesan selamat datang
            echo '<script>alert("Selamat Datang, ' . $data['Nama'] . '"); location.href="menu/daftarmenu.php";</script>';
        } else {
            echo '<script>alert("Username/Password Tidak Sesuai, pilih Daftar jika belum mempunyai akun");</script>';
        }
    }
    ?>

    <!-- Latar belakang -->
    <div class="background-container"></div>

    <div class="container d-flex justify-content-center justify-content-lg-flex">
        <div class="register-container">
            <img src="../aset/logo/Logo Minkop.png" alt="Logo">
            <h3 style="color: #1C100B;">Login Costumer</h3>
            <form method="post">
                <div class="form-group mb-3">
                    <i class="fas fa-user-circle"></i>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group mb-4">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <p class="link-login">Belum punya akun? <a href="registercos.php">Daftar</a></p>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>