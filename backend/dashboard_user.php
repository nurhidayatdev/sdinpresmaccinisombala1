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
      <li><a class="nav-link " href="dashboard.php"><i data-lucide="grid"></i> Dashboard</a></li>
      <li><a class="nav-link" href="dashboard_profil.php"><i data-lucide="school"></i> Profil</a></li>
      <li><a class="nav-link" href="dashboard_akademik.php"><i data-lucide="graduation-cap"></i> Akademik</a></li>
      
      <li><a class="nav-link active" href="#"><i data-lucide="users"></i> User</a></li>
      <li><a class="nav-link text-warning" href="../index.php"><i data-lucide="log-out"></i> Log Out</a></li>
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
      <h3 class="fw-bold mb-3">Dashboard Utama</h3>

      
<div class="dashboard-cards">
        <a href="dashboard_kelompok.php">
 <div class="card card-custom p-3 text-center">
          <i data-lucide="building-2" class="mb-2" style="width: 32px; height: 32px;"></i>
          <h5>Anggota Kelompok</h5>
          <p class="text-muted mb-0">Data sarana dan prasarana sekolah</p>
        </div>
        </a>

        <a href="dashboard_login.php">
 <div class="card card-custom p-3 text-center">
          <i data-lucide="users" class="mb-2" style="width: 32px; height: 32px;"></i>
          <h5>Data Login</h5>
          <p class="text-muted mb-0">Kelola akun pengguna sistem</p>
        </div>
        </a>
      </div>
     
</div>
    </div>
  </main>

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
