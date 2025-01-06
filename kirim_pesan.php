<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=login_required");
    exit();
}

// Proses formulir hanya jika metode pengiriman adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua input tersedia
    $nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : null;
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
    $no_hp = isset($_POST['no_hp']) ? htmlspecialchars($_POST['no_hp']) : null;
    $pesan = isset($_POST['pesan']) ? htmlspecialchars($_POST['pesan']) : null;

    // Validasi input
    if ($nama && $email && $no_hp && $pesan) {
        // Contoh: Simpan data ke database
        $koneksi = new mysqli("localhost", "root", "", "kulinersb");

        if ($koneksi->connect_error) {
            die("Koneksi gagal: " . $koneksi->connect_error);
        }

        $sql = "INSERT INTO kontak (nama, email, no_hp, pesan) VALUES ('$nama', '$email', '$no_hp', '$pesan')";
        if ($koneksi->query($sql) === TRUE) {
            echo "<script>alert('Pesan berhasil dikirim!'); window.location.href='kontak.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }

        $koneksi->close();
    } else {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
    }
} else {
    // Jika file diakses langsung tanpa POST
    echo "Akses ditolak!";
}
?>
