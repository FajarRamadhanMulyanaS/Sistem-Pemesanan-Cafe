<?php
session_start();

$koneksi = mysqli_connect("localhost","root","","cafebase");
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE username ='$username' and password ='$password'");
    $cek = mysqli_num_rows($sql);
    if ($cek > 0){
        $data  = mysqli_fetch_assoc($sql);
        if ($data['level']=="admin") {
            $_SESSION['username']=$username;
            $_SESSION['level']="admin";
            echo "<script>alert('Selamat Datang $username');document.location.href='dashboard.php'</script>";
        } elseif ($data['level'] == 'Owner') {
            $_SESSION['username']=$username;
            $_SESSION['level']="Owner";
            echo "<script>alert('Selamat Datang $username,Boss Muda');document.location.href='Laporan.php'</script>";
        }elseif ($data['level'] == 'Dapur') {
            $_SESSION['username']=$username;
            $_SESSION['level']="Dapur";
            echo "<script>alert('Selamat Datang $username,Chief');document.location.href='admin_pesanan.php'</script>";
        }
    } else {
        echo "<script>alert('Maaf Username/Password Anda Salah');document.location.href='index.php'</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/loginpeg.css"> <!-- Menghubungkan file CSS terpisah -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            
        }


        h1 {
            text-align: center;
            font-size: 24px;
            color: white;
            margin-bottom: 30px;
        }
        .box {
            width: 350px;
            height: 500px;
            background-color: rgba(113, 113, 113, 0.866);
            color: #333;
            border-radius: 20px;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid white;
            background: transparent;
            padding-left: 35px;
            font-size: 16px;
        }

        .form-control:focus {
            outline: none;
            border-color: #48c6ef;
        }

        .fa-user, .fa-lock {
            position: absolute;
            top: 10px;
            left: 10px;
            color: white;
        }

        .fa-user {
            top: 15px;
        }

        .fa-lock {
            top: 12px;
        }

        .box input[type="submit"] {
            width: 100%;
            height: 45px;
            background-color: white;
            color: #343739;
            font-size: 18px;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .box input[type="submit"]:hover {
            background-color: #343739 ;
            color : white;
        }

        .link-login {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .link-login a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .link-login a:hover {
            text-decoration: underline;
        }

        /* Menambahkan gaya untuk logo */
        .logo {
            display: block;
            margin: 0 auto 30px auto;
            width: 80px; /* Ganti dengan ukuran logo Anda */
            height: 80px;
        }
    </style>
</head>
<body>
<div class="background-container"></div>

<div class="box">
    <!-- Menambahkan logo di atas form login -->
    <img src="../aset/logo/Logo Minkop.png" alt="Logo" class="logo"> <!-- Ganti dengan path logo Anda -->

    <h1 style="font-weight: bold;">Login Pegawai</h1>
    <form method="post">
        <div class="form-group">
            <i style="color: white;" class="fas fa-user"></i>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group">
            <i style="color : white;"class="fas fa-lock"></i>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <input type="submit" name="login" value="Login">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
