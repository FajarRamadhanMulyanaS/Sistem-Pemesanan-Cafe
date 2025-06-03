<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:../logincos.php');
}
include '../../config/koneksi.php';

// Informasi profil user
$userProfile = isset($_SESSION['nama_user']) ? $_SESSION['nama_user'] : 'Guest';
$userPhone = isset($_SESSION['no_hp']) ? $_SESSION['no_hp'] : 'Nomor Telpon tidak tersedia';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="aset/logo/Logo Minkop.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="aset/logo/Logo Minkop.png" sizes="16x16" />
    <script>
        let selectedCategory = "all"; // Default kategori

        // Toggle navbar visibility
        function toggleNavbar() {
            const navbar = document.getElementById('navbar');
            navbar.classList.toggle('hidden');
        }

        // AJAX untuk filter menu
        function updateMenuList() {
            const searchQuery = document.getElementById('searchInput').value;
            const xhr = new XMLHttpRequest();
            xhr.open("GET", `searchmenu.php?q=${searchQuery}&kategori=${selectedCategory}`, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("menuList").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }

        // Pilih kategori
        function selectCategory(kdKategori, kategoriName) {
            selectedCategory = kdKategori;
            document.getElementById('selectedCategory').textContent = kategoriName;
            updateMenuList();

            // Tutup dropdown setelah kategori dipilih
            document.getElementById('categoryDropdown').classList.add('hidden');
        }

        let currentMenu = {};

        function showAddToCartPopup(id, name, image, price) {
            currentMenu = { id, name, price };
            document.getElementById('menuImage').src = `../../admin/image/${image}`;
            document.getElementById('menuName').textContent = name;
            document.getElementById('menuPrice').textContent = `Rp ${price.toLocaleString('id-ID')}`;
            document.getElementById('menuQuantity').value = 1;
            document.getElementById('totalPrice').textContent = `Rp ${price.toLocaleString('id-ID')}`;

            const popup = document.getElementById('addToCartPopup');
            popup.classList.remove('hidden');
            popup.classList.remove('scale-95');
            popup.classList.add('scale-100');
        }

        function closeAddToCartPopup() {
            const popup = document.getElementById('addToCartPopup');
            popup.classList.add('scale-95');
            setTimeout(() => {
                popup.classList.add('hidden');
            }, 1); // Delay sesuai durasi animasi
            resetPopupInputs(); // Reset input setelah data berhasil dikirim
        }
        function updateQuantity(amount) {
            const quantityInput = document.getElementById('menuQuantity');
            let currentQuantity = parseInt(quantityInput.value);

            // Pastikan jumlah minimal adalah 1
            currentQuantity += amount;
            if (currentQuantity < 1) {
                currentQuantity = 1;
            }

            quantityInput.value = currentQuantity;

            // Perbarui total harga berdasarkan jumlah yang diperbarui
            const totalPrice = currentMenu.price * currentQuantity;
            document.getElementById('totalPrice').textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        }


        function addToCart() {
            const quantity = document.getElementById('menuQuantity').value;
            const notes = document.getElementById('menuNotes').value;
            const totalPrice = currentMenu.price * quantity;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_to_cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                    resetPopupInputs(); // Reset input setelah data berhasil dikirim
                    closeAddToCartPopup();
                    loadCart();
                }
            };
            xhr.send(`menu_id=${currentMenu.id}&jumlah=${quantity}&catatan=${encodeURIComponent(notes)}&total_harga=${totalPrice}`);
        }

        function resetPopupInputs() {
            document.getElementById('menuNotes').value = ''; // Reset catatan
            document.getElementById('menuQuantity').value = 1; // Reset jumlah
            document.getElementById('totalPrice').textContent = `Rp ${currentMenu.price.toLocaleString('id-ID')}`; // Reset total harga
        }

        let cartItems = []; // Menyimpan data keranjang di sisi frontend

        // Memuat data keranjang dari server
        function loadCart() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_cart.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    cartItems = JSON.parse(xhr.responseText);
                    updateCartPopup();
                    updateCartCount();
                }
            };
            xhr.send();
        }

        // Menampilkan jumlah item di ikon keranjang
        function updateCartCount() {
            const count = cartItems.length;
            document.getElementById('cartCount').textContent = count;
        }

        // Menampilkan pop-up keranjang
        function showCartPopup() {
            updateCartPopup();
            document.getElementById('cartPopup').classList.remove('hidden');
        }

        // Menutup pop-up keranjang
        function closeCartPopup() {
            document.getElementById('cartPopup').classList.add('hidden');
        }
        //update catatan
        function updateCartNotes(cartId, newNote) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    loadCart();
                }
            };
            xhr.send(`id=${cartId}&catatan=${encodeURIComponent(newNote)}`);
        }
        // Fungsi untuk menambah jumlah
        function increaseQuantity(itemId) {
            const input = document.getElementById(`quantity-${itemId}`);
            input.value = parseInt(input.value) + 1;
            updateCartItem(itemId, input.value);
        }

        // Fungsi untuk mengurangi jumlah
        function decreaseQuantity(itemId) {
            const input = document.getElementById(`quantity-${itemId}`);
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
                updateCartItem(itemId, input.value);
            }
        }

        // Fungsi yang dipanggil saat jumlah berubah (sudah ada)
        function updateCartItem(itemId, value) {
            console.log(`Item ID: ${itemId}, Jumlah: ${value}`);
            // Implementasikan logika untuk memperbarui keranjang
        }

        // Memperbarui konten di dalam pop-up keranjang
        function updateCartPopup() {
            const cartContainer = document.getElementById('cartItems');
            cartContainer.innerHTML = '';

            let totalPrice = 0; // Variabel untuk menghitung subtotal

            // Menampilkan subtotal di atas daftar item
            const subtotalHTML = `
        <div class="flex justify-between items-center p-4 bg-white shadow-md rounded-lg sticky top-0 z-10 border-b">
            <span class="text-lg font-semibold text-gray-800">Subtotal</span>
            <span class="text-lg font-semibold text-indigo-600">Rp ${totalPrice.toLocaleString('id-ID')}</span>
        </div>
    `;
            cartContainer.innerHTML = subtotalHTML;

            cartItems.forEach((item, index) => {
                const itemTotal = item.harga * item.jumlah; // Menghitung harga per item
                totalPrice += itemTotal; // Menambahkan ke subtotal

                cartContainer.innerHTML += `
            <div class="flex flex-col md:flex-row items-center justify-between p-4 bg-white shadow-md rounded-lg mb-4">
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <img src="../../admin/image/${item.foto}" alt="${item.menu}" class="w-16 h-16 object-cover rounded-lg border">
                    <div class="flex flex-col">
                        <h3 class="font-semibold text-base text-gray-800">${item.menu}</h3>
                        <p class="text-sm text-gray-500">Rp ${item.harga.toLocaleString('id-ID')}</p>
                        <p class="text-xs text-gray-400 mt-1">Total: Rp ${itemTotal.toLocaleString('id-ID')}</p>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 flex flex-col items-end gap-2 w-full md:w-auto">
                    <div class="flex items-center gap-2">
                        <button class="w-8 h-8 bg-gray-100 text-gray-600 rounded-lg flex justify-center items-center hover:bg-gray-200"
                            onclick="decreaseQuantity(${item.id})">-</button>
                        <input 
                            type="number" 
                            class="border text-center w-12 h-8 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                            value="${item.jumlah}" 
                            min="1" 
                            id="quantity-${item.id}" 
                            onchange="updateCartItem(${item.id}, this.value)">
                        <button class="w-8 h-8 bg-gray-100 text-gray-600 rounded-lg flex justify-center items-center hover:bg-gray-200"
                            onclick="increaseQuantity(${item.id})">+</button>
                    </div>
                    <textarea 
                        class="border rounded-lg w-full text-sm p-2 mt-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                        placeholder="Tambahkan catatan..."
                        onchange="updateCartNotes(${item.id}, this.value)">${item.catatan}</textarea>
                    <button 
                        class="text-sm text-red-500 hover:text-red-700 focus:outline-none mt-2"
                        onclick="removeCartItem(${item.id})">Hapus</button>
                </div>
            </div>
        `;
            });

            // Perbarui subtotal (dihitung ulang setelah item ditambahkan)
            document.querySelector('.sticky .text-indigo-600').textContent = `Rp ${totalPrice.toLocaleString('id-ID')}`;
        }





        // Menghapus item dari keranjang
        function removeCartItem(cartId) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'remove_cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    loadCart();
                }
            };
            xhr.send(`id=${cartId}`);
        }

        // Memperbarui jumlah item di keranjang
        function updateCartItem(cartId, newQuantity) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_cart.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    loadCart();
                }
            };
            xhr.send(`id=${cartId}&jumlah=${newQuantity}`);
        }

        // Memuat data keranjang saat halaman dimuat
        document.addEventListener('DOMContentLoaded', loadCart);
    </script>
    <style>
        #cartItems {
            max-height: 400px;
            /* Sesuaikan dengan ukuran pop-up */
            overflow-y: auto;
            /* Membuat kontainer bisa scroll */
        }

        .sticky {
            position: sticky;
            top: 0;
            /* Tetap di atas */
            background-color: white;
            /* Pastikan latar belakang tetap putih */
            z-index: 10;
            /* Pastikan berada di atas elemen lain */
            border-bottom: 1px solid #e5e7eb;
            /* Tambahkan garis bawah untuk pemisah */
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navbar (Hidden initially) -->
    <div id="navbar" class="w-80 bg-white shadow-lg fixed top-0 left-0 h-full z-50 hidden">
        <div class="flex items-center justify-between p-4">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
                    <i class="fas fa-camera text-gray-500"></i>
                </div>
                <div>
                    <div class="text-lg font-semibold"><?php echo $userProfile; ?></div>
                    <div class="text-blue-500">
                        <?php echo $userPhone; ?> <!-- Displaying Phone Number -->
                    </div>
                </div>
            </div>
            <!-- Close Icon -->
            <i class="fas fa-times text-2xl text-gray-700 cursor-pointer" onclick="toggleNavbar()"></i>
        </div>
        <div class="bg-white shadow rounded-lg p-4 flex items-center space-x-2">
            <i class="fas fa-award text-yellow-500"></i>
            <span>Minkop Cafe </span>
        </div>
        <ul class="space-y-4 p-4">
            <li><a class="text-lg font-semibold" href="orderan_kamu.php">Orderan Kamu</a></li>
            <li><a class="text-lg font-semibold" href="riwayat_pesanan.php">Riwayat Pesanan</a></li>
            <li><a class="text-lg font-semibold" href="https://wa.me/qr/7KBXPZU57LELI1 ">Chat WhatsApp</a></li>
            <li><a class="text-lg font-semibold" href="../keluar.php">Keluar</a></li>
        </ul>
        <div class="mt-4 p-4">
            <button class="w-full flex items-center justify-between border rounded-lg p-2">
                <div class="flex items-center space-x-2">
                    <img alt="Indonesian flag" class="w-5 h-5"
                        src="https://storage.googleapis.com/a1aa/image/JBFfk2h0CPx1c69hMbUQgft6w2hnrylrfQz1s018JSU8t0hnA.jpg"
                        width="20" height="20" />
                    <span>Bahasa Indonesia</span>
                </div>
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
    </div>
    <!-- End Navbar -->

    <!-- Halaman Utama -->
    <div class="w-full mx-auto p-6 bg-white shadow-lg rounded-lg">
        <!-- Header dengan Icon Menu -->
        <div class="flex items-center justify-between mb-6">
            <!-- Icon Menu -->
            <i class="fas fa-bars text-2xl text-gray-700 cursor-pointer" onclick="toggleNavbar()"></i>
            <img src="../../aset/logo/logo minkop mini.png" alt="Logo" class="h-30 w-auto">
            <!-- Icon Keranjang -->
            <div class="relative cursor-pointer" onclick="showCartPopup()">
                <i class="fas fa-shopping-cart text-2xl text-gray-700"></i>
                <span id="cartCount"
                    class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
            </div>
        </div>

        <!-- Judul Menu -->
        <h1 class="text-3xl font-bold text-center mb-4 text-gray-800">Daftar Menu</h1>
        <h2 id="selectedCategory" class="text-xl font-semibold text-gray-700 mb-6">Semua Kategori</h2>

        <!-- Pencarian dan Filter -->
        <div class="flex items-center justify-between mb-6">
            <div class="relative w-3/4">
                <input type="text" placeholder="Cari menu..."
                    class="w-full border border-gray-300 rounded-lg py-2 px-4 pl-10 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    id="searchInput" onkeyup="updateMenuList()">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <div class="relative w-1/5">
                <button
                    class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    onclick="document.getElementById('categoryDropdown').classList.toggle('hidden')">
                    <i class="fas fa-filter"></i>
                </button>
                <!-- Dropdown Kategori -->
                <ul id="categoryDropdown"
                    class="absolute bg-white border border-gray-300 rounded-lg shadow-lg mt-2 hidden z-10">
                    <li class="p-2 hover:bg-gray-200 cursor-pointer" onclick="selectCategory('all', 'Semua Kategori')">
                        Semua Kategori</li>
                    <?php
                    $kategoriQuery = "SELECT * FROM tb_kategori";
                    $kategoriResult = mysqli_query($koneksi, $kategoriQuery);
                    while ($kategori = mysqli_fetch_array($kategoriResult)) {
                        echo '<li class="p-2 hover:bg-gray-200 cursor-pointer" onclick="selectCategory(\'' . $kategori['kd_kategori'] . '\', \'' . $kategori['kategori'] . '\')">' . $kategori['kategori'] . '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>

        <!-- Daftar Menu -->
        <div id="menuListContainer" class="w-full  h-[calc(100vh-250px)] overflow-y-auto">
            <div id="menuList" class="space-y-4">
                <?php include 'searchmenu.php'; ?>
            </div>
        </div>

    </div>
    <!-- modal pop up -->
    <div id="addToCartPopup"
        class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 transition transform scale-95 duration-300">
        <div class="bg-white p-6 rounded-lg shadow-2xl w-96">
            <!-- Header Popup -->
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h2 class="text-xl font-bold text-gray-800">Tambah ke Keranjang</h2>
                <button onclick="closeAddToCartPopup()"
                    class="text-gray-500 text-2xl hover:text-red-500">&times;</button>
            </div>
            <!-- Konten Popup -->
            <div class="flex items-center mb-4">
                <img id="menuImage" src="" alt="Menu Image" class="w-20 h-20 rounded-lg border mr-4">
                <div>
                    <h3 id="menuName" class="text-lg font-semibold text-gray-700"></h3>
                    <p id="menuPrice" class="text-gray-500 text-sm"></p>
                </div>
            </div>
            <!-- Input Catatan -->
            <textarea id="menuNotes"
                class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
                placeholder="Tambahkan catatan..."></textarea>
            <!-- Input Jumlah -->
            <div class="flex items-center justify-between mb-4">
                <button onclick="updateQuantity(-1)"
                    class="bg-gray-200 hover:bg-gray-300 p-3 rounded-full text-xl font-bold text-gray-700">-</button>
                <input type="number" id="menuQuantity" class="w-16 text-center border rounded-lg focus:outline-none"
                    value="1" min="1">
                <button onclick="updateQuantity(1)"
                    class="bg-gray-200 hover:bg-gray-300 p-3 rounded-full text-xl font-bold text-gray-700">+</button>
            </div>
            <!-- Total Harga -->
            <div class="text-right mb-4">
                <p class="text-lg font-semibold text-gray-700">Total Harga: <span id="totalPrice"></span></p>
            </div>
            <!-- Tombol Tambah ke Keranjang -->
            <button onclick="addToCart()"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-bold">Tambah ke
                Keranjang</button>
        </div>
    </div>

    <!-- pop up keranjang -->
    <div id="cartPopup" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-full w-[800px]">
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h2 class="text-xl font-bold">Keranjang</h2>
                <button onclick="closeCartPopup()" class="text-gray-500 text-2xl hover:text-red-500">&times;</button>
            </div>
            <div id="cartItems" class="space-y-4">
                <!-- Item keranjang akan dimuat di sini -->
            </div>
            <div class="text-right mt-4">
                <button class="bg-blue-500 text-white px-4 py-2 rounded-lg"
                    onclick="window.location.href='checkout.php'">Checkout</button>
            </div>
        </div>
    </div>




</body>

</html>