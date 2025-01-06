<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
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
<!-- Lokasi Section Start -->
<section class="lokasi" id="lokasi">
    <div class="lokasi-content">
        <h2><span>Lokasi</span> Kami</h2>
        <p>Kunjungi salah satu dari beberapa lokasi kami untuk menikmati kuliner khas Sumatera Barat dengan cita rasa terbaik.</p>
        <div class="lokasi-wrapper">
            <!-- Lokasi 1 -->
            <div class="lokasi-item">
                <div class="lokasi-map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2519.9974638165487!2d100.3652166!3d-0.9460834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8c5f5042d91%3A0x96b7a60d8b25b4f3!2sPadang%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1684651123456!5m2!1sid!2sid" 
                        width="100%" 
                        height="250" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="lokasi-info">
                    <h3>Cabang Padang</h3>
                    <p>Jalan Adityawarman No. 25, Padang, Sumatera Barat</p>
                    <p><strong>Jam Operasional:</strong><br>Senin - Minggu: 10.00 - 22.00</p>
                    <a href="https://www.google.com/maps" target="_blank" class="lokasi-button">Dapatkan Petunjuk Arah</a>
                </div>
            </div>

            <!-- Lokasi 2 -->
            <div class="lokasi-item">
                <div class="lokasi-map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2519.9974638165487!2d100.3729166!3d-0.9480834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8d8b5132e21%3A0x8d60d4b3f6e5e1f3!2sBukittinggi%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1684651256789!5m2!1sid!2sid" 
                        width="100%" 
                        height="250" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="lokasi-info">
                    <h3>Cabang Bukittinggi</h3>
                    <p>Jalan Sudirman No. 12, Bukittinggi, Sumatera Barat</p>
                    <p><strong>Jam Operasional:</strong><br>Senin - Minggu: 10.00 - 21.00</p>
                    <a href="https://www.google.com/maps" target="_blank" class="lokasi-button">Dapatkan Petunjuk Arah</a>
                </div>
            </div>

            <!-- Lokasi 3 -->
            <div class="lokasi-item">
                <div class="lokasi-map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2519.9974638165487!2d100.3899166!3d-0.9530834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8e5f6f892e5%3A0x8f68d3b3a3e8e6f4!2sPayakumbuh%2C%20Sumatera%20Barat!5e0!3m2!1sid!2sid!4v1684651367890!5m2!1sid!2sid" 
                        width="100%" 
                        height="250" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="lokasi-info">
                    <h3>Cabang Payakumbuh</h3>
                    <p>Jalan Pahlawan No. 8, Payakumbuh, Sumatera Barat</p>
                    <p><strong>Jam Operasional:</strong><br>Senin - Minggu: 10.00 - 20.00</p>
                    <a href="https://www.google.com/maps" target="_blank" class="lokasi-button">Dapatkan Petunjuk Arah</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Lokasi Section End -->


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