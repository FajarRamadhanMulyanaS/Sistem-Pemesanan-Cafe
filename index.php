<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Minkop Cofe Shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap&subset=latin-ext" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet" />
  <!-- Place favicon.ico in the root directory -->
  <link rel="icon" type="image/png" href="aset/logo/Logo Minkop.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="aset/logo/Logo Minkop.png" sizes="16x16" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/owl.carousel.min.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/animate.css" />
  <link rel="stylesheet" href="css/responsive.css" />
  <script src="js/vendor/modernizr-2.8.3.min.js"></script>
  <style>
    body {
      background-color: black;
      /* Mengubah warna background halaman menjadi hitam */
      color: white;
      /* Mengubah warna teks menjadi putih agar kontras */
    }

    .move-up {
      position: relative;
      width: 38px !important;
      height: 38px !important;
      top: 7px;
      left: 32px;
      /* Sesuaikan nilai ini untuk menggeser lebih ke atas */
    }

    /* Gaya untuk tombol default */
    .default-btn {
      background-color: #333333;
      /* Warna tombol oranye */
      color: white;
      /* Warna teks putih */
      padding: 10px 20px;
      /* Padding dalam tombol */
      text-align: center;
      /* Posisikan teks di tengah */
      text-decoration: none;
      /* Hilangkan garis bawah */
      display: inline-block;
      /* Tampilan inline */
      font-size: 16px;
      /* Ukuran font */
      font-weight: bold;
      /* Tebal teks */
      border-radius: 5px;
      /* Membuat sudut membulat */
      transition: background-color 0.3s;
      /* Efek transisi untuk hover */
    }

    /* Efek hover untuk tombol */
    .default-btn:hover {
      background-color: #333333;
      /* Warna saat tombol di-hover */
    }

    /* Menyusun dan memusatkan konten di tengah */
    .centered-content {
      position: relative;
      /* Mengatur posisi relatif agar berada di atas video */
      z-index: 1;
      /* Memastikan konten berada di atas video */
      text-align: center;
      /* Memusatkan teks di tengah */
      color: white;
      /* Mengubah warna teks menjadi putih */
      display: flex;
      /* Menggunakan Flexbox untuk pemusatan */
      flex-direction: column;
      /* Menyusun elemen secara vertikal */
      align-items: center;
      /* Memusatkan elemen secara horizontal */
      justify-content: center;
      /* Memusatkan elemen secara vertikal */
      height: 100vh;
      /* Mengatur tinggi konten sesuai tinggi viewport */
      margin-top: -89px;
    }

    /* Mengatur ukuran dan jarak gambar dengan class "classic" di dalam konten */
    .centered-content img.classic {
      width: 70px;
      /* Ukuran gambar sedikit lebih besar */
      margin-bottom: 25px;
      /* Jarak bawah gambar */
    }

    /* Mengatur ukuran teks untuk judul dan deskripsi */
    .centered-content h3 {
      font-size: 28px;
      /* Ukuran teks untuk subjudul */
      margin: 15px 0;
      /* Jarak atas dan bawah */
    }

    .centered-content h2 {
      font-size: 36px;
      /* Ukuran teks untuk judul utama */
      margin: 15px 0;
      /* Jarak atas dan bawah */
    }

    .centered-content p {
      font-size: 18px;
      /* Ukuran teks deskripsi */
      margin: 15px 0;
      /* Jarak atas dan bawah */
    }

    /* Gaya tombol default */
    .default-btn {
      background-color: #333333;
      /* Warna latar tombol */
      color: white;
      /* Warna teks */
      padding: 15px 25px;
      /* Jarak dalam tombol lebih besar */
      text-decoration: none;
      /* Menghilangkan garis bawah */
      border-radius: 5px;
      /* Membuat sudut tombol melengkung */
      font-size: 18px;
      /* Ukuran font tombol lebih besar */
      font-weight: bold;
      /* Membuat teks tebal */
      transition: background-color 0.3s;
      /* Efek transisi saat tombol di-hover */
    }

    /* Efek hover untuk tombol */
    .default-btn:hover {
      background-color: #555555;
      /* Warna latar saat di-hover */
    }

    .stroke {
      color: white;
      /* Warna teks utama */
      text-shadow: 2px 2px 3px black;
    }
  </style>
</head>

<body>
  <!--[if lt IE 8]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="http://browsehappy.com/">upgrade your browser</a> to improve
        your experience.
      </p>
    <![endif]-->

  <!-- Header Area Start -->
  <header class="top">
    <div class="fixedArea">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 noPadding">
          <div class="content-wrapper one">
            <!-- Main Menu Start -->
            <!-- Navbar-->
            <header class="header">
              <nav class="navbar navbar-default myNavBar">
                <div class="container">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <div class="row">
                      <div class="col-md-9 col-sm-9 col-xs-9">
                        <div class="row">
                          <div class="col-md-3 col-xs-3 col-sm-3">
                            <a style="padding-top: 0px"
                              class="navbar-brand navBrandText text-uppercase font-weight-bold"
                              href="admin/index.php"><img src="aset/logo/logo minkop mini.png" alt="restorant"
                                class="move-up" /></a>
                          </div>
                          <div class="col-md-9 col-sm-9 col-xs-9">
                            <a href="admin/index.php"><img class="img-responsive logo"
                                src="aset/logo/Desain_tanpa_judul__5_-removebg-preview.png" alt="restorant"
                                alt="Resized Image" style="
                                    position: relative;
                                    width: 188px !important;
                                    height: 43px !important;
                                    top: -4px;
                                    left: -10px;
                                  " /></a>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-3">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                          data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                        </button>
                      </div>
                    </div>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right navBar">
                      <li class="nav-item">
                        <a href="#section0" class="nav-link text-uppercase font-weight-bold js-scroll-trigger">Home
                          <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="nav-item">
                        <a href="#section1"
                          class="nav-link text-uppercase font-weight-bold js-scroll-trigger">Offers</a>
                      </li>
                      <li class="nav-item">
                        <a href="#section2" class="nav-link text-uppercase font-weight-bold js-scroll-trigger">About</a>
                      </li>
                      <li class="nav-item">
                        <a href="#section6"
                          class="nav-link text-uppercase font-weight-bold js-scroll-trigger">Contact</a>
                      </li>
                      <li class="nav-item">
                        <a href="#section7"
                          class="nav-link text-uppercase font-weight-bold js-scroll-trigger">Address</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>
            </header>
            <!-- Main Menu End -->
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Header Area End -->
  <!-- Section0 Area Start -->
  <section id="section0" class="slider-area" style="position: relative; overflow: hidden">
    <!-- Video Background -->
    <video autoplay muted loop playsinline style="
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          object-fit: cover;
          z-index: -1;
        ">
      <source src="aset/ssstik.io_@dokumen_perjalanan_1729866815590.mp4" type="video/mp4" />
      Your browser does not support the video tag.
    </video>



    <!-- Konten yang dipusatkan di tengah slide -->
    <div class="centered-content">
      <!-- Logo Minkop -->
      <img class="classic" src="aset/logo/Logo Minkop.png" alt="Minkop Logo" />

      <!-- Judul dan subjudul -->
      <h3 class="stroke">Minkop Space Coffee Shop</h3>
      <h2 class="stroke">A Taste Of The Good Life</h2>

      <!-- Paragraf deskripsi -->
      <p class="stroke">
        The best taste and a new experience that has never been experienced before
      </p>

      <!-- Tombol untuk memesan -->
      <a class="default-btn" href="costumer/logincos.php">PESAN SEKARANG</a>

      <!-- Ikon tambahan -->
      <img class="classic" src="aset/new/icon.png" alt="Icon" style="margin-top: 20px" />
    </div>
    </div>
    </div>
  </section>
  <!-- Section0 Area End -->
  <!-- Section1 Start -->
  <section id="section1" class="topOff">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="panel panel-default">
            <div class="panel-body colorfullPanel text-center">
              <h3>Suasana Baru</h3>
              <h2>
                <span>Music</span> Live
                <img class="classic" src="aset/new/icon.png" />
              </h2>
              <p>
                Cofe Shop and space yang menyediakan music live setiap malam minggu
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="panel panel-default colorfullParent">
            <div class="panel-body colorfullPanel text-center">
              <h3>Rasa Baru</h3>
              <h2>
                <span>Update</span> Menu
                <img class="classic" src="aset/new/icon.png" />
              </h2>
              <p>
                penawaran Rasa baru dan menu yang selalu update mengikuti perkembangan zaman
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="panel panel-default">
            <div class="panel-body colorfullPanel text-center">
              <h3>Pengalaman Baru</h3>
              <h2>
                <span>Event</span> Menarik
                <img class="classic" src="aset/new/icon.png" />
              </h2>
              <p>
                bermacam macam event dan acara yang menarik selalu menanti anda
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section1 End -->
  <!-- Section2 Start -->
  <section id="section2">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="maintext text-center">
            <span>TENTANG MINKOP CAFE</span>
            <h2 style="color: white">Selamat Datang Penikmat Kopi</h2>
            <p>
              Minkop - Tempat ngopi nyaman di Subang dengan aroma kopi terbaik, suasana hangat, dan layanan ramah.<br>
              Cocok
              untuk bersantai atau bekerja sambil menikmati cita rasa kopi berkualitas. Temukan momen terbaikmu bersama
              Minkop!
            </p>
          </div>
        </div>
      </div>
      <div class="row shapes">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="row">
            <div class="col-md-12 minHeightProp">
              <img class="imgback" src="aset/shape/shape1.png" />
            </div>
            <div class="col-md-12">
              <div class="text-center">
                <span style="color:white;">Pemesanan cepat dan mudah</span>
                <p>
                  Minkop menawarkan kemudahan dalam pemesanan, sehingga Anda bisa langsung menikmati kopi favorit tanpa
                  perlu menunggu lama.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="row">
            <div class="col-md-12 minHeightProp">
              <img class="imgback" src="aset/shape/shape2.png" />
            </div>
            <div class="col-md-12">
              <div class="text-center">
                <span style="color:white;">Harga terjangkau,transaksi aman</span>
                <p>
                  Dengan harga yang bersahabat, Minkop memastikan setiap transaksi dilakukan dengan transparansi dan
                  kepercayaan, memberikan nilai lebih bagi setiap pelanggan.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
          <div class="row">
            <div class="col-md-12 minHeightProp">
              <img class="imgback" src="aset/shape/shape3.png" />
            </div>
            <div class="col-md-12">
              <div class="text-center">
                <span style="color:white;">Kualitas terbaik setara berlian</span>
                <p>
                  Produk kami dipilih dan disajikan dengan standar tertinggi, menjamin kualitas terbaik yang bisa
                  dinikmati seperti sebuah berlian yang berharga.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Section2 End -->
  <!-- Banner Start -->

  <!-- Testimonial Area End -->

  <!-- Contact Start -->
  <section id="section6" class="contact">
    <div class="contact100-form-title container">
      <h3>Hubungi Kami</h3>
      <h2>Kirim Pesan Disini</h2>
      <form class="contact100-form validate-form">
        <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Name is required">
          <span class="label-input100">Nama Lengkap</span>
          <input class="input100" type="text" name="name" placeholder="Enter your name" />
          <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 rs1-wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
          <span class="label-input100">Alamat Email</span>
          <input class="input100" type="text" name="email" placeholder="Enter your email addess" />
          <span class="focus-input100"></span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="Message is required">
          <span class="label-input100">Pesan</span>
          <textarea class="input100" name="message" placeholder="Your message here..."></textarea>
          <span class="focus-input100"></span>
        </div>

        <div class="container-contact100-form-btn">
          <button class="contact100-form-btn">
            <span>
              Kirim
              <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
            </span>
          </button>
        </div>

        <div class="container-contact100-form-btn response" style="margin-top: 30px">
          <p class="error"></p>
        </div>
      </form>
    </div>
  </section>
  <!-- Contact End -->
  <!-- Address Section Start -->
  <section id="section7" class="row address parallax-window" data-parallax="scroll"
    data-image-src="aset/background/slidecafe.jpg">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-5 col-md-offset-1 addess-description">
          <span>Lokasi Minkop Cafe</span>
          <h2>Minkop Addres</h2>
          <p>
            Jika ada Informasi Seputar Minkop Cafe & Space Silahkan Untuk Hubungi Nomer dan Email di Bawah Ini
          </p>
          <ul>
            <li class="address-section">
              <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <i class="fa fa-address-card"></i>
                </div>
                <div class="col-md-10 col-sm-10 col-xs-10 lineHeight">
                  Minkop Cafe & Space<br />Jl. Otto Iskandardinata Subang
                </div>
              </div>
            </li>
            <li class="address-section">
              <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <i class="fa fa-phone"></i>
                </div>
                <div class="col-md-10 col-sm-10 col-xs-10 lineHeight">
                  Nomer Telepon Minkop<br />+62 851-7320-2332
                </div>
              </div>
            </li>
            <li class="address-section">
              <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-2">
                  <i class="fa fa-envelope"></i>
                </div>
                <div class="col-md-10 col-sm-10 col-xs-10 lineHeight">
                  Email Minkop<br />MinkopSubang@Gmail.com
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-md-6 addess-map">
          <!-- Div untuk peta -->
          <div id="map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.7144782092428!2d107.76999357410122!3d-6.55768206410387!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e693b02b0cbcd8d%3A0x2daf37ee478899f8!2sMinKop%20%26%20Space!5e0!3m2!1sid!2sid!4v1732159459694!5m2!1sid!2sid"
              width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Adress Section End -->
  <!-- Footer Start -->
  <footer class="footer-area">
    <div class="container main-footer">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="single-widget pr-60">
            <div class="footer-logo pb-25">
              <div class="col-md-4 noPadding text-center">
                <p class="colorfullText">-Minkop-</p>
              </div>
              <div class="col-md-8 noPadding logo-text">


              </div>
            </div>
            <p>
              I must explain to you how all this mistaken idea of denoung
              pleure and praising pain was born and give you a coete account
              of the system.
            </p>
            <div class="footer-social">
              <ul class="list-group">
                <li>
                  <a href=""><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                  <a href=""><i class="fa fa-pinterest"></i></a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-vimeo"></i></a>
                </li>
                <li>
                  <a href=""><i class="fa fa-twitter"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-bottom text-center">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <p>
                  Copyright ©
                  <a href="https://www.instagram.com/faanzah_/profilecard/?igsh=MW4xNjg2MHdlOTZvdw=="
                    target="_blank">Fajarree</a>
                  2020. All Right Reserved By fajarree.
                </p>
              </div>
            </div>
          </div>
        </div>
  </footer>
  <!-- Footer End -->
  <script src="js/vendor/jquery-1.12.0.min.js"></script>
  <script src="js/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/parallax.min.js"></script>
  <script src="js/ajax-mail.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.nicescroll.min.js"></script>
  <script src="js/main.js"></script>

</body>

</html>