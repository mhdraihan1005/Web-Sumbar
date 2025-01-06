<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Proses hapus
    $query = mysqli_query($koneksi, "DELETE FROM kontak WHERE id='$id'");

    if ($query) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href = 'kontak.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location.href = 'kontak.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href = 'kontak.php';</script>";
}
?>
