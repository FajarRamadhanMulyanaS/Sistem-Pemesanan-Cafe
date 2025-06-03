<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
	<nav>
		<img src="../aset/logo/Logo Minkop.png" alt="Cafe Logo">
		<a href="dashboard.php" class="active">Dashboard</a>
		<a href="menu.php">Menu</a>
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

	<div class="container">
		<h1>Selamat Datang di Dashboard</h1>
		<div class="row mt-5 g-4">
			<div class="col-md-3">
				<div class="card p-4 text-center">
					<h5 class="card-title">Kelola Menu</h5>
					<p class="card-text">Lihat dan kelola menu yang tersedia di kafe Anda.</p>
					<a href="menu.php" class="btn btn-outline-dark">Lihat Menu</a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card p-4 text-center">
					<h5 class="card-title">Laporan</h5>
					<p class="card-text">Cek laporan penjualan dan performa bisnis Anda.</p>
					<a href="laporan.php" class="btn btn-outline-dark">Lihat Laporan</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>