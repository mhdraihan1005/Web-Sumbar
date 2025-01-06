

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

    <!-- Kontak Section start -->
    <section id="contact" class="contact">
        <h2><span>Kontak</span> Kami</h2>
        <p>Silahkan Tinggalkan Pesan Anda pada kolom yang tersedia.</p>

        <div class="row">
        <form action="kirim_pesan.php" method="POST">
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="text" name="nama" placeholder="nama">
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="email" name="email" placeholder="email">
                </div>
                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="tel" name="no_hp" placeholder="no hp">
                </div>
                <div class="input-group">
                    <i data-feather="message-square"></i>
                    <textarea name="pesan" rows="5" placeholder="Tuliskan Pesan Anda"></textarea>
                </div>
                <button type="submit" class="btn">Kirim Pesan</button>
            </form>
        </div>
     </section>
    <!-- Kontak Section end -->

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
