<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi tersedia

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username atau password tidak boleh kosong.";
    } else {
        $username = mysqli_real_escape_string($koneksi, $username);
        $password = mysqli_real_escape_string($koneksi, $password);

        // Query cek username dan password
        $query = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($koneksi, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Jika password di-hash
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role']; // Menyimpan role di session

                // Arahkan berdasarkan role
                if ($row['role'] == 'admin') {
                    header("Location: ./dashboard/dashboard.php"); // Untuk admin
                } else {
                    header("Location: index.php"); // Untuk user
                }
                exit();
            } else {
                $error = "Password salah.";
            }
        } else {
            $error = "Username tidak ditemukan.";
        }
    }
}
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
    <link rel="stylesheet" href="style1.css">
</head>
<body>

    <!-- Tombol dengan ikon kembali ke halaman utama -->
    <a href="index.php" class="back-to-home">
        <i class="fa fa-home"></i> Back to Home
    </a>

    <!-- Form Login Start -->
    <div class="login-container" id="Login">
        <div class="login-form">
            <h2>Login</h2>
            <?php if (!empty($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>

                <button type="submit">Login</button>
            </form>

            <p class="register">Belum punya akun? <a href="register.php" id="showRegister">Daftar di sini</a></p>
        </div>
    </div>
    <!-- Form Login End -->

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>

    <!-- My Javascript -->
    <script src="script.js"></script>

</body>
</html>
