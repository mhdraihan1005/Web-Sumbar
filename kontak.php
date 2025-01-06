<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>ADMINISTRATOR</title>
    <style>
        .nav-link:hover {
            background-color: gold;
            color: white !important;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Selamat datang, admin!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="ms-auto d-flex align-items-center">
                    <div class="icon">
                        <i class="fas fa-envelope-square me-3"></i>
                        <i class="fas fa-bell-slash me-3"></i>
                        <i class="fas fa-user-circle me-3"></i>
                        <a href="logout.php"><i class="fas fa-sign-out-alt me-3"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar and Content -->
    <div class="row g-0 mt-5">
        <!-- Sidebar -->
        <div class="col-md-2 bg-info mt-2 pt-4">
            <ul class="nav flex-column ms-3 mb-5">

                <li class="nav-item">
                    <a class="nav-link active text-white" href="dashboard.php"><i class="fas fa-home me-2"></i>Dashboard</a>
                    <hr class="bg-secondary">
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="user.php"><i class="fas fa-user me-2"></i>Daftar User</a>
                    <hr class="bg-secondary">
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="kuliner.php"><i class="fas fa-utensils me-2"></i>Daftar Kuliner</a>
                    <hr class="bg-secondary">
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="top_resep.php"><i class="fas fa-star me-2"></i>Daftar Top Resep</a>
                    <hr class="bg-secondary">
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="kontak.php"><i class="fas fa-address-book me-2"></i>Daftar Kontak</a>
                    <hr class="bg-secondary">
                </li>

            </ul>
        </div>

        <!-- Content -->
        <div class="col-md-10 p-5 pt-2">
            <h3><i class="fas fa-address-book me-2"></i> Daftar Kontak</h3>
            <hr>

            <!-- Table -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">ID</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">NO HP</th>
                        <th scope="col">PESAN</th>
                        <th scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $query = mysqli_query($koneksi, "SELECT * FROM kontak");
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['no_hp']; ?></td>
                            <td><?php echo $data['pesan']; ?></td>
                            <td>
                                <a href="hapus_kontak.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i> Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
