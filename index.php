<?php
session_start(); // Memulai session untuk mengakses session variables

// Cek apakah ada session yang aktif, misalnya mengecek apakah pengguna sudah login
$is_logged_in = isset($_SESSION['username']); // Menyimpan status login dalam variabel $is_logged_in
?>

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

<!-- Feather Icons JS-->
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<!-- Feather Icons CSS-->
<link href="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.css" rel="stylesheet">

<!-- My Style CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar">
        <a href="#" class="navbar-logo">
        <img src="logo-rumah.png" alt="logo rumah" class="logo">
         Bundo<span>Kanduang</span>.
        </a>
    
        <div class="navbar-nav">
            <a href="#home">Home</a>
            <a href="about.php">Tentang Kami</a>
            <a href="menu.php">Menu</a>
            <a href="resep.php">Resep</a>
            <a href="lokasi.php">Lokasi</a>
            <a href="kontak.php">Kontak</a>
           <!-- Tampilkan Logout jika pengguna sudah login -->
           <?php if ($is_logged_in): ?>
                <a href="logout.php" class="logout-button"><i data-feather="log-out"></i></a>
            <?php else: ?>
                <!-- Tampilkan Login jika pengguna belum login -->
                <a class="login" href="login.php">Login</a>
            <?php endif; ?>
        </div>


        <div class="navbar-extra">
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Section start -->
     <section class="hero" id="home">
        <main class="content">
            <h1>Kuliner Asli dari <span>Sumbar...</span></h1>
            <p>Makanan khas Sumatera Barat yang terbuat dari daging 
                dan rempah-rempah yang dimasak dengan santan.</p>
        </main>
     </section>
    <!-- Hero Section end -->

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