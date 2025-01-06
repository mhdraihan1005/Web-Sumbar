<?php
include '../koneksi.php';

// Mendapatkan data dari form
$id = $_POST['id'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hashing password sebelum menyimpannya
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Menyiapkan query SQL dengan prepared statement
$query = "INSERT INTO user (id, username, email, password) VALUES (?, ?, ?, ?)";

// Menyiapkan statement
$stmt = mysqli_prepare($koneksi, $query);

// Memasukkan parameter ke dalam prepared statement
mysqli_stmt_bind_param($stmt, "ssss", $id, $username, $email, $hashed_password);

// Mengeksekusi query
$result = mysqli_stmt_execute($stmt);

// Memeriksa hasil eksekusi query
if ($result) {
    // Jika query berhasil, tampilkan pesan sukses dan redirect ke halaman user.php
    echo "<script>
    alert('Data Berhasil Disimpan');
    window.location.href = 'user.php';
    </script>";
} else {
    // Jika query gagal, tampilkan pesan error dan redirect ke halaman user.php
    echo "<script>
    alert('Gagal Menyimpan Data');
    window.location.href = 'user.php';
    </script>";
}

// Menutup statement
mysqli_stmt_close($stmt);
?>
