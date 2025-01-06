<?php
$servername = "localhost";
$username = "root"; // Username database Anda
$password = ""; // Password database Anda
$dbname = "kulinersb"; // Nama database Anda

// Membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>
