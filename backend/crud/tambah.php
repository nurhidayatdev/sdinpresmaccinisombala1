<?php
session_start();
include '../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['email'])) {
  header("Location: ../index.php");
  exit();
}

// Ambil dari session
$nama = $_SESSION['nama']; // dari database (bukan input login)
$email = $_SESSION['email'];
$tabel = $_GET['tabel'] ?? '';

if (!$tabel) {
    die("Parameter tabel tidak ditemukan!");
}

$tabel_diizinkan = ['fasilitas_sekolah', 'login'];
if (!in_array($tabel, $tabel_diizinkan)) {
    die("Tabel tidak diizinkan!");
}

if (isset($_POST['tambah'])) {
    switch ($tabel) {
        case 'fasilitas_sekolah':
            $fasilitas = $_POST['fasilitas'];
            $deskripsi = $_POST['deskripsi'];
            $gambar = '';
            if (!empty($_FILES['gambar']['name'])) {
                $target_dir = "../img/fasilitas/";
                $gambar = time() . "_" . basename($_FILES["gambar"]["name"]);
                $target_file = $target_dir . $gambar;
                move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
            }
            mysqli_query($koneksi, "INSERT INTO fasilitas_sekolah (fasilitas, deskripsi, gambar)
                VALUES ('$fasilitas', '$deskripsi', '$gambar')");
            header("Location: dashboard_fasilitas.php");
            break;

        case 'login':
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            mysqli_query($koneksi, "INSERT INTO login (nama, email, password)
                VALUES ('$nama','$email','$password')");
            header("Location: dashboard_login.php");
            break;
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - SD Inpres Maccini Sombala 1</title>
  <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css" />
    <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../style.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

  <!-- Sidebar -->
  <nav class="sidebar" id="sidebarMenu">
    <div class="brand">🏫 SD Inpres Maccini<br>Sombala 1</div>
    <div class="user-info">
      <div class="user-info">
  <img src="../img/main/icon.png" alt="">
  <div><strong><?= htmlspecialchars($nama) ?></strong></div>
  <small><?= htmlspecialchars($email) ?></small>
</div>

    </div>
    <ul class="nav flex-column mt-3">
      <li><a class="nav-link active" href="#"><i data-lucide="school"></i> Dashboard</a></li>
      <li><a class="nav-link" href="dashboard2.php"><i data-lucide="school"></i> Profil Sekolah</a></li>
      <li><a class="nav-link" href="dashboard_fasilitas.php"><i data-lucide="building-2"></i> Fasilitas Sekolah</a></li>
      <li><a class="nav-link" href="dashboard_login.php"><i data-lucide="users"></i> Data Login</a></li>
      <li><a class="nav-link text-warning" href="../logout.php"><i data-lucide="log-out"></i> Log Out</a></li>
    </ul>
  </nav>

  <!-- Main Content -->
  <main id="mainContent">
    <div class="topbar shadow-sm">
      
      <div class="welcome-text">Selamat datang, <strong><?= htmlspecialchars($nama) ?></strong> 👋</div>
      <button class="toggle-sidebar-btn d-lg-none" id="toggleSidebar">
        <i data-lucide="menu"></i>
      </button>
    </div>

    <div class="container-fluid mt-4">
      <div class="container">
        <h2 class="fw-bold mb-3 text-success">
            Tambah Data <?= ucwords(str_replace('_', ' ', $tabel)); ?>
        </h2>
        <form method="POST" enctype="multipart/form-data">

            <?php if ($tabel === 'fasilitas_sekolah'): ?>
                <div class="mb-3"><label>Nama Fasilitas</label>
                    <input type="text" name="fasilitas" class="form-control" required>
                </div>
                <div class="mb-3"><label>Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Upload Gambar</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                </div>

            <?php elseif ($tabel === 'login'): ?>
                <div class="mb-3"><label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3"><label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3"><label>Password</label>
                    <input type="text" name="password" class="form-control" required>
                </div>
            <?php endif; ?>

            <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
            <a href="../dashboard_<?= $tabel; ?>.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    lucide.createIcons();

    // ✅ tombol sidebar di layar kecil
    document.getElementById('toggleSidebar').addEventListener('click', function() {
      const sidebar = document.getElementById('sidebarMenu');
      sidebar.style.display = sidebar.style.display === 'block' ? 'none' : 'block';
    });
  </script>

</body>
</html>
