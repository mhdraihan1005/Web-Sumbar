<?php
session_start();

// Hapus semua session
session_unset();
session_destroy();

// Redirect ke Halaman Login
header("Location: ../login.php");
exit();

?>
