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

$sql = "SELECT uraian, guru, tendik, ptk FROM ptk_pd WHERE uraian IN ('Laki - Laki', 'Perempuan')";
$result = $koneksi->query($sql);

$labels = [];
$data_guru = [];
$data_tendik = [];
$data_ptk = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Ambil label (Laki-laki/Perempuan)
        $labels[] = $row['uraian'];
        
        // Ambil data untuk Guru, Tendik, dan PTK
        $data_guru[] = (int)$row['guru'];
        $data_tendik[] = (int)$row['tendik'];
        $data_ptk[] = (int)$row['ptk'];
    }
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      <li><a class="nav-link active" href="#"><i data-lucide="grid"></i> Dashboard</a></li>
      <li><a class="nav-link" href="dashboard_profil_sekolah.php"><i data-lucide="school"></i> Profil Sekolah</a></li>
      <li><a class="nav-link" href="dashboard_info_akademik.php"><i data-lucide="graduation-cap"></i> Info Akademik</a></li>
      <li><a class="nav-link" href="dashboard_fasilitas.php"><i data-lucide="building-2"></i> Fasilitas Sekolah</a></li>
      <li><a class="nav-link" href="dashboard_login.php"><i data-lucide="users"></i> Data Login</a></li>
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
        <a href="dashboard_profil_sekolah.php">
<div class="card card-custom p-3 text-center">
          <i data-lucide="school" class="mb-2" style="width: 32px; height: 32px;"></i>
          <h5>Profil Sekolah</h5>
          <p class="text-muted mb-0">Lihat dan kelola informasi sekolah</p>
        </div>
        </a>
        
<a href="dashboard_info_akademik.php">
 <div class="card card-custom p-3 text-center">
          <i data-lucide="graduation-cap" class="mb-2" style="width: 32px; height: 32px;"></i>
          <h5>Info Akademik</h5>
          <p class="text-muted mb-0">Data sarana dan prasarana sekolah</p>
        </div>
        </a>

        <a href="dashboard_fasilitas.php">
 <div class="card card-custom p-3 text-center">
          <i data-lucide="building-2" class="mb-2" style="width: 32px; height: 32px;"></i>
          <h5>Fasilitas</h5>
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
      <br>
      <div class="chart-container card card-custom p-3 text-center" style="width: 75%; margin: auto;">
    <canvas id="ptkPdChart"></canvas>
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

    // Meneruskan data dari PHP ke variabel JavaScript
    const labels = <?php echo json_encode($labels); ?>;
    const dataGuru = <?php echo json_encode($data_guru); ?>;
    const dataTendik = <?php echo json_encode($data_tendik); ?>;
    const dataPTK = <?php echo json_encode($data_ptk); ?>;

const ctx = document.getElementById('ptkPdChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar', // Jenis chart: Bar Chart
        data: {
            labels: labels, // Label: Laki-laki, Perempuan
            datasets: [
                {
                    label: 'Jumlah Guru',
                    data: dataGuru,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)', // Biru
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Jumlah Tendik',
                    data: dataTendik,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)', // Merah
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Total PTK',
                    data: dataPTK,
                    backgroundColor: 'rgba(75, 192, 192, 0.8)', // Hijau
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Orang'
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Perbandingan Tenaga Pendidik (PTK) Berdasarkan Jenis Kelamin'
                }
            }
        }
    });
  </script>

</body>
</html>
