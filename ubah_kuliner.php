<?php
// include database connection file
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];

// Proses upload file jika ada file baru
$fotoLama = $_POST['foto_lama']; // Foto lama disimpan dari form hidden input
$fotoBaru = $_FILES['foto'];
$targetDir = "img/";
$targetFile = $targetDir . basename($fotoBaru['name']);
$uploadOk = 1;

// Validasi dan proses upload file baru
if ($fotoBaru['name']) {
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($imageFileType, $validExtensions)) {
        echo "<script>
                alert('Hanya file gambar yang diperbolehkan.');
                window.location.href = 'kuliner.php';
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
                window.location.href = 'kuliner.php';
              </script>";
        exit;
    }
} else {
    // Jika tidak ada foto baru, gunakan foto lama
    $foto = $fotoLama;
}

// Update data ke database menggunakan prepared statements
$stmt = $koneksi->prepare("UPDATE kuliner SET foto = ?, nama = ?, deskripsi = ? WHERE id = ?");
$stmt->bind_param("sssi", $foto, $nama, $deskripsi, $id);

if ($stmt->execute()) {
    echo "<script>
            alert('Data Berhasil Diupdate.');
            window.location.href = 'kuliner.php';
          </script>";
} else {
    echo "<script>
            alert('Data Gagal Diupdate.');
            window.location.href = 'kuliner.php';
          </script>";
}

$stmt->close();
?>
