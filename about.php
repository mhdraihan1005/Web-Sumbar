<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuliner Sumatera Barat</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- My Style CSS -->
    <link rel="stylesheet" href="style.css">

<!-- My Javascript -->
<script src="script.js"></script>

</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar">
        <a href="#" class="navbar-logo">
        <img src="logo-rumah.png" alt="logo rumah" class="logo">
         KulinerSum<span>Bar</span>.
        </a>
    
        <div class="navbar-nav">
            <a href="index.php">Home</a>
            <a href="about.php">Tentang Kami</a>
            <a href="menu.php">Menu</a>
            <a href="resep.php">Resep</a>
            <a href="lokasi.php">Lokasi</a>
            <a href="kontak.php">Kontak</a>
        </div>

        <div class="navbar-extra">
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- About Section start -->
    <section id="about" class="about">
        <h2><span>Tentang</span> Kami</h2>

        <div class="row">
            <div class="about-img">
                <img src="tentang-kami.jpg" alt="Tentang Kami">
            </div>
            <div class="content">
                <h3>Situs ini <span>?</span></h3>
                <p>Situs ini adalah Situs Kuliner yang menyajikan makanan Khas Sumatera Barat. </p>
                <p>Disini Anda akan menemukan banyak menu-menu makanan khas dari Sumatera Barat mulai dari Makanan
                    khas nya, Makanan Klasik nya, dan Minuman Khas nya.</p>
                <p>Anda juga bisa menemukan beberapa daftar tempat makanan yang ada di Sumatera Barat,
                    dimana Anda bisa melihat apa yang dikatakan orang-orang tentang makanan yang tersedia di dalam
                    Situs Kami.</p>
            </div>
        </div>
     </section>
    <!-- About Section end -->

    <!-- Tombol dengan ikon kembali ke halaman utama -->
    <a href="index.php" class="back-to-home">
        <i class="fa fa-home"></i> Back to Home
    </a>

    <!-- Footer start -->
    <footer>
        <div class="socials">
            <a href="#"><i data-feather="instagram"></i></a>
            <a href="#"><i data-feather="twitter"></i></a>
            <a href="#"><i data-feather="facebook"></i></a>
        </div>

        <div class="links">
            <a href="index.php">Home</a>
            <a href="about.php">Tentang Kami</a>
            <a href="menu.php">Menu</a>
            <a href="resep.php">Resep</a>
            <a href="lokasi.php">Lokasi</a>
            <a href="kontak.php">Kontak</a>
        </div>

        <div class="credit">
            <p>Created by <a href="">kelompok4</a>. | &copy; 2024.</p>
        </div>
     </footer>
    <!-- Footer end -->

    <!-- Feather Icons -->
    <script>
        feather.replace();
      </script>

    <!-- My Javascript -->
     <script src="script.js"></script>


</body>
</html>

