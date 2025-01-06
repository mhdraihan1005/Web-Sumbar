<?php  
$search = isset($_GET['search']) ? $_GET['search'] : ''; 

// Query untuk mengambil data kuliner  
$query = "SELECT * FROM kuliner";  
if ($search) {  
    $query .= " WHERE nama LIKE '%" . mysqli_real_escape_string($koneksi, $search) . "%'";  
}  
?>

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
      <a class="navbar-brand text-white" href="#">Selamat datang, admin! </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="ms-auto d-flex align-items-center">
          <div class="icon">
            <i class="fas fa-envelope-square me-3"></i>
            <i class="fas fa-bell-slash me-3"></i>
            <i class="fas fa-user-circle me-3"></i> <!-- Profil User Icon -->
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
            <h3><i class="fas fa-utensils me-2"></i> Daftar Kuliner</h3>
            <hr>
                <form class="d-flex mb-3">
                 <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                 <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
                <i class="fas fa-plus-circle me-2"></i>TAMBAH DATA KULINER
            </button>

            <!-- Modal Tambah Data -->
            <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahDataLabel">Tambah Data Kuliner</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="tambah_kuliner.php" method="POST" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="foto" name="foto" required>
                                </div>                          
                            
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Kuliner</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="form-label">Deskripsi Kuliner</label>
                                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Data -->
            <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataLabel">Edit Data Kuliner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="ubah_kuliner.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit-id">
                <input type="hidden" name="foto_lama" id="edit-foto-lama"> <!-- Foto lama tersembunyi -->

                    <!-- Preview Foto Lama -->
                    <div class="mb-3">
                        <label for="edit-foto-preview" class="form-label">Foto Lama</label><br>
                        <img id="edit-foto-preview" src="" alt="Foto Lama" width="150" style="border: 1px solid #ddd; border-radius: 5px;">
                    </div>

                    <!-- Input Foto Baru -->
                    <div class="mb-3">
                        <label for="edit-foto" class="form-label">Foto Baru</label>
                        <input type="file" class="form-control" id="edit-foto" name="foto">
                    </div>

                    <div class="mb-3">
                        <label for="edit-nama" class="form-label">Nama Kuliner</label>
                        <input type="text" class="form-control" id="edit-nama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-deskripsi" class="form-label">Deskripsi Kuliner</label>
                        <textarea class="form-control" id="edit-deskripsi" name="deskripsi" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

            <!-- Table -->
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">ID KULINER</th>
                        <th scope="col">FOTO</th>
                        <th scope="col">NAMA KULINER</th>                     
                        <th scope="col">DESKRIPSI KULINER</th>
                        <th scope="col">AKSI</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';
                    $query = mysqli_query($koneksi, "SELECT * FROM kuliner");
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['id']; ?></td>
                            <td><img src="img/<?php echo $data['foto']?>"width="100"></td>  
                            <td><?php echo $data['nama']; ?></td>
                            <td><?php echo $data['deskripsi']; ?></td>
                            
                            <td>
                            <button class="btn btn-success btn-sm me-1 edit-button"
                            data-bs-toggle="modal"
                            data-bs-target="#editDataModal"
                            data-id="<?php echo $data['id']; ?>"
                            data-foto="<?php echo $data['foto']; ?>"  
                            data-nama="<?php echo $data['nama']; ?>"
                            data-deskripsi="<?php echo $data['deskripsi']; ?>">
                                                             
                            <i class="fas fa-edit"></i> Edit
                            </button>
                            <a href="hapus_kuliner.php?id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
     const editButtons = document.querySelectorAll('.edit-button');
        editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const foto =  this.getAttribute('data-foto');
            const nama = this.getAttribute('data-nama');
            const deskripsi = this.getAttribute('data-deskripsi');
            
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-foto').value = foto;
            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-deskripsi').value = deskripsi;
        });
    });
});

// Memastikan data foto lama diisi dengan benar saat tombol edit diklik
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-button');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const foto = this.getAttribute('data-foto');
            const nama = this.getAttribute('data-nama');
            const deskripsi = this.getAttribute('data-deskripsi');
            
            // Isi form edit dengan data yang sesuai
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-foto-lama').value = foto;
            document.getElementById('edit-foto-preview').src = 'img/' + foto; // Menampilkan foto lama
            document.getElementById('edit-nama').value = nama;
            document.getElementById('edit-deskripsi').value = deskripsi;
        });
    });
});

</script>
</body>

</html>