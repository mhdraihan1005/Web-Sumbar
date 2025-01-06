<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipe_type = $_POST['recipe_type'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    // Proses upload file
    $target_dir = "upld/";
    $foto = basename($_FILES["foto"]["name"]);
    $target_file = $target_dir . $foto;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi tipe file
    $allowed_types = ["jpg", "jpeg", "png"];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Hanya file JPG, JPEG, dan PNG yang diizinkan.");
    }

    // Pindahkan file ke folder
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        // Simpan data ke database
        $query = "INSERT INTO reviews (foto, recipe_type, rating, review_text) 
                  VALUES ('$foto', '$recipe_type', '$rating', '$review_text')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>  
                    alert('Data Berhasil Disimpan');  
                    window.location.href = 'top_resep.php';  
                  </script>";  
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }
}
?>
