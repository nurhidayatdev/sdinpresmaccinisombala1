<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['email'])) {
  header("Location: ../../index.php");
  exit();
}

// Ambil dari session
$nama = $_SESSION['nama'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - SD Inpres Maccini Sombala 1</title>
  <link rel="stylesheet" href="../../bootstrap/dist/css/bootstrap.min.css" />
  <script src="../../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../../frontend/style.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="db">

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
      <li><a class="nav-link active" href="#"><i data-lucide="graduation-cap"></i> Akademik</a></li>
      <li><a class="nav-link" href="dashboard_user.php"><i data-lucide="users"></i> User</a></li>
      <li><a class="nav-link text-danger btn-logout" href="../../index.php"><i data-lucide="log-out"></i> Log Out</a></li>
    </ul>
  </nav>

  <main id="mainContent">
    <div class="topbar shadow-sm">

      <div class="welcome-text">Selamat datang, <strong><?= htmlspecialchars($nama) ?></strong> 👋</div>
      <button class="toggle-sidebar-btn d-lg-none" id="toggleSidebar">
        <i data-lucide="menu"></i>
      </button>
    </div>

    <div class="mt-4">
      <h5 class="fw-bold mb-3">Dashboard Akademik</h5>

      <div class="dashboard-cards">

        <a href="dashboard_kegiatan_akademik.php">
          <div class="card card-custom p-3 text-center">
            <i data-lucide="book-open-text" class="mb-2" style="width: 32px; height: 32px;"></i>
            <h5>Kegiatan Akademik</h5>
            <p class="text-muted mb-0">Kelola jadwal pelajaran dan kegiatan belajar mengajar</p>
          </div>
        </a>

        <a href="dashboard_info_akademik.php">
          <div class="card card-custom p-3 text-center">
            <i data-lucide="graduation-cap" class="mb-2" style="width: 32px; height: 32px;"></i>
            <h5>Info Akademik</h5>
            <p class="text-muted mb-0">Lihat statistik siswa, dan informasi pencapaian akademik</p>
          </div>
        </a>

        <a href="dashboard_berita.php">
          <div class="card card-custom p-3 text-center">
            <i data-lucide="newspaper" class="mb-2" style="width: 32px; height: 32px;"></i>
            <h5>Berita & Pengumuman</h5>
            <p class="text-muted mb-0">Buat, kelola, dan publikasikan berita serta pengumuman</p>
          </div>
        </a>

        <a href="dashboard_futsal.php">
          <div class="card card-custom p-3 text-center">
            <i data-lucide="card-sim" class="mb-2" style="width: 32px; height: 32px;"></i>
            <h5>Formulir Futsal</h5>
            <p class="text-muted mb-0">Kelola pendaftaran dan informasi pertandingan Futsal</p>
          </div>
        </a>

        <a href="dashboard_guru.php">
          <div class="card card-custom p-3 text-center">
            <i data-lucide="users-round" class="mb-2" style="width: 32px; height: 32px;"></i>
            <h5>Data Guru</h5>
            <p class="text-muted mb-0">Lihat dan kelola profil dan data kepegawaian guru</p>
          </div>
        </a>
      </div>

    </div>
    </div>
    <p class="text-center mb-0 mt-4">
                © 2025 SD Inpres Maccini Sombala 1 — All Rights Reserved
            </p>
  </main>

  <script>
    lucide.createIcons();

    document.getElementById('toggleSidebar').addEventListener('click', function() {
      const sidebar = document.getElementById('sidebarMenu');
      sidebar.style.display = sidebar.style.display === 'block' ? 'none' : 'block';
    });

    document.querySelector('.btn-logout').addEventListener('click', function(e) {
    e.preventDefault(); 
    const href = this.getAttribute('href');

    Swal.fire({
        title: 'Yakin ingin keluar?',
        text: "Anda akan logout dari sistem.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6BCB77',
        confirmButtonText: 'Log Out',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = href;
        }
    });
});
  </script>

</body>

</html>