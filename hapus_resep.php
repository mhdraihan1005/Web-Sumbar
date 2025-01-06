<?php
// Sertakan file koneksi ke database
include '../koneksi.php';

// Pastikan parameter 'id' ada
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data berdasarkan ID untuk mendapatkan nama file gambar
    $query = mysqli_query($koneksi, "SELECT foto FROM reviews WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query);

    // Hapus file gambar jika ada
    if ($data && !empty($data['foto'])) {
        $filePath = "upld/" . $data['foto'];
        if (file_exists($filePath)) {
            unlink($filePath); // Hapus file gambar
        }
    }

    // Hapus data dari database
    $deleteQuery = mysqli_query($koneksi, "DELETE FROM reviews WHERE id = '$id'");

    if ($deleteQuery) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='top_resep.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.'); window.location='top_resep.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan.'); window.location='top_resep.php';</script>";
}
?>
