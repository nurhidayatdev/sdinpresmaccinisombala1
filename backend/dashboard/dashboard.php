<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['email'])) {
  header("Location: ../../index.php");
  exit();
}

$nama = $_SESSION['nama'];
$email = $_SESSION['email'];

$sql_ptk = "SELECT uraian, guru, tendik, ptk FROM ptk_pd WHERE uraian IN ('Laki - Laki', 'Perempuan')";
$result_ptk = $koneksi->query($sql_ptk);

$labels_ptk = [];
$data_guru = [];
$data_tendik = [];
$data_ptk = [];

if ($result_ptk->num_rows > 0) {
  while ($row_ptk = $result_ptk->fetch_assoc()) {
    $labels_ptk[] = $row_ptk['uraian'];

    $data_guru[] = (int)$row_ptk['guru'];
    $data_tendik[] = (int)$row_ptk['tendik'];
    $data_ptk[] = (int)$row_ptk['ptk'];
  }
}

$sql_sp = "SELECT uraian, jumlah FROM sarpras WHERE uraian != 'TOTAL'";
$result_sp = $koneksi->query($sql_sp);

$labels_sp = [];
$data_jumlah = [];

if ($result_sp->num_rows > 0) {
  while ($row_sp = $result_sp->fetch_assoc()) {
    $labels_sp[] = $row_sp['uraian'];
    $data_jumlah[] = (int)$row_sp['jumlah'];
  }
}

$sql_rm = "SELECT kelas, 
        SUM(CASE WHEN detail = 'L' THEN jumlah ELSE 0 END) AS laki,
        SUM(CASE WHEN detail = 'P' THEN jumlah ELSE 0 END) AS perempuan
        FROM rombongan_mengajar
        GROUP BY kelas";
$result_rm = $koneksi->query($sql_rm);

$labels_kelas = [];
$data_laki = [];
$data_perempuan = [];

if ($result_rm->num_rows > 0) {
  while ($row_rm = $result_rm->fetch_assoc()) {
    $labels_kelas[] = $row_rm['kelas'];
    $data_laki[] = (int)$row_rm['laki'];
    $data_perempuan[] = (int)$row_rm['perempuan'];
  }
}
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      <li><a class="nav-link active" href="#"><i data-lucide="grid"></i> Dashboard</a></li>
      <li><a class="nav-link" href="dashboard_profil.php"><i data-lucide="school"></i> Profil</a></li>
      <li><a class="nav-link" href="dashboard_akademik.php"><i data-lucide="graduation-cap"></i> Akademik</a></li>
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
      <h5 class="fw-bold mb-3">Dashboard Utama</h5>

      <div class="dashboard-cards">
        <a href="dashboard_profil.php">
          <div class="card card-custom p-3 text-center">
            <i data-lucide="school" class="mb-2" style="width: 32px; height: 32px;"></i>
            <h5>Profil</h5>
            <p class="text-muted mb-0">Lihat dan kelola informasi sekolah</p>
          </div>
        </a>

        <a href="dashboard_akademik.php">
          <div class="card card-custom p-3 text-center">
            <i data-lucide="book-open-text" class="mb-2" style="width: 32px; height: 32px;"></i>
            <h5>Akademik</h5>
            <p class="text-muted mb-0">Kelola data guru dan siswa</p>
          </div>
        </a>

        <a href="dashboard_user.php">
          <div class="card card-custom p-3 text-center">
            <i data-lucide="users" class="mb-2" style="width: 32px; height: 32px;"></i>
            <h5>User</h5>
            <p class="text-muted mb-0">Kelola akun pengguna sistem</p>
          </div>
        </a>
      </div>
      <br>
      <div class="my-4">
        <div class="row g-4 justify-content-center">

          <div class="col-12 col-lg-8">
            <div class="chart-container card card-custom p-3 text-center mx-auto">
              <canvas id="ptkChart"></canvas>
            </div>
          </div>

          <div class="col-12 col-lg-4">
            <div class="chart-container card card-custom p-3 text-center mx-auto">
              <canvas id="spChart"></canvas>
            </div>
          </div>
          <div class="col-12">
            <div class="chart-container card card-custom p-3 text-center mx-auto">
              <canvas id="rombonganChart"></canvas>
            </div>
          </div>

        </div>
      </div>

    </div>

    </div>
<p class="text-center mb-0">
                © 2025 SD Inpres Maccini Sombala 1 — All Rights Reserved
            </p>
  </main>

  <script>
    lucide.createIcons();

    document.getElementById('toggleSidebar').addEventListener('click', function() {
      const sidebar = document.getElementById('sidebarMenu');
      sidebar.style.display = sidebar.style.display === 'block' ? 'none' : 'block';
    });

    const labels_ptk = <?php echo json_encode($labels_ptk); ?>;
    const dataGuru = <?php echo json_encode($data_guru); ?>;
    const dataTendik = <?php echo json_encode($data_tendik); ?>;
    const dataPTK = <?php echo json_encode($data_ptk); ?>;

    const ctx_ptk = document.getElementById('ptkChart').getContext('2d');

    new Chart(ctx_ptk, {
      type: 'bar',
      data: {
        labels: labels_ptk,
        datasets: [{
            label: 'Jumlah Guru',
            data: dataGuru,
            backgroundColor: '#FFD93D',
            borderColor: '#FFD93D',
            borderWidth: 1
          },
          {
            label: 'Jumlah Tendik',
            data: dataTendik,
            backgroundColor: '#FF6B6B',
            borderColor: '#FF6B6B',
            borderWidth: 1
          },
          {
            label: 'Total PTK',
            data: dataPTK,
            backgroundColor: '#6BCB77',
            borderColor: '#6BCB77',
            borderWidth: 1
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
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

    const labels_sp = <?php echo json_encode($labels_sp); ?>;
    const $data_jumlah = <?php echo json_encode($data_jumlah); ?>;

    const ctx_sp = document.getElementById('spChart').getContext('2d');

    new Chart(ctx_sp, {
      type: 'doughnut',
      data: {
        labels: labels_sp,
        datasets: [{
          label: 'Jumlah Sarpras',
          data: $data_jumlah,
          backgroundColor: [
            '#6BCB77',
            '#FF6B6B',
            '#FFD93D',
            '#F8AE84',
            '#AEDDCD'
          ],
          borderColor: '#fff',
          borderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          title: {
            display: true,
            text: 'Proporsi Sarana dan Prasarana Sekolah'
          },
          legend: {
            position: 'bottom'
          }
        }
      }
    });

    const labelsKelas = <?php echo json_encode($labels_kelas); ?>;
    const dataLaki = <?php echo json_encode($data_laki); ?>;
    const dataPerempuan = <?php echo json_encode($data_perempuan); ?>;

    const ctxRombongan = document.getElementById('rombonganChart').getContext('2d');

    new Chart(ctxRombongan, {
      type: 'bar',
      data: {
        labels: labelsKelas,
        datasets: [{
            label: 'Laki-laki',
            data: dataLaki,
            backgroundColor: '#6BCB77',
            borderColor: '#6BCB77',
            borderWidth: 1
          },
          {
            label: 'Perempuan',
            data: dataPerempuan,
            backgroundColor: '#FFD93D',
            borderColor: '#FFD93D',
            borderWidth: 1
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Jumlah Siswa'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Kelas'
            }
          }
        },
        plugins: {
          title: {
            display: true,
            text: 'Perbandingan Jumlah Siswa Laki-laki & Perempuan per Kelas'
          },
          legend: {
            position: 'top'
          }
        }
      }
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