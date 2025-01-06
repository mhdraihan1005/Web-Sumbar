<?php  
include '../koneksi.php'; 

$foto = $_FILES['foto'];  // Menggunakan metode upload file
$name = $_POST['nama'];   
$deskripsi = $_POST['deskripsi'];  

// Pastikan semua input ada  
if ($foto['name'] && $name && $deskripsi) {  
    // Path untuk menyimpan file gambar
    $targetDir = "img/";
    $targetFile = $targetDir . basename($foto['name']);
    $uploadOk = 1;

    // Validasi jenis file (hanya gambar)
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($imageFileType, $validExtensions)) {
        echo "<script>
                alert('Hanya file gambar yang diperbolehkan.');
                window.location.href = 'kuliner.php';
              </script>";
        $uploadOk = 0;
    }

    // Cek apakah file berhasil di-upload
    if ($uploadOk && move_uploaded_file($foto['tmp_name'], $targetFile)) {
        // Gunakan prepared statements untuk memasukkan data ke database
        $stmt = $koneksi->prepare("INSERT INTO kuliner (foto, nama, deskripsi) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $foto['name'], $name, $deskripsi);

        if ($stmt->execute()) {
            echo "<script>  
                    alert('Data Berhasil Disimpan');  
                    window.location.href = 'kuliner.php';  
                  </script>";  
        } else {  
            echo "<script>  
                    alert('Data Gagal Disimpan');  
                    window.location.href = 'kuliner.php';  
                  </script>";  
        }
        $stmt->close();
    } else {
        echo "<script>
                alert('Gagal mengupload gambar.');
                window.location.href = 'kuliner.php';
              </script>";
    }
} else {  
    echo "<script>  
            alert('Semua field harus diisi');  
            window.location.href = 'kuliner.php';  
          </script>";  
}  
?>
