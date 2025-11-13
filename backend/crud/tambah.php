<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['email'])) {
  header("Location: ../../index.php");
  exit();
}

$nama = $_SESSION['nama'];
$email = $_SESSION['email'];
$tabel = $_GET['tabel'] ?? '';
$file = $_GET['file'] ?? '';

if (!$tabel) {
  die("Parameter tabel tidak ditemukan!");
}

$tabel_diizinkan = ['guru', 'mengajar', 'pembina_kegiatan', 'fasilitas_sekolah', 'berita', 'form_futsal', 'kelompok', 'login'];
if (!in_array($tabel, $tabel_diizinkan)) {
  die("Tabel tidak diizinkan!");
}

if (isset($_POST['tambah'])) {
  switch ($tabel) {
    case 'guru':
      $nama = $_POST['nama'];
      $nip = $_POST['nip'];
      $pangkat_gol = $_POST['pangkat_gol'];
      mysqli_query($koneksi, "INSERT INTO guru (nama, nip, pangkat_gol)
                VALUES ('$nama','$nip','$pangkat_gol')");
      header("Location: ../dashboard/dashboard_guru.php");
      break;

    case 'mengajar':
      $guru_id = $_POST['guru_id'];
      $jenis_ptk = $_POST['jenis_ptk'];
      $kelas_mapel = $_POST['kelas_mapel'];
      $jtm_per_minggu = $_POST['jtm_per_minggu'];
      mysqli_query($koneksi, "INSERT INTO mengajar (guru_id, jenis_ptk, kelas_mapel, jtm_per_minggu)
                VALUES ('$guru_id','$jenis_ptk', '$kelas_mapel', '$jtm_per_minggu')");
      header("Location: ../dashboard/dashboard_kegiatan_akademik.php");
      break;

    case 'pembina_kegiatan':
      $guru_id = $_POST['guru_id'];
      $tugas_pembinaan = $_POST['tugas_pembinaan'];
      mysqli_query($koneksi, "INSERT INTO pembina_kegiatan (guru_id, tugas_pembinaan)
                VALUES ('$guru_id', '$tugas_pembinaan')");
      header("Location: ../dashboard/dashboard_kegiatan_akademik.php");
      break;

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
      header("Location: ../dashboard/dashboard_fasilitas.php");
      break;

    case 'berita':
      $judul = $_POST['judul'];
      $link_youtube = $_POST['link_youtube'];
      $deskripsi = $_POST['deskripsi'];
      $tugas_pembinaan = $_POST['tugas_pembinaan'];
      mysqli_query($koneksi, "INSERT INTO berita (judul, link_youtube, deskripsi)
                VALUES ('$judul','$link_youtube','$deskripsi')");
      header("Location: ../dashboard/dashboard_berita.php");
      break;

    case 'form_futsal':
      $nisn = $_POST['nisn'];
      $nama = $_POST['nama'];
      $kelas = $_POST['kelas'];
      $jk = $_POST['jk'];
      $nohp = $_POST['nohp'];
      $alasan = $_POST['alasan'];
      mysqli_query($koneksi, "INSERT INTO form_futsal (nisn, nama, kelas, jk, nohp, alasan)
                VALUES ('$nisn','$nama','$kelas', '$jk', '$nohp', '$alasan')");
      header("Location: ../dashboard/dashboard_futsal.php");
      break;

    case 'kelompok':
      $nama = $_POST['nama'];
      $nim = $_POST['nim'];
      $link_artikel = $_POST['link_artikel'];
      $gambar = '';
      if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "../img/kelompok/";
        $gambar = time() . "_" . basename($_FILES["gambar"]["name"]);
        $target_file = $target_dir . $gambar;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
      }
      mysqli_query($koneksi, "INSERT INTO kelompok (gambar, nama, nim, link_artikel)
                VALUES ('$gambar','$nama','$nim', '$link_artikel')");
      header("Location: ../dashboard/dashboard_kelompok.php");
      break;

    case 'login':
      $nama = $_POST['nama'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      mysqli_query($koneksi, "INSERT INTO login (nama, email, password)
                VALUES ('$nama','$email','$password')");
      header("Location: ../dashboard/dashboard_login.php");
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
  <link rel="stylesheet" href="../../bootstrap/dist/css/bootstrap.min.css" />
  <script src="../../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../../frontend/style.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
      <li><a class="nav-link " href="../dashboard/dashboard.php"><i data-lucide="grid"></i> Dashboard</a></li>
      <li><a class="nav-link" href="../dashboard/dashboard_profil.php"><i data-lucide="school"></i> Profil</a></li>
      <li><a class="nav-link active" href="../dashboard/dashboard_akademik.php"><i data-lucide="graduation-cap"></i> Akademik</a></li>
      <li><a class="nav-link" href="../dashboard/dashboard_user.php"><i data-lucide="users"></i> User</a></li>
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
      <div class="container">
        <h2 class="fw-bold mb-3 text-success">
          Tambah Data <?= ucwords(str_replace('_', ' ', $tabel)); ?>
        </h2>
        <form method="POST" enctype="multipart/form-data">

          <?php if ($tabel === 'guru'): ?>
            <div class="mb-3"><label>Nama</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3"><label>NIP</label>
              <input type="number" name="nip" class="form-control" required>
            </div>
            <div class="mb-3"><label>Pangkat/Gol.</label>
              <input type="text" name="pangkat_gol" class="form-control" required>
            </div>

          <?php elseif ($tabel === 'mengajar'): ?>
            <div class="mb-3">
              <label>Guru</label>
              <select name="guru_id" class="form-select" required>
                <option value="">-- Pilih Guru --</option>
                <?php
                $query_guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama ASC");
                while ($guru = mysqli_fetch_assoc($query_guru)) {
                  echo "<option value='{$guru['id']}'>{$guru['nama']} - {$guru['nip']} ({$guru['pangkat_gol']})</option>";
                }
                ?>
              </select>
            </div>

            <div class="mb-3">
              <label>Jenis PTK</label>
              <input type="text" name="jenis_ptk" class="form-control" required>
            </div>

            <div class="mb-3">
              <label>Kelas Mapel</label>
              <input type="text" name="kelas_mapel" class="form-control" required>
            </div>

            <div class="mb-3">
              <label>JTM Per Minggu</label>
              <input type="number" name="jtm_per_minggu" class="form-control" required>
            </div>

          <?php elseif ($tabel === 'pembina_kegiatan'): ?>
            <div class="mb-3">
              <label>Guru</label>
              <select name="guru_id" class="form-select" required>
                <option value="">-- Pilih Guru --</option>
                <?php
                $query_guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama ASC");
                while ($guru = mysqli_fetch_assoc($query_guru)) {
                  echo "<option value='{$guru['id']}'>{$guru['nama']} - {$guru['nip']} ({$guru['pangkat_gol']})</option>";
                }
                ?>
              </select>
            </div>

            <div class="mb-3">
              <label>Tugas Pembinaan</label>
              <input type="text" name="tugas_pembinaan" class="form-control" required>
            </div>



          <?php elseif ($tabel === 'fasilitas_sekolah'): ?>
            <div class="mb-3"><label>Nama Fasilitas</label>
              <input type="text" name="fasilitas" class="form-control" required>
            </div>
            <div class="mb-3"><label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
              <label>Upload Gambar</label>
              <input type="file" name="gambar" class="form-control" accept="image/*">
            </div>

          <?php elseif ($tabel === 'berita'): ?>
            <div class="mb-3"><label>Judul</label>
              <input type="text" name="judul" class="form-control" required>
            </div>
            <div class="mb-3"><label>Link YouTube</label>
              <input type="text" name="link_youtube" class="form-control" required>
            </div>
            <div class="mb-3"><label>Deskripsi</label>
              <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
            </div>

          <?php elseif ($tabel === 'form_futsal'): ?>
            <div class="mb-3"><label>NISN</label>
              <input type="number" name="nisn" class="form-control" required>
            </div>
            <div class="mb-3"><label>Nama Lengkap</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Kelas</label>
              <select name="kelas" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="Kelas 4">Kelas 4</option>
                <option value="Kelas 5">Kelas 5</option>
                <option value="Kelas 6">Kelas 6</option>
              </select>
            </div>
            <div class="mb-3">
              <label>Jenis Kelamin</label>
              <select name="jk" class="form-control" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
            <div class="mb-3"><label>No HP</label>
              <input type="number" name="nohp" class="form-control" required>
            </div>
            <div class="mb-3"><label>Alasan Daftar</label>
              <textarea name="alasan" class="form-control" rows="4" required></textarea>
            </div>


          <?php elseif ($tabel === 'kelompok'): ?>
            <div class="mb-3"><label>Nama Lengkap</label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3"><label>NIM</label>
              <input type="number" name="nim" class="form-control" required>
            </div>
            <div class="mb-3"><label>Link Artikel</label>
              <input type="text" name="link_artikel" class="form-control" required>
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
          <a href="../dashboard/dashboard_<?= $file; ?>.php" class="btn btn-secondary">Kembali</a>
        </form>
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