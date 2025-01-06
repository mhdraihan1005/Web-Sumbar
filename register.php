<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = htmlspecialchars($_POST['role']); // Ambil role dari form

    // Validasi apakah username sudah ada
    $checkUser = $koneksi->prepare("SELECT * FROM user WHERE username = ?");
    $checkUser->bind_param("s", $username);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        // Jika username sudah ada
        echo "<script>
        alert('Username sudah terdaftar! Silakan pilih username lain.');
        window.history.back();
        </script>";
    } else {
        // Simpan data pengguna baru ke database
        $stmt = $koneksi->prepare("INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password, $role);

        if ($stmt->execute()) {
            // Jika berhasil, arahkan ke halaman sesuai role
            echo "<script>
            alert('Registrasi berhasil! Silakan login.');
            window.location.href = 'login.php';
            </script>";
        } else {
            // Jika gagal menyimpan data
            echo "<script>
            alert('Terjadi kesalahan, coba lagi nanti.');
            window.history.back();
            </script>";
        }

        $stmt->close(); // Tutup statement
    }

    $checkUser->close(); // Tutup statement validasi
}
$koneksi->close(); // Tutup koneksi database
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuliner Sumatera Barat</title>

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet">

<!-- Feather Icons JS-->
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<!-- Feather Icons CSS-->
<link href="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.css" rel="stylesheet">

<!-- My Style CSS -->
    <link rel="stylesheet" href="style2.css">
</head>
<body>

    <!-- Form Daftar Start -->
    <div class="register-container" id="registerContainer">
        <div class="register-form">
            <h2>Daftar Akun</h2>
            <form action="register.php" method="POST">
                <label for="register-username">Username</label>
                <input type="text" id="register-username" name="username" placeholder="Enter Username" required>
        
                <label for="register-email">Email</label>
                <input type="email" id="register-email" name="email" placeholder="Enter Email" required>
        
                <label for="register-password">Password</label>
                <input type="password" id="register-password" name="password" placeholder="Enter Password" required>

                <label for="register-role">Role</label>
                <select id="register-role" name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>

                <button type="submit" id="register-submit">Daftar</button>
            </form>
            <p class="login">Sudah punya akun? <a href="login.php" id="showLogin">Login di sini</a></p>
        </div>
    </div>
     <!-- Form Daftar End -->

      <!-- Feather Icons -->
    <script>
        feather.replace();
      </script>


    <!-- My Javascript -->
     <script src="script.js"></script>

</body>
</html>
