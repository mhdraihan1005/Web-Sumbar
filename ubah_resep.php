<?php
// Sertakan file koneksi database
include '../koneksi.php';

// Tangkap data dari form
$id = $_POST['id'];
$recipe_type = $_POST['recipe_type'];
$rating = $_POST['rating'];
$review_text = $_POST['review_text'];

// Proses upload file jika ada foto baru
$fotoLama = $_POST['foto_lama']; // Foto lama dari input hidden
$fotoBaru = $_FILES['foto'];
$targetDir = "upld/";
$targetFile = $targetDir . basename($fotoBaru['name']);
$uploadOk = 1;

// Validasi dan proses upload foto baru
if ($fotoBaru['name']) {
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($imageFileType, $validExtensions)) {
        echo "<script>
                alert('Hanya file gambar yang diperbolehkan.');
                window.location.href = 'top_resep.php?id=$id';
              </script>";
        $uploadOk = 0;
    }

    if ($uploadOk && move_uploaded_file($fotoBaru['tmp_name'], $targetFile)) {
        // Jika upload berhasil, gunakan foto baru
        $foto = $fotoBaru['name'];

        // Hapus foto lama jika ada
        if ($fotoLama && file_exists($targetDir . $fotoLama)) {
            unlink($targetDir . $fotoLama);
        }
    } else {
        echo "<script>
                alert('Gagal mengupload gambar.');
                window.location.href = 'top_resep.php?id=$id';
              </script>";
        exit;
    }
} else {
    // Jika tidak ada foto baru, gunakan foto lama
    $foto = $fotoLama;
}

// Update data ke database menggunakan prepared statements
$stmt = $koneksi->prepare("UPDATE reviews SET foto = ?, recipe_type = ?, rating = ?, review_text = ? WHERE id = ?");
$stmt->bind_param("ssisi", $foto, $recipe_type, $rating, $review_text, $id);

if ($stmt->execute()) {
    echo "<script>
            alert('Data Berhasil Diupdate.');
            window.location.href = 'top_resep.php';
          </script>";
} else {
    echo "<script>
            alert('Data Gagal Diupdate.');
            window.location.href = 'top_resep.php?id=$id';
          </script>";
}

$stmt->close();
?>
