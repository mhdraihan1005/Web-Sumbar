<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Sertakan file koneksi database
include 'koneksi.php';

// Query untuk mengambil Top Resep berdasarkan rata-rata rating tertinggi
$query = "SELECT recipe_type, AVG(rating) as avg_rating 
          FROM reviews 
          GROUP BY recipe_type 
          ORDER BY avg_rating DESC 
          LIMIT 5";
$result = mysqli_query($koneksi, $query);
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

  <!-- Top Resep Section Start -->
<section id="top-resep" class="top-resep">
    <h2><span>Top</span> Resep</h2>
    <p>Resep-resep favorit dengan rating tertinggi dari pengunjung kami.</p>
    <div class="top-resep-container">
            <?php
            // Query untuk mendapatkan data resep dengan rating tertinggi
                $query = "SELECT recipe_type, AVG(rating) AS avg_rating 
                        FROM reviews 
                        GROUP BY recipe_type 
                        ORDER BY avg_rating DESC 
                        LIMIT 4";
                $result = mysqli_query($koneksi, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Mengganti spasi pada nama resep dengan strip untuk penamaan gambar
                        $image_name = strtolower(str_replace(' ', '-', $row['recipe_type']));
                        $image_path = "images/$image_name.jpg";
                        
                        // Periksa apakah gambar ada, jika tidak gunakan gambar default
                        if (!file_exists($image_path)) {
                            $image_path = "images/default.jpg";
                        }

                        // Menampilkan informasi resep dengan rating
                        echo '<div class="resep-card">';
                        echo '<img src="' . $image_path . '" alt="' . htmlspecialchars($row['recipe_type']) . '" class="resep-img">';
                        echo '<div class="resep-info">';
                        echo '<h3>' . htmlspecialchars($row['recipe_type']) . '</h3>';
                        echo '<p>Rating: <strong>' . number_format($row['avg_rating'], 1) . ' / 5</strong></p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="no-data">Belum ada data rating resep.</p>';
                }
            ?>
        </div>
    </section>
<!-- Top Resep Section End -->

    <!-- Resep Section start -->
<section id="resep" class="resep">
    <h2><span>Resep</span> Kami</h2>
    <p>Temukan resep-resep lezat khas Sumatera Barat yang dapat Anda coba di rumah.</p>

    <div class="row">
        <!-- Resep Dendeng Balado -->
        <div class="resep-card">
            <img src="dendeng.jpg" alt="Dendeng Balado" class="resep-card-img">
            <h3 class="resep-card-title">Dendeng Balado</h3>
            <p class="resep-card-desc">Makanan khas daging sapi yang digoreng kering dan disajikan dengan sambal balado yang pedas.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-dendeng')">Bahan-Bahan</button>
                <button onclick="openModal('cara-dendeng')">Cara Menghidangkan</button>
            </div>

                    <!-- Rating dan Ulasan Bagian -->
        <section id="rating-ulasan-dendeng" class="rating-section">
            <form id="rating-form-dendeng" action="submit_review.php" method="POST">
            <input type="hidden" name="recipe_type" value="Dendeng Balado">
                <div class="rating-container">
                    <input type="radio" id="star-5-dendeng" name="rating" value="5">
                    <label for="star-5-dendeng" class="star">&#9733;</label>

                    <input type="radio" id="star-4-dendeng" name="rating" value="4">
                    <label for="star-4-dendeng" class="star">&#9733;</label>

                    <input type="radio" id="star-3-dendeng" name="rating" value="3">
                    <label for="star-3-dendeng" class="star">&#9733;</label>

                    <input type="radio" id="star-2-dendeng" name="rating" value="2">
                    <label for="star-2-dendeng" class="star">&#9733;</label>

                    <input type="radio" id="star-1-dendeng" name="rating" value="1">
                    <label for="star-1-dendeng" class="star">&#9733;</label>
                </div>

                <textarea id="review-dendeng" name="review" placeholder="Tulis ulasan Anda..." required></textarea>
                
                <input type="hidden" name="foto" value="upld/dendeng.jpg">
                <button type="submit"><strong>Kirim</strong></button>
            </form>

            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback-dendeng" class="feedback"></div>
        </section>
    </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Dendeng Balado -->
        <div id="bahan-dendeng" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-dendeng')">&times;</span>
                <h2>Bahan-Bahan Dendeng Balado</h2>
                <p>- 750 gr daging sapi (sengkel, has)</p>
                <p>- 7 siung bawang putih, haluskan</p>
                <p>- Garam dan merica secukupnya</p>
                <p>- Air jeruk nipis</p>
                <p>- Air secukupnya untuk merebus daging</p>
                <p>- Bahan untuk sambal, tumbuk kasar:</p>
                <p>- 300 gr cabe campur (cabe besar, keriting, rawit)</p>
                <p>- 200 gr bawang merah</p>
            </div>
        </div>

        <div id="cara-dendeng" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-dendeng')">&times;</span>
                <h2>Cara Menghidangkan Dendeng Balado</h2>
                <p>1. Potong daging tebal kira-kira 1cm, bumbui dengan bawang putih, garam, dan merica. Diamkan 15 menit.</p>
                <p>2. Pindahkan daging ke wajan, beri air secukupnya, masak sampai air habis dan daging empuk.</p>
                <p>3. Goreng daging dengan minyak panas sebentar saja, tidak perlu sampai kering. Angkat dan tiriskan.</p>
                <p>4. Tumbuk kasar cabe dan bawang. Bisa direbus sebentar agar lebih mudah ditumbuk.</p>
                <p>5. Tumis cabe dan bawang dengan minyak sisa menggoreng daging. Tambahkan air jeruk nipis, garam, dan sedikit gula. Masak hingga bau langu hilang.</p>
                <p>6. Campur daging dengan sambal balado.</p>
                <p>7. Dendeng siap disajikan.</p>
            </div>
        </div>

        <!-- Resep Sate Padang -->
        <div class="resep-card">
            <img src="sate-padang.jpg" alt="Sate Padang" class="resep-card-img">
            <h3 class="resep-card-title">Sate Padang</h3>
            <p class="resep-card-desc">Sate daging yang dipotong dadu kecil dengan kuah kuah kuning pedas diatasnya.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-sate-padang')">Bahan-Bahan</button>
                <button onclick="openModal('cara-sate-padang')">Cara Menghidangkan</button>
            </div>

                <!-- Rating dan Ulasan Bagian -->
        <section id="rating-ulasan-sate" class="rating-section">
            <form id="rating-form-sate" action="submit_review.php" method="POST">
            <input type="hidden" name="recipe_type" value="Sate Padang" >
                <div class="rating-container">
                    <input type="radio" id="star-5-sate" name="rating" value="5">
                    <label for="star-5-sate" class="star">&#9733;</label>

                    <input type="radio" id="star-4-sate" name="rating" value="4">
                    <label for="star-4-sate" class="star">&#9733;</label>

                    <input type="radio" id="star-3-sate" name="rating" value="3">
                    <label for="star-3-sate" class="star">&#9733;</label>

                    <input type="radio" id="star-2-sate" name="rating" value="2">
                    <label for="star-2-sate" class="star">&#9733;</label>

                    <input type="radio" id="star-1-sate" name="rating" value="1">
                    <label for="star-1-sate" class="star">&#9733;</label>
                </div>

                <textarea id="review-sate" name="review" placeholder="Tulis ulasan Anda..." required></textarea>
                
                <input type="hidden" name="foto" value="upld/sate-padang.jpg">
                <button type="submit"><strong>Kirim</strong></button>
            </form>

            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback-sate" class="feedback"></div>
        </section>
     </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Sate Padang -->
        <div id="bahan-sate-padang" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-sate-padang')">&times;</span>
                <h2>Bahan-Bahan Sate Padang</h2>
                <p>- 500 gr daging sapi</p>
                <p>- 10 siung bawang merah</p>
                <p>- 5 siung bawang putih</p>
                <p>- 5 butir kemiri</p>
                <p>- Santan kelapa</p>
                <p>- Rempah seperti kunyit, jahe, dan lengkuas</p>
            </div>
        </div>

        <div id="cara-sate-padang" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-sate-padang')">&times;</span>
                <h2>Cara Menghidangkan Sate Padang</h2>
                <p>1. Rebus daging hingga empuk, lalu potong-potong.</p>
                <p>2. Tumis bumbu halus seperti bawang, kunyit, jahe, dan kemiri hingga wangi.</p>
                <p>3. Tambahkan santan dan rempah lainnya, masak hingga kuah mengental.</p>
                <p>4. Tusuk daging, panggang sebentar hingga matang.</p>
                <p>5. Sajikan dengan kuah kental di atas sate.</p>
            </div>
        </div>

        <!-- Resep Rendang -->
        <div class="resep-card">
            <img src="Rendaang.jpg" alt="Rendang" class="resep-card-img">
            <h3 class="resep-card-title">Rendang</h3>
            <p class="resep-card-desc">Hidangan khas terbuat dari daging sapi yang dimasak dengan santan dan berbagai rempah-rempah.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-rendang')">Bahan-Bahan</button>
                <button onclick="openModal('cara-rendang')">Cara Menghidangkan</button>
            </div>

                    <!-- Rating dan Ulasan Bagian -->
            <section id="rating-ulasan" class="rating-section">
            <form id="rating-form-rendang" action="submit_review.php" method="POST">
                <input type="hidden" name="recipe_type" value="Rendang">


                <div class="rating-container">
                    <input type="radio" id="star-5-rendang" name="rating" value="5">
                    <label for="star-5-rendang" class="star">&#9733;</label>

                    <input type="radio" id="star-4-rendang" name="rating" value="4">
                    <label for="star-4-rendang" class="star">&#9733;</label>

                    <input type="radio" id="star-3-rendang" name="rating" value="3">
                    <label for="star-3-rendang" class="star">&#9733;</label>

                    <input type="radio" id="star-2-rendang" name="rating" value="2">
                    <label for="star-2-rendang" class="star">&#9733;</label>

                    <input type="radio" id="star-1-rendang" name="rating" value="1">
                    <label for="star-1-rendang" class="star">&#9733;</label>
                </div>

                <textarea id="review-rendang" name="review" placeholder="Tulis ulasan Anda..." required></textarea>

                <input type="hidden" name="foto" value="upld/rendang.jpg">
                <button type="submit"><strong>Kirim</strong></button>
            </form>

            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback" class="feedback"></div>
        </section>
    </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Rendang -->
        <div id="bahan-rendang" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-rendang')">&times;</span>
                <h2>Bahan-Bahan Rendang</h2>
                <p>- 1 kg daging sapi </p>
                <p>- 1 liter santan kental dari 2 butir kelapa</p>
                <p>- 2 batang serai, memarkan</p>
                <p>- 4 lembar daun jeruk purut</p>
                <p>- 2 lembar daun kunyit</p>
                <p>- Garam secukupnya</p>
                <p>- 5 cm lengkuas, memarkan</p>
                <p><strong>Bumbu halus:</strong></p>
                <p>- 10 siung bawang merah</p>
                <p>- 5 siung bawang putih</p>
                <p>- 100 gram cabai merah keriting</p>
                <p>- 3 cm jahe</p>
                <p>- 2 cm kunyit</p>
            </div>
        </div>

        <div id="cara-rendang" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-rendang')">&times;</span>
                <h2>Cara Menghidangkan Rendang</h2>
                <p>1. Potong daging tebal kira-kira 1cm, bumbui dengan bawang putih, garam, dan merica. Diamkan 15 menit.</p>
                <p>2. Pindahkan daging ke wajan, beri air secukupnya, masak sampai air habis dan daging empuk.</p>
                <p>3. Goreng daging dengan minyak panas sebentar saja, tidak perlu sampai kering. Angkat dan tiriskan.</p>
                <p>4. Tumbuk kasar cabe dan bawang. Bisa direbus sebentar agar lebih mudah ditumbuk.</p>
                <p>5. Tumis cabe dan bawang dengan minyak sisa menggoreng daging. Tambahkan air jeruk nipis, garam, dan sedikit gula. Masak hingga bau langu hilang.</p>
                <p>6. Campur daging dengan sambal balado.</p>
                <p>7. Dendeng siap disajikan.</p>
            </div>
        </div>

        <!-- Resep Ayam Gulai -->
        <div class="resep-card">
            <img src="ayam-gulai.jpg" alt="Ayam Gulai" class="resep-card-img">
            <h3 class="resep-card-title">Ayam Gulai</h3>
            <p class="resep-card-desc">Ayam yang dimasak dalam kuah santan kental dengan bumbu rempah khas Minangkabau.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-ayam-gulai')">Bahan-Bahan</button>
                <button onclick="openModal('cara-ayam-gulai')">Cara Menghidangkan</button>
            </div>

                    <!-- Rating dan Ulasan Bagian -->
        <section id="rating-ulasan" class="rating-section">
            <form id="rating-form-ayam-gulai" action="submit_review.php" method="POST">
            <input type="hidden" name="recipe_type" value="Ayam Gulai">
            
            <div class="rating-container">
                <input type="radio" id="star-5-ayam-gulai" name="rating" value="5">
                <label for="star-5-ayam-gulai" class="star">&#9733;</label>

                <input type="radio" id="star-4-ayam-gulai" name="rating" value="4">
                <label for="star-4-ayam-gulai" class="star">&#9733;</label>

                <input type="radio" id="star-3-ayam-gulai" name="rating" value="3">
                <label for="star-3-ayam-gulai" class="star">&#9733;</label>

                <input type="radio" id="star-2-ayam-gulai" name="rating" value="2">
                <label for="star-2-ayam-gulai" class="star">&#9733;</label>

                <input type="radio" id="star-1-ayam-gulai" name="rating" value="1">
                <label for="star-1-ayam-gulai" class="star">&#9733;</label>
            </div>

            <textarea id="review-ayam-gulai" name="review" placeholder="Tulis ulasan Anda..." required></textarea>
            
            <input type="hidden" name="foto" value="upld/ayam-gulai.jpg">
            <button type="submit"><strong>Kirim</strong></button>
        </form>

            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback" class="feedback"></div>
        </section>
    </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Ayam Gulai -->
        <div id="bahan-ayam-gulai" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-ayam-gulai')">&times;</span>
                <h2>Bahan-Bahan Ayam Gulai</h2>
                <p>- 1 ekor ayam, potong menjadi 8 bagian</p>
                <p>- 1 liter santan kental</p>
                <p>- 2 batang serai, memarkan</p>
                <p>- 3 lembar daun salam</p>
                <p>- 3 lembar daun jeruk purut</p>
                <p>- 1 cm lengkuas, memarkan</p>
                <p>- 1 cm jahe, memarkan</p>
                <p>- Garam dan gula secukupnya</p>
                <p><strong>Bumbu halus:</strong></p>
                <p>- 8 siung bawang merah</p>
                <p>- 4 siung bawang putih</p>
                <p>- 4 buah cabai merah keriting</p>
                <p>- 2 cm kunyit</p>
                <p>- 1 sdt ketumbar bubuk</p>
                <p>- 1 sdt jinten bubuk</p>
            </div>
        </div>

        <div id="cara-ayam-gulai" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-ayam-gulai')">&times;</span>
                <h2>Cara Menghidangkan Ayam Gulai</h2>
                <p>1. Tumis bumbu halus bersama serai, daun salam, daun jeruk, lengkuas, dan jahe hingga harum.</p>
                <p>2. Masukkan potongan ayam ke dalam wajan, aduk rata dengan bumbu hingga ayam berubah warna.</p>
                <p>3. Tuangkan santan kental dan masak dengan api sedang, aduk perlahan agar santan tidak pecah.</p>
                <p>4. Tambahkan garam dan gula secukupnya, kemudian masak hingga ayam empuk dan kuah agak mengental.</p>
                <p>5. Ayam gulai siap disajikan, nikmati dengan nasi putih.</p>
            </div>
        </div>

        <!-- Resep Ayam Pop -->
        <div class="resep-card">
            <img src="ayam-pop.jpg" alt="Ayam Pop" class="resep-card-img">
            <h3 class="resep-card-title">Ayam Pop</h3>
            <p class="resep-card-desc">Ayam yang direbus dan digoreng sebentar dengan bumbu khas Minangkabau yang lembut dan gurih.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-ayam-pop')">Bahan-Bahan</button>
                <button onclick="openModal('cara-ayam-pop')">Cara Menghidangkan</button>
            </div>

                    <!-- Rating dan Ulasan Bagian -->
        <section id="rating-ulasan" class="rating-section">
                <form id="rating-form-ayam-pop" action="submit_review.php" method="POST">
                <input type="hidden" name="recipe_type" value="Ayam Pop">
            
            <div class="rating-container">
                <input type="radio" id="star-5-ayam-pop" name="rating" value="5">
                <label for="star-5-ayam-pop" class="star">&#9733;</label>

                <input type="radio" id="star-4-ayam-pop" name="rating" value="4">
                <label for="star-4-ayam-pop" class="star">&#9733;</label>

                <input type="radio" id="star-3-ayam-pop" name="rating" value="3">
                <label for="star-3-ayam-pop" class="star">&#9733;</label>

                <input type="radio" id="star-2-ayam-pop" name="rating" value="2">
                <label for="star-2-ayam-pop" class="star">&#9733;</label>

                <input type="radio" id="star-1-ayam-pop" name="rating" value="1">
                <label for="star-1-ayam-pop" class="star">&#9733;</label>
            </div>

            <textarea id="review-ayam-pop" name="review" placeholder="Tulis ulasan Anda..." required></textarea>

            <input type="hidden" name="foto" value="upld/ayam-pop.jpg">
            <button type="submit"><strong>Kirim</strong></button>
        </form>

            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback" class="feedback"></div>
        </section>
    </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Ayam Pop -->
        <div id="bahan-ayam-pop" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-ayam-pop')">&times;</span>
                <h2>Bahan-Bahan Ayam Pop</h2>
                <p>- 1 ekor ayam, potong menjadi 8 bagian</p>
                <p>- 500 ml air kelapa muda</p>
                <p>- 2 batang serai, memarkan</p>
                <p>- 2 lembar daun salam</p>
                <p>- 1 cm lengkuas, memarkan</p>
                <p>- Garam secukupnya</p>
                <p>- 1 sdt kaldu ayam bubuk (opsional)</p>
                <p><strong>Bumbu halus:</strong></p>
                <p>- 5 siung bawang merah</p>
                <p>- 3 siung bawang putih</p>
                <p>- 1 cm kunyit</p>
                <p>- 1 cm jahe</p>
            </div>
        </div>

        <div id="cara-ayam-pop" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-ayam-pop')">&times;</span>
                <h2>Cara Menghidangkan Ayam Pop</h2>
                <p>1. Rebus ayam dengan air kelapa muda, serai, daun salam, lengkuas, dan garam hingga ayam empuk dan bumbu meresap. Masak dengan api kecil agar bumbu tidak hilang.</p>
                <p>2. Setelah ayam matang dan bumbu meresap, angkat ayam dan tiriskan.</p>
                <p>3. Panaskan minyak dalam wajan, goreng ayam sebentar hingga permukaan ayam agak kecokelatan (tidak perlu terlalu kering).</p>
                <p>4. Angkat ayam dan tiriskan. Sajikan ayam pop dengan sambal atau pelengkap lain sesuai selera.</p>
            </div>
        </div>

        <!-- Resep Soto Padang -->
        <div class="resep-card">
            <img src="soto-padang.jpg" alt="Soto Padang" class="resep-card-img">
            <h3 class="resep-card-title">Soto Padang</h3>
            <p class="resep-card-desc">Soto khas Padang dengan kuah bening kaya rempah dan potongan daging sapi yang empuk.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-soto-padang')">Bahan-Bahan</button>
                <button onclick="openModal('cara-soto-padang')">Cara Menghidangkan</button>
            </div>

                    <!-- Rating dan Ulasan Bagian -->
        <section id="rating-ulasan" class="rating-section">
                <form id="rating-form-soto-padang" action="submit_review.php" method="POST">
            <input type="hidden" name="recipe_type" value="Soto Padang">
            
            <div class="rating-container">
                <input type="radio" id="star-5-soto-padang" name="rating" value="5">
                <label for="star-5-soto-padang" class="star">&#9733;</label>

                <input type="radio" id="star-4-soto-padang" name="rating" value="4">
                <label for="star-4-soto-padang" class="star">&#9733;</label>

                <input type="radio" id="star-3-soto-padang" name="rating" value="3">
                <label for="star-3-soto-padang" class="star">&#9733;</label>

                <input type="radio" id="star-2-soto-padang" name="rating" value="2">
                <label for="star-2-soto-padang" class="star">&#9733;</label>

                <input type="radio" id="star-1-soto-padang" name="rating" value="1">
                <label for="star-1-soto-padang" class="star">&#9733;</label>
            </div>

            <textarea id="review-soto-padang" name="review" placeholder="Tulis ulasan Anda..." required></textarea>

            <input type="hidden" name="foto" value="upld/soto-padang.jpg">
            <button type="submit"><strong>Kirim</strong></button>
        </form>


            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback" class="feedback"></div>
        </section>
    </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Soto Padang -->
        <div id="bahan-soto-padang" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-soto-padang')">&times;</span>
                <h2>Bahan-Bahan Soto Padang</h2>
                <p>- 500 gr daging sapi (bagian sandung lamur atau sengkel)</p>
                <p>- 1 liter kaldu sapi</p>
                <p>- 2 batang serai, memarkan</p>
                <p>- 3 lembar daun salam</p>
                <p>- 2 cm lengkuas, memarkan</p>
                <p>- 3 lembar daun jeruk purut</p>
                <p>- 2 sdm minyak goreng</p>
                <p>- 2 sdm kecap manis</p>
                <p><strong>Bumbu halus:</strong></p>
                <p>- 6 siung bawang merah</p>
                <p>- 4 siung bawang putih</p>
                <p>- 2 cm jahe</p>
                <p>- 2 cm kunyit</p>
                <p>- 1 sdt ketumbar bubuk</p>
                <p>- 1 sdt merica bubuk</p>
            </div>
        </div>

        <div id="cara-soto-padang" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-soto-padang')">&times;</span>
                <h2>Cara Menghidangkan Soto Padang</h2>
                <p>1. Rebus daging sapi dalam air hingga empuk, kemudian potong-potong daging tipis sesuai selera.</p>
                <p>2. Tumis bumbu halus bersama serai, daun salam, daun jeruk, dan lengkuas dengan minyak goreng hingga harum.</p>
                <p>3. Masukkan bumbu tumis ke dalam kaldu sapi yang sudah mendidih, tambahkan kecap manis dan biarkan mendidih selama 15 menit.</p>
                <p>4. Tambahkan potongan daging sapi ke dalam kuah dan masak hingga meresap. Cek rasa dan sesuaikan dengan garam jika perlu.</p>
                <p>5. Sajikan soto padang dengan irisan daun bawang, seledri, dan sambal. Nikmati dengan nasi putih atau ketupat.</p>
            </div>
        </div>

        <!-- Resep Gulai Kikil -->
        <div class="resep-card">
            <img src="gulai-kikil.jpg" alt="Gulai Kikil" class="resep-card-img">
            <h3 class="resep-card-title">Gulai Kikil</h3>
            <p class="resep-card-desc">Kikil sapi yang dimasak dalam kuah santan kental dengan rempah-rempah khas Padang.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-gulai-kikil')">Bahan-Bahan</button>
                <button onclick="openModal('cara-gulai-kikil')">Cara Menghidangkan</button>
            </div>

                    <!-- Rating dan Ulasan Bagian -->
        <section id="rating-ulasan" class="rating-section">
            <form id="rating-form-gulai-kikil" action="submit_review.php" method="POST">
            <input type="hidden" name="recipe_type" value="Gulai Kikil">
            
            <div class="rating-container">
                <input type="radio" id="star-5-gulai-kikil" name="rating" value="5">
                <label for="star-5-gulai-kikil" class="star">&#9733;</label>

                <input type="radio" id="star-4-gulai-kikil" name="rating" value="4">
                <label for="star-4-gulai-kikil" class="star">&#9733;</label>

                <input type="radio" id="star-3-gulai-kikil" name="rating" value="3">
                <label for="star-3-gulai-kikil" class="star">&#9733;</label>

                <input type="radio" id="star-2-gulai-kikil" name="rating" value="2">
                <label for="star-2-gulai-kikil" class="star">&#9733;</label>

                <input type="radio" id="star-1-gulai-kikil" name="rating" value="1">
                <label for="star-1-gulai-kikil" class="star">&#9733;</label>
            </div>

            <textarea id="review-gulai-kikil" name="review" placeholder="Tulis ulasan Anda..." required></textarea>

            <input type="hidden" name="foto" value="upld/gulai-kikil.jpg">
            <button type="submit"><strong>Kirim</strong></button>
        </form>

            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback" class="feedback"></div>
        </section>
    </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Gulai Kikil -->
        <div id="bahan-gulai-kikil" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-gulai-kikil')">&times;</span>
                <h2>Bahan-Bahan Gulai Kikil</h2>
                <p>- 500 gr kikil sapi, potong-potong</p>
                <p>- 1 liter santan kelapa</p>
                <p>- 2 batang serai, memarkan</p>
                <p>- 3 lembar daun salam</p>
                <p>- 2 cm lengkuas, memarkan</p>
                <p>- 2 buah cabai merah besar, iris serong</p>
                <p>- 2 sdm minyak goreng</p>
                <p>- 1 sdt gula merah</p>
                <p>- 2 sdt garam</p>
                <p><strong>Bumbu halus:</strong></p>
                <p>- 8 siung bawang merah</p>
                <p>- 5 siung bawang putih</p>
                <p>- 3 cm kunyit</p>
                <p>- 2 cm jahe</p>
                <p>- 1 sdt ketumbar bubuk</p>
                <p>- 1 sdt merica bubuk</p>
            </div>
        </div>

        <div id="cara-gulai-kikil" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-gulai-kikil')">&times;</span>
                <h2>Cara Menghidangkan Gulai Kikil</h2>
                <p>1. Rebus kikil sapi dalam air mendidih hingga empuk. Tiriskan dan sisihkan.</p>
                <p>2. Tumis bumbu halus bersama serai, daun salam, lengkuas, dan cabai merah hingga harum.</p>
                <p>3. Masukkan kikil yang sudah direbus ke dalam tumisan bumbu, aduk rata.</p>
                <p>4. Tambahkan santan kelapa, gula merah, dan garam. Masak dengan api kecil hingga kuah mengental dan kikil meresap bumbu.</p>
                <p>5. Sesuaikan rasa, angkat dan sajikan dengan nasi putih hangat.</p>
            </div>
        </div>

        <!-- Resep Tambusu -->
        <div class="resep-card">
            <img src="tambusu.jpg" alt="Tambusu" class="resep-card-img">
            <h3 class="resep-card-title">Tambusu</h3>
            <p class="resep-card-desc">makanan yang terbuat dari usus sapi yang diisi dengan telur dadar dan diberi bumbu khas.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-tambusu')">Bahan-Bahan</button>
                <button onclick="openModal('cara-tambusu')">Cara Menghidangkan</button>
            </div>

                    <!-- Rating dan Ulasan Bagian -->
        <section id="rating-ulasan" class="rating-section">
            <form id="rating-form-tambusu" action="submit_review.php" method="POST">
            <input type="hidden" name="recipe_type" value="Tambusu">
            
            <div class="rating-container">
                <input type="radio" id="star-5-tambusu" name="rating" value="5">
                <label for="star-5-tambusu" class="star">&#9733;</label>

                <input type="radio" id="star-4-tambusu" name="rating" value="4">
                <label for="star-4-tambusu" class="star">&#9733;</label>

                <input type="radio" id="star-3-tambusu" name="rating" value="3">
                <label for="star-3-tambusu" class="star">&#9733;</label>

                <input type="radio" id="star-2-tambusu" name="rating" value="2">
                <label for="star-2-tambusu" class="star">&#9733;</label>

                <input type="radio" id="star-1-tambusu" name="rating" value="1">
                <label for="star-1-tambusu" class="star">&#9733;</label>
            </div>

            <textarea id="review-tambusu" name="review" placeholder="Tulis ulasan Anda..." required></textarea>

            <input type="hidden" name="foto" value="upld/tambusu.jpg">
            <button type="submit"><strong>Kirim</strong></button>
        </form>

            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback" class="feedback"></div>
        </section>
    </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Tambusu -->
        <div id="bahan-tambusu" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-tambusu')">&times;</span>
                <h2>Bahan-Bahan Tambusu</h2>
                <p>- 500 gr usus sapi, bersihkan dan rebus</p>
                <p>- 4 butir telur</p>
                <p>- 100 gr daging sapi giling</p>
                <p>- 3 siung bawang putih, haluskan</p>
                <p>- 2 butir bawang merah, haluskan</p>
                <p>- 1 batang daun bawang, iris halus</p>
                <p>- 1 sdm tepung sagu</p>
                <p>- 1 sdt garam</p>
                <p>- 1/2 sdt merica bubuk</p>
                <p>- 1 sdm kecap manis</p>
                <p>- 1 sdm minyak goreng</p>
            </div>
        </div>

        <div id="cara-tambusu" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-tambusu')">&times;</span>
                <h2>Cara Menghidangkan Tambusu</h2>
                <p>1. Cuci bersih usus sapi, kemudian rebus dengan air mendidih dan sedikit garam hingga empuk. Tiriskan dan potong-potong kecil.</p>
                <p>2. Tumis bawang putih dan bawang merah hingga harum, kemudian tambahkan daging sapi giling. Masak hingga daging berubah warna.</p>
                <p>3. Campurkan daging yang sudah dimasak dengan tepung sagu, daun bawang, garam, merica, dan kecap manis. Aduk rata.</p>
                <p>4. Ambil sejumput campuran daging, masukkan ke dalam potongan usus sapi, kemudian rapatkan dengan cara digulung.</p>
                <p>5. Kocok telur dan beri sedikit garam, kemudian tuang ke dalam wajan datar yang sudah dipanaskan dengan minyak goreng.</p>
                <p>6. Letakkan gulungan usus sapi di atas telur dadar, dan masak hingga kedua sisi berwarna keemasan.</p>
                <p>7. Angkat dan sajikan Tambusu Usus Sapi dengan sambal atau nasi hangat.</p>
            </div>
        </div>

        <!-- Resep Aia Aka -->
        <div class="resep-card">
            <img src="aia-aka.jpg" alt="Aia Aka" class="resep-card-img">
            <h3 class="resep-card-title">Aia Aka</h3>
            <p class="resep-card-desc">Minuman khas Sumatera Barat yang terbuat dari daun cincau yang menyegarkan.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-aia-aka')">Bahan-Bahan</button>
                <button onclick="openModal('cara-aia-aka')">Cara Menghidangkan</button>
            </div>

                    <!-- Rating dan Ulasan Bagian -->
        <section id="rating-ulasan" class="rating-section">
            <form id="rating-form-aia-aka" action="submit_review.php" method="POST">
            <input type="hidden" name="recipe_type" value="Aia Aka">
            
            <div class="rating-container">
                <input type="radio" id="star-5-aia-aka" name="rating" value="5">
                <label for="star-5-aia-aka" class="star">&#9733;</label>

                <input type="radio" id="star-4-aia-aka" name="rating" value="4">
                <label for="star-4-aia-aka" class="star">&#9733;</label>

                <input type="radio" id="star-3-aia-aka" name="rating" value="3">
                <label for="star-3-aia-aka" class="star">&#9733;</label>

                <input type="radio" id="star-2-aia-aka" name="rating" value="2">
                <label for="star-2-aia-aka" class="star">&#9733;</label>

                <input type="radio" id="star-1-aia-aka" name="rating" value="1">
                <label for="star-1-aia-aka" class="star">&#9733;</label>
            </div>

            <textarea id="review-aia-aka" name="review" placeholder="Tulis ulasan Anda..." required></textarea>

            <input type="hidden" name="foto" value="upld/aia-aka.jpg">
            <button type="submit"><strong>Kirim</strong></button>
        </form>

            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback" class="feedback"></div>
        </section>
    </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Aia Aka -->
        <div id="bahan-aia-aka" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-aia-aka')">&times;</span>
                <h2>Bahan-Bahan Aia Aka</h2>
                <p>- 100 gr cincau hijau segar</p>
                <p>- Air matang secukupnya</p>
                <p>- Gula aren atau gula merah, serut halus</p>
                <p>- Santan kelapa atau susu kental manis (opsional)</p>
                <p>- Es batu secukupnya</p>
            </div>
        </div>

        <div id="cara-aia-aka" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-aia-aka')">&times;</span>
                <h2>Cara Menghidangkan Aia Aka</h2>
                <p>1. Potong cincau hijau menjadi dadu kecil atau serut halus sesuai selera.</p>
                <p>2. Campurkan cincau dengan air matang di dalam gelas saji.</p>
                <p>3. Tambahkan serutan gula aren atau gula merah untuk rasa manis alami.</p>
                <p>4. Tuangkan santan atau susu kental manis sesuai selera (opsional).</p>
                <p>5. Tambahkan es batu secukupnya untuk sensasi dingin menyegarkan.</p>
                <p>6. Aduk rata dan Aia Aka siap disajikan.</p>
            </div>
        </div>

        <!-- Resep Air Sari Jeruk Nipis -->
        <div class="resep-card">
            <img src="es-jeruk-nipis.jpg" alt="Es Jeruk Nipis" class="resep-card-img">
            <h3 class="resep-card-title">Air Sari Jeruk Nipis</h3>
            <p class="resep-card-desc">Minuman segar yang terbuat dari sari jeruk nipis dengan sedikit tambahan gula dan es.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-jeruk-nipis')">Bahan-Bahan</button>
                <button onclick="openModal('cara-jeruk-nipis')">Cara Menghidangkan</button>
            </div>

                    <!-- Rating dan Ulasan Bagian -->
        <section id="rating-ulasan" class="rating-section">
            <form id="rating-form-air-jeruk-nipis" action="submit_review.php" method="POST">
            <input type="hidden" name="recipe_type" value="Air Sari Jeruk Nipis">
            
            <div class="rating-container">
                <input type="radio" id="star-5-air-jeruk-nipis" name="rating" value="5">
                <label for="star-5-air-jeruk-nipis" class="star">&#9733;</label>

                <input type="radio" id="star-4-air-jeruk-nipis" name="rating" value="4">
                <label for="star-4-air-jeruk-nipis" class="star">&#9733;</label>

                <input type="radio" id="star-3-air-jeruk-nipis" name="rating" value="3">
                <label for="star-3-air-jeruk-nipis" class="star">&#9733;</label>

                <input type="radio" id="star-2-air-jeruk-nipis" name="rating" value="2">
                <label for="star-2-air-jeruk-nipis" class="star">&#9733;</label>

                <input type="radio" id="star-1-air-jeruk-nipis" name="rating" value="1">
                <label for="star-1-air-jeruk-nipis" class="star">&#9733;</label>
            </div>

            <textarea id="review-air-jeruk-nipis" name="review" placeholder="Tulis ulasan Anda..." required></textarea>

            <input type="hidden" name="foto" value="upld/es-jeruk-nipis.jpg">
            <button type="submit"><strong>Kirim</strong></button>
        </form>

            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback" class="feedback"></div>
        </section>
    </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Air Sari Jeruk Nipis -->
        <div id="bahan-jeruk-nipis" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-jeruk-nipis')">&times;</span>
                <h2>Bahan-Bahan Air Sari Jeruk Nipis</h2>
                <p>- 2 buah jeruk nipis, peras airnya</p>
                <p>- 2 sdm gula pasir (sesuai selera)</p>
                <p>- 200 ml air dingin atau air soda (opsional)</p>
                <p>- Es batu secukupnya</p>
            </div>
        </div>

        <div id="cara-jeruk-nipis" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-jeruk-nipis')">&times;</span>
                <h2>Cara Menghidangkan Air Sari Jeruk Nipis</h2>
                <p>1. Campurkan air perasan jeruk nipis dengan gula pasir, aduk hingga gula larut.</p>
                <p>2. Tambahkan air dingin atau air soda untuk tambahan rasa segar (opsional).</p>
                <p>3. Tambahkan es batu sesuai selera.</p>
                <p>4. Aduk rata dan Air Sari Jeruk Nipis siap dinikmati.</p>
            </div>
        </div>

        <!-- Resep Teh Talua -->
        <div class="resep-card">
            <img src="teh-talua.jpg" alt="Teh Talua" class="resep-card-img">
            <h3 class="resep-card-title">Teh Talua</h3>
            <p class="resep-card-desc">Minuman dengan campuran teh, telur, dan gula, menghasilkan rasa yang kaya dan lembut.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-teh-talua')">Bahan-Bahan</button>
                <button onclick="openModal('cara-teh-talua')">Cara Menghidangkan</button>
            </div>

                    <!-- Rating dan Ulasan Bagian -->
        <section id="rating-ulasan" class="rating-section">
            <form id="rating-form-teh-talua" action="submit_review.php" method="POST">
            <input type="hidden" name="recipe_type" value="Teh Talua">
            
            <div class="rating-container">
                <input type="radio" id="star-5-teh-talua" name="rating" value="5">
                <label for="star-5-teh-talua" class="star">&#9733;</label>

                <input type="radio" id="star-4-teh-talua" name="rating" value="4">
                <label for="star-4-teh-talua" class="star">&#9733;</label>

                <input type="radio" id="star-3-teh-talua" name="rating" value="3">
                <label for="star-3-teh-talua" class="star">&#9733;</label>

                <input type="radio" id="star-2-teh-talua" name="rating" value="2">
                <label for="star-2-teh-talua" class="star">&#9733;</label>

                <input type="radio" id="star-1-teh-talua" name="rating" value="1">
                <label for="star-1-teh-talua" class="star">&#9733;</label>
            </div>

            <textarea id="review-teh-talua" name="review" placeholder="Tulis ulasan Anda..." required></textarea>

            <input type="hidden" name="foto" value="upld/teh-talua.jpg">
            <button type="submit"><strong>Kirim</strong></button>
        </form>


            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback" class="feedback"></div>
        </section>
    </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Teh Talua -->
        <div id="bahan-teh-talua" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-teh-talua')">&times;</span>
                <h2>Bahan-Bahan Teh Talua</h2>
                <p>- 1 kantong teh atau 1 sdm teh bubuk</p>
                <p>- 1 butir telur ayam kampung (ambil kuningnya saja)</p>
                <p>- 2 sdm gula pasir (sesuai selera)</p>
                <p>- 200 ml air panas</p>
                <p>- Sedikit perasan air jeruk nipis (opsional)</p>
            </div>
        </div>

        <div id="cara-teh-talua" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-teh-talua')">&times;</span>
                <h2>Cara Menghidangkan Teh Talua</h2>
                <p>1. Seduh teh dengan air panas, biarkan beberapa menit hingga teh larut sempurna.</p>
                <p>2. Sambil menunggu, kocok kuning telur dengan gula hingga mengembang dan berubah warna menjadi lebih pucat.</p>
                <p>3. Tuang teh panas secara perlahan ke dalam campuran telur sambil terus diaduk agar telur tidak menggumpal.</p>
                <p>4. Tambahkan sedikit perasan jeruk nipis jika suka untuk mengurangi bau amis telur.</p>
                <p>5. Aduk hingga tercampur rata, dan Teh Talua siap disajikan.</p>
            </div>
        </div>

        <!-- Resep Es Tebak -->
        <div class="resep-card">
            <img src="es-tebak.jpg" alt="Es Tebak" class="resep-card-img">
            <h3 class="resep-card-title">Es Tebak</h3>
            <p class="resep-card-desc">Minuman khas terbuat dari campuran santan, tebak, dan sirup manis yang menyegarkan.</p>
            <div class="button-container">
                <button onclick="openModal('bahan-es-tebak')">Bahan-Bahan</button>
                <button onclick="openModal('cara-es-tebak')">Cara Menghidangkan</button>
            </div>

                    <!-- Rating dan Ulasan Bagian -->
        <section id="rating-ulasan" class="rating-section">
            <form id="rating-form-es-tebak" action="submit_review.php" method="POST">
            <input type="hidden" name="recipe_type" value="Es Tebak">
            
            <div class="rating-container">
                <input type="radio" id="star-5-es-tebak" name="rating" value="5">
                <label for="star-5-es-tebak" class="star">&#9733;</label>

                <input type="radio" id="star-4-es-tebak" name="rating" value="4">
                <label for="star-4-es-tebak" class="star">&#9733;</label>

                <input type="radio" id="star-3-es-tebak" name="rating" value="3">
                <label for="star-3-es-tebak" class="star">&#9733;</label>

                <input type="radio" id="star-2-es-tebak" name="rating" value="2">
                <label for="star-2-es-tebak" class="star">&#9733;</label>

                <input type="radio" id="star-1-es-tebak" name="rating" value="1">
                <label for="star-1-es-tebak" class="star">&#9733;</label>
            </div>

            <textarea id="review-es-tebak" name="review" placeholder="Tulis ulasan Anda..." required></textarea>

            <input type="hidden" name="foto" value="upld/es-tebak.jpg">
            <button type="submit"><strong>Kirim</strong></button>
        </form>

            <!-- Feedback yang muncul setelah mengirim rating dan ulasan -->
            <div id="feedback" class="feedback"></div>
        </section>
    </div>

        <!-- Modal untuk Bahan dan Cara Menghidangkan Es Tebak -->
        <div id="bahan-es-tebak" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('bahan-es-tebak')">&times;</span>
                <h2>Bahan-Bahan Es Tebak</h2>
                <p>- 500 ml santan kental</p>
                <p>- 200 gr tebak (sejenis cendol khas Padang)</p>
                <p>- 100 ml sirup merah (cocopandan atau lainnya)</p>
                <p>- 2 sdm gula pasir (opsional)</p>
                <p>- Es batu secukupnya</p>
            </div>
        </div>

        <div id="cara-es-tebak" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal('cara-es-tebak')">&times;</span>
                <h2>Cara Menghidangkan Es Tebak</h2>
                <p>1. Masukkan tebak ke dalam gelas saji.</p>
                <p>2. Tambahkan sirup merah sesuai selera.</p>
                <p>3. Tuang santan kental di atas tebak dan sirup.</p>
                <p>4. Tambahkan es batu secukupnya agar lebih segar.</p>
                <p>5. Aduk sebelum diminum. Es Tebak siap disajikan.</p>
            </div>
        </div>
    </div>
</section>
<!-- Resep Section end -->


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