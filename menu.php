<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Sertakan file koneksi database
include 'koneksi.php';

// Ambil data dari tabel menu
$query = "SELECT * FROM kuliner";
$result = mysqli_query($koneksi, $query);

// Periksa jika query gagal
if (!$result) {
    die("Query gagal: " . mysqli_error($koneksi));
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
        <a href="index.php" class="navbar-logo">KulinerSum<span>Bar</span>.</a>
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

    <!-- Menu Section Start -->
    <section class="menu" id="menu">
        <h2><span>Menu</span> Kami</h2>
        <p>Temukan berbagai pilihan hidangan lezat dan minuman segar khas kami.</p>
        <div class="menu-container">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="menu-item">
                    <img src="uploads/<?php echo htmlspecialchars($row['foto']); ?>" alt="<?php echo htmlspecialchars($row['nama']); ?>" class="menu-image">
                    <h3><?php echo htmlspecialchars($row['nama']); ?></h3>
                    <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- Menu Section End -->

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

    <script>
    feather.replace();
    </script>

</body>
</html>
