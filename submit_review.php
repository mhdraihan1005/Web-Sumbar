<?php
// Import koneksi ke database
require_once 'koneksi.php';

// Periksa apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $rating = isset($_POST['rating']) ? intval($_POST['rating']) : null; // Pastikan rating diambil dengan benar
    $review_text = trim($_POST['review']); // Ambil teks ulasan (hapus spasi ekstra)
    $recipe_type = isset($_POST['recipe_type']) ? trim($_POST['recipe_type']) : null; // Ambil jenis resep
    $foto = trim($_POST['foto']); // Ambil path foto dari form 


    // Validasi data
    if ($rating === null) {
        echo "<script type='text/javascript'>
                alert('Error: Rating tidak boleh kosong.');
                window.history.back(); // Kembali ke halaman sebelumnya
              </script>";
        exit;
    }

    if ($rating < 1 || $rating > 5) {
        echo "<script type='text/javascript'>
                alert('Error: Rating harus berada di antara 1 dan 5.');
                window.history.back(); // Kembali ke halaman sebelumnya
              </script>";
        exit;
    }

    if (empty($review_text)) {
        echo "<script type='text/javascript'>
                alert('Error: Ulasan tidak boleh kosong.');
                window.history.back(); // Kembali ke halaman sebelumnya
              </script>";
        exit;
    }

    if (empty($recipe_type)) {
        echo "<script type='text/javascript'>
                alert('Error: Jenis resep tidak boleh kosong.');
                window.history.back(); // Kembali ke halaman sebelumnya
              </script>";
        exit;
    }

    if (empty($recipe_type) || empty($review_text) || empty($foto) || $rating < 1 || $rating > 5) {  
        echo "<script>alert('Error: Pastikan semua form diisi dengan benar.'); window.history.back();</script>";  
        exit;  
    }  //foto

    // SQL untuk menyimpan data ke database
    //$sql = "INSERT INTO reviews (recipe_type, rating, review_text) VALUES (?, ?, ?)";
    $sql = "INSERT INTO reviews (recipe_type, rating, review_text, foto) VALUES (?, ?, ?, ?)";

    // Gunakan prepared statement untuk keamanan
    $stmt = $koneksi->prepare($sql);
    if ($stmt) {
        // Bind parameter
        //$stmt->bind_param("sis", $recipe_type, $rating, $review_text);
        $stmt->bind_param("siss", $recipe_type, $rating, $review_text, $foto); 

        // Eksekusi query
        if ($stmt->execute()) {
            // Tampilkan alert menggunakan JavaScript setelah sukses
            echo "<script type='text/javascript'>
                    alert('Sukses: Ulasan Anda untuk $recipe_type telah disimpan.');
                    window.location.href = 'resep.php'; // Redirect ke halaman utama setelah sukses
                  </script>";
            exit;
        } else {
            echo "<script type='text/javascript'>
                    alert('Error: Ulasan gagal disimpan.');
                    window.history.back(); // Kembali ke halaman sebelumnya
                  </script>";
        }

        $stmt->close();
    } else {
        echo "<script type='text/javascript'>
                alert('Error: " . $koneksi->error . "');
                window.history.back(); // Kembali ke halaman sebelumnya
              </script>";
    }
} else {
    echo "<script type='text/javascript'>
            alert('Error: Metode request tidak valid.');
            window.history.back(); // Kembali ke halaman sebelumnya
          </script>";
}

// Tutup koneksi database
$koneksi->close();
?>




<?php  
  

// // Periksa apakah data dikirim melalui metode POST  
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
//     // Ambil data dari form  
//     $recipe_type = trim($_POST['recipe_type']);  
//     $rating = intval($_POST['rating']);  
//     $review_text = trim($_POST['review']);  
//     $foto = trim($_POST['foto']); // Ambil path foto dari form  

//     // Validasi data  
//     if (empty($recipe_type) || empty($review_text) || empty($foto) || $rating < 1 || $rating > 5) {  
//         echo "<script>alert('Error: Pastikan semua form diisi dengan benar.'); window.history.back();</script>";  
//         exit;  
//     }  

//     // SQL untuk menyimpan data ke database  
//     $sql = "INSERT INTO reviews (recipe_type, rating, review_text, foto) VALUES (?, ?, ?, ?)";  
    
//     // Menggunakan prepared statement  
//     $stmt = $koneksi->prepare($sql);  
//     if ($stmt) {  
//         // Bind parameter  
//         $stmt->bind_param("siss", $recipe_type, $rating, $review_text, $foto);  

//         // Eksekusi query  
//         if ($stmt->execute()) {  
//             // Tampilkan alert sukses  
//             echo "<script>alert('Ulasan berhasil dikirim!'); window.location.href = 'tampilan_dashboard.php';</script>";  
//             exit;  
//         } else {  
//             echo "<script>alert('Error: Ulasan gagal disimpan.'); window.history.back();</script>";  
//         }  
//         $stmt->close();  
//     } else {  
//         echo "<script>alert('Error: " . $koneksi->error . "'); window.history.back();</script>";  
//     }  
// }  

// // Tutup koneksi  
// $koneksi->close();  
// ?>