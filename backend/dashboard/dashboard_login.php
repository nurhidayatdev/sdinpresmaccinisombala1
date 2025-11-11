<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['email'])) {
  header("Location: ../index.php");
  exit();
}

$nama = $_SESSION['nama']; 
$email = $_SESSION['email'];

$query = "SELECT * FROM login";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - SD Inpres Maccini Sombala 1</title>
  <link rel="stylesheet" href="../../bootstrap/dist/css/bootstrap.min.css" />
  <script src="../../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../../style.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

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
      <li><a class="nav-link active" href="dashboard_user.php"><i data-lucide="users"></i> User</a></li>
      <li><a class="nav-link text-danger" href="../../index.php"><i data-lucide="log-out"></i> Log Out</a></li>
    </ul>
  </nav>

  <main id="mainContent">
    <div class="topbar shadow-sm">

      <div class="welcome-text">Selamat datang, <strong><?= htmlspecialchars($nama) ?></strong> 👋</div>
      <button class="toggle-sidebar-btn d-lg-none" id="toggleSidebar">
        <i data-lucide="menu"></i>
      </button>
    </div>

    <div class="container-fluid mt-4">
      <div class="container mb-5">
        <h2 class="fw-bold mb-3 text-success">Data Login Siswa</h2>


        <a href="../crud/tambah.php?tabel=login" class="btn btn-success mb-3">+ Tambah Data</a>
        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle">
            <thead class="table-success text-center">
              <tr>
                <th>Email</th>
                <th>Password</th>
                <th>Nama Lengkap</th>
                <th width="150px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td><?= $row['email']; ?></td>
                  <td><?= md5($row['password']); ?></td>
                  <td><?= $row['nama']; ?></td>
                  <td class="text-center">
                    <a href="../crud/edit.php?file=login&tabel=login&id=<?= $row['id']; ?>"
                      class="btn btn-warning btn-sm">Edit</a>
                    <a href="../crud/hapus.php?tabel=login&id=<?= $row['id']; ?>"
                      onclick="return confirm('Yakin ingin menghapus data siswa ini?')"
                      class="btn btn-danger btn-sm">Hapus</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  <script>
    lucide.createIcons();

    document.getElementById('toggleSidebar').addEventListener('click', function() {
      const sidebar = document.getElementById('sidebarMenu');
      sidebar.style.display = sidebar.style.display === 'block' ? 'none' : 'block';
    });
  </script>

</body>

</html>