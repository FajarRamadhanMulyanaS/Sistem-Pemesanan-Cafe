<?php
include_once '../../config/koneksi.php';

$q = isset($_GET['q']) ? $_GET['q'] : '';
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : 'all';

if ($kategori === 'all') {
    $kategoriQuery = "SELECT * FROM tb_kategori";
} else {
    $kategoriQuery = "SELECT * FROM tb_kategori WHERE kd_kategori = '$kategori'";
}
$kategoriResult = mysqli_query($koneksi, $kategoriQuery);

while ($kategori = mysqli_fetch_array($kategoriResult)) {
    // Query menu berdasarkan kategori dan pencarian
    $menuQuery = "SELECT * FROM tb_menu WHERE kd_kategori = '" . $kategori['kd_kategori'] . "'";
    if (!empty($q)) {
        $menuQuery .= " AND menu LIKE '%$q%'";
    }
    $menuResult = mysqli_query($koneksi, $menuQuery);

    // Hanya tampilkan kategori jika ada menu yang sesuai
    if (mysqli_num_rows($menuResult) > 0) {
        echo '<h3 class="text-lg font-bold text-gray-800 mb-2">' . $kategori['kategori'] . '</h3>';

        while ($row = mysqli_fetch_array($menuResult)) {
            $statusText = $row['status'] === 'Habis' ? '<span class="text-red-500 font-bold">Habis</span>' : '';
            echo '
    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg shadow-md 
         ' . ($row['status'] === 'Habis' ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer hover:bg-gray-100 transition-all duration-300') . '"
         ' . ($row['status'] !== 'Habis' ? 'onclick="showAddToCartPopup(' . $row['kd_menu'] . ', \'' . $row['menu'] . '\', \'' . $row['foto'] . '\', ' . $row['harga'] . ')"' : '') . '>
        <div class="flex items-center space-x-4">
            <img src="../../admin/image/' . $row['foto'] . '" alt="' . $row['menu'] . '" class="w-16 h-16 rounded-lg object-cover sm:w-20 sm:h-20 md:w-24 md:h-24 lg:w-28 lg:h-28">
            <div class="flex flex-col sm:flex-row sm:space-x-4">
                <span class="block font-semibold text-lg text-gray-700 truncate max-w-[130px] sm:max-w-[140px] md:max-w-[350px] lg:max-w-[400px]">' . $row['menu'] . '</span>
                ' . ($row['status'] === 'Habis' ? '<span class="text-red-500 text-sm font-medium">(Habis)</span>' : $statusText) . '
            </div>
        </div>
        <div class="mt-2 sm:mt-0">
            <span class="text-gray-700 font-bold text-sm sm:text-base lg:text-lg">Rp ' . number_format($row['harga'], 0, ',', '.') . '</span>
        </div>
    </div>
';



        }

    }
}
?>