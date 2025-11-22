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

$role_diizinkan = ['Administrator Utama', 'Admin Publikasi'];
if (!in_array($role, $role_diizinkan)) {
  echo "
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Dashboard - SD Inpres Maccini Sombala 1</title>
    <link rel='icon' href='../img/main/icon.png' />
  <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
    <style>
        body { font-family: 'Poppins', sans-serif !important; }
    </style>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
   Swal.fire({
    title: 'Akses Ditolak',
    text: 'Anda tidak memiliki izin untuk mengakses halaman ini!',
    icon: 'error',
    allowOutsideClick: false,
    allowEscapeKey: false,
    confirmButtonText: 'Kembali'
}).then(() => {
    window.location.href = 'dashboard_akademik.php';
});
</script>
    </body>
    </html>";
  exit;
}

$query = "SELECT * FROM berita";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - SD Inpres Maccini Sombala 1</title>
  <link rel="icon" href="../img/main/icon.png" />
  <link rel="stylesheet" href="../../bootstrap/dist/css/bootstrap.min.css" />
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
      <li><a class="nav-link active" href="dashboard_akademik.php"><i data-lucide="graduation-cap"></i> Akademik</a></li>
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
      <div class="mb-4">
        <h4 class="fw-bold mb-3 text-success">Berita & Pengumuman</h4>
        <div style="display: flex; justify-content: flex-start; margin-bottom: 12px;">
          <a href="../crud/tambah.php?file=berita&tabel=berita" class="btn-db btn-add">
            <i data-lucide="plus"></i> Tambah Data
          </a>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-striped align-middle">
            <thead class="table-success text-center">
              <tr>
                <th width="30px">No</th>
                <th>Judul</th>
                <th>Link YouTube</th>
                <th>Deskripsi</th>
                <th width="100px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $row['judul']; ?></td>
                  <td><?= $row['link_youtube']; ?></td>
                  <td><?= $row['deskripsi']; ?></td>
                  <td class="text-center">
                    <a href="../crud/edit.php?file=berita&tabel=berita&id=<?= $row['id']; ?>"
                      class="btn-db btn-edit mx-2 my-2"><i data-lucide="square-pen"></i></a>
                    <a href="../crud/hapus.php?tabel=berita&id=<?= $row['id']; ?>"

                      class="btn-db btn-del mx-2 my-2"><i data-lucide="trash"></i></a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
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