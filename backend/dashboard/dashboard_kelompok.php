<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['email'])) {
  header("Location: ../../index.php");
  exit();
}

$nama = $_SESSION['nama'];
$email = $_SESSION['email'];
$query = "SELECT * FROM kelompok";
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
        <h2 class="fw-bold mb-3 text-success">Data Fasilitas Sekolah</h2>

        <?php mysqli_data_seek($result, 0); ?>
        <div class="fasilitas-sekolah">
          <a href="../crud/tambah.php?file=kelompok&tabel=kelompok&" class="btn btn-success mb-3">+ Tambah Data</a>
          <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
              <thead class="table-success text-center">
                <tr>

                  <th>Nama Lengkap</th>
                  <th>NIM</th>
                  <th>Link Artikel</th>
                  <th>Gambar</th>
                  <th width="150px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                  <tr>


                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['link_artikel']; ?></td>
                    <td>
                      <?php if (!empty($row['gambar'])): ?>
                        <img src="../img/kelompok/<?php echo htmlspecialchars($row['gambar']); ?>"
                          alt="<?php echo htmlspecialchars($row['nama']); ?>"
                          class="img-fluid rounded"
                          style="max-width:150px; height:auto;" />
                      <?php else: ?>
                        <span class="text-muted">Belum ada gambar</span>
                      <?php endif; ?>
                    </td>
                    <td class="text-center">
                      <a href="../crud/edit.php?file=kelompok&tabel=kelompok&id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                      <a href="../crud/hapus.php?tabel=kelompok&id=<?= $row['id']; ?>"
                        onclick="return confirm('Yakin ingin menghapus fasilitas ini?')"
                        class="btn btn-danger btn-sm">Hapus</a>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
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