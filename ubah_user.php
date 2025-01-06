<?php
// Include koneksi database
include '../koneksi.php';

// Mengecek apakah data dikirimkan melalui form
if (isset($_POST['id'], $_POST['username'], $_POST['email'], $_POST['password'])) {
    // Mengambil data dari form
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password menggunakan PASSWORD_BCRYPT
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Menyiapkan query SQL untuk update data user
    $query = "UPDATE user SET username = ?, email = ?, password = ? WHERE id = ?";

    // Menyiapkan prepared statement
    if ($stmt = mysqli_prepare($koneksi, $query)) {
        // Mengikat parameter ke statement
        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $hashedPassword, $id);

        // Mengeksekusi query
        if (mysqli_stmt_execute($stmt)) {
            // Jika berhasil, tampilkan pesan sukses
            echo "<script>
                alert('Data user berhasil diperbarui');
                window.location.href = 'user.php';
            </script>";
        } else {
            // Jika gagal, tampilkan pesan error
            echo "<script>
                alert('Gagal memperbarui data user');
                window.location.href = 'user.php';
            </script>";
        }

        // Menutup prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
            alert('Query gagal disiapkan');
            window.location.href = 'user.php';
        </script>";
    }

    // Menutup koneksi database
    mysqli_close($koneksi);
} else {
    // Jika data tidak lengkap, tampilkan pesan error
    echo "<script>
        alert('Data tidak lengkap');
        window.location.href = 'user.php';
    </script>";
}
?>
