<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['email'])) {
  header("Location: ../../index.php");
  exit();
}

$nama = $_SESSION['nama'];
$email = $_SESSION['email'];
$role = $_SESSION['role'];

$sql_ptk = "SELECT uraian, guru, tendik FROM ptk_pd WHERE uraian IN ('Laki - Laki', 'Perempuan')";
$result_ptk = $koneksi->query($sql_ptk);

$labels_ptk = [];
$data_guru = [];
$data_tendik = [];

if ($result_ptk->num_rows > 0) {
  while ($row_ptk = $result_ptk->fetch_assoc()) {
    $labels_ptk[] = $row_ptk['uraian'];

    $data_guru[] = (int)$row_ptk['guru'];
    $data_tendik[] = (int)$row_ptk['tendik'];
  }
}

$total_ptk = mysqli_query($koneksi, "
    SELECT 
        SUM(ptk) AS total_ptk,
        SUM(pd) AS total_pd
    FROM ptk_pd
");
$total_ptk = mysqli_fetch_assoc($total_ptk);

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

$total_sarpras = mysqli_query($koneksi, "
    SELECT 
        SUM(jumlah) AS total_sarpras
    FROM sarpras
");
$total_sarpras = mysqli_fetch_assoc($total_sarpras);


$sql_rm = "SELECT kelas, laki_laki, perempuan FROM rombongan_mengajar ORDER BY kelas ASC";
$result_rm = $koneksi->query($sql_rm);

$labels_kelas = [];
$data_laki = [];
$data_perempuan = [];
$data_total = [];

if ($result_rm->num_rows > 0) {
  while ($row = $result_rm->fetch_assoc()) {
    $labels_kelas[] = $row['kelas'];
    $data_laki[] = (int)$row['laki_laki'];
    $data_perempuan[] = (int)$row['perempuan'];
    $data_total[] = (int)$row['laki_laki'] + (int)$row['perempuan'];
  }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - SD Inpres Maccini Sombala 1</title>
  <link rel="icon" href="../img/main/icon.png" />
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

    <div class="content mt-4">
      <h5 class="fw-bold mb-3">Dashboard Utama</h5>

      <div class="dashboard-cards">
        <div class="card card-custom p-3 text-center">
          <i data-lucide="users" class="mb-2" style="width: 32px; height: 32px;"></i>
          <h5><?= $total_ptk['total_ptk']; ?></h5>
          <p class="text-muted mb-0">Pendidik dan Tenaga Kependidikan</p>
        </div>

        <div class="card card-custom p-3 text-center">
          <i data-lucide="graduation-cap" class="mb-2" style="width: 32px; height: 32px;"></i>
          <h5><?= $total_ptk['total_pd']; ?></h5>
          <p class="text-muted mb-0">Peserta Didik</p>
        </div>

        <div class="card card-custom p-3 text-center">
          <i data-lucide="building-2" class="mb-2" style="width: 32px; height: 32px;"></i>
          <h5><?= $total_sarpras['total_sarpras']; ?></h5>
          <p class="text-muted mb-0">Sarana dan Prasarana</p>
        </div>
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
          <div class="col-12 col-lg-12">
            <div class="chart-container card card-custom p-3 text-center mx-auto">
              <canvas id="rombonganChart"></canvas>
            </div>
          </div>
          <div class="col-12 col-lg-12">
            <div class="chart-container card card-custom p-3 text-center mx-auto">
              <canvas id="kelasChart"></canvas>
            </div>
          </div>

        </div>
      </div>

    </div>

    </div>
    <p class="fdb text-center mb-0">
      © 2025 SD Inpres Maccini Sombala 1 — All Rights Reserved
    </p>
  </main>

  <script>
    lucide.createIcons();

    document.getElementById('toggleSidebar').addEventListener('click', function() {
      const sidebar = document.getElementById('sidebarMenu');
      sidebar.style.display = sidebar.style.display === 'block' ? 'none' : 'block';
    });

    Chart.defaults.color = "#000";
    Chart.defaults.font.family = "Poppins";

    const labels_ptk = <?php echo json_encode($labels_ptk); ?>;
    const dataGuru = <?php echo json_encode($data_guru); ?>;
    const dataTendik = <?php echo json_encode($data_tendik); ?>;

    const ctx_ptk = document.getElementById('ptkChart').getContext('2d');

    new Chart(ctx_ptk, {
      type: 'bar',
      data: {
        labels: labels_ptk,
        datasets: [{
            label: 'Jumlah Guru',
            data: dataGuru,
            backgroundColor: '#FFD93D',
            hoverBackgroundColor: 'rgba(255, 217, 61, 0.3)',
            borderColor: '#FFD93D',
            borderWidth: 1
          },
          {
            label: 'Jumlah Tendik',
            data: dataTendik,
            backgroundColor: '#FF6B6B',
            hoverBackgroundColor: 'rgba(255, 107, 107, 0.3)',
            borderColor: '#FF6B6B',
            borderWidth: 2
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
          hoverBackgroundColor: [
            'rgba(107, 203, 119, 0.3)',
            'rgba(255, 107, 107, 0.3)',
            'rgba(255, 217, 61, 0.3)',
            'rgba(248, 174, 132, 0.3)',
            'rgba(174, 221, 205, 0.3)'
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
    const dataTotal = <?php echo json_encode($data_total); ?>;

    const ctxRombongan = document.getElementById('rombonganChart').getContext('2d');

    new Chart(ctxRombongan, {
      type: 'bar',
      data: {
        labels: labelsKelas,
        datasets: [{
            label: 'Laki-laki',
            data: dataLaki,
            backgroundColor: '#6BCB77',
            hoverBackgroundColor: 'rgba(107, 203, 119, 0.3)',
            borderColor: '#6BCB77',
            borderWidth: 1
          },
          {
            label: 'Perempuan',
            data: dataPerempuan,
            backgroundColor: '#FFD93D',
            hoverBackgroundColor: 'rgba(255, 217, 61, 0.3)',
            borderColor: '#FFD93D',
            borderWidth: 2
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

    const ctxKelas = document.getElementById('kelasChart');

    new Chart(ctxKelas, {
      type: 'line',
      data: {
        labels: labelsKelas,
        datasets: [{
          label: 'Total',
          data: dataTotal,
          borderColor: '#FFD93D',
          backgroundColor: 'rgba(255, 217, 61, 0.3)',
          tension: 0.3,
          fill: true,
          borderWidth: 2
        }]
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
            },
            min: 45,
            max: 75
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
            text: 'Perkembangan Jumlah Siswa per Kelas'
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