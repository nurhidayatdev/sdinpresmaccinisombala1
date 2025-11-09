<?php
session_start();
include '../../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['email'])) {
    header("Location: ../../index.php");
    exit();
}

// Ambil dari session
$nama = $_SESSION['nama']; // dari database (bukan input login)
$email = $_SESSION['email'];

$query_mengajar = "SELECT 
    mengajar.*, 
    guru.nama, guru.nip, guru.pangkat_gol 
FROM mengajar
JOIN guru ON mengajar.guru_id = guru.id";
$result_mengajar = mysqli_query($koneksi, $query_mengajar);

$query_pembina = "SELECT 
    pembina_kegiatan.*, 
    guru.nama, guru.nip, guru.pangkat_gol 
FROM pembina_kegiatan
JOIN guru ON pembina_kegiatan.guru_id = guru.id";
$result_pembina = mysqli_query($koneksi, $query_pembina);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SD Inpres Maccini Sombala 1</title>
    <link rel="stylesheet" href="../../bootstrap/dist/css/bootstrap.min.css" />
    <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../style.css" />
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
      <li><a class="nav-link active" href="dashboard_akademik.php"><i data-lucide="graduation-cap"></i> Akademik</a></li>
      <li><a class="nav-link" href="dashboard_user.php"><i data-lucide="users"></i> User</a></li>
      <li><a class="nav-link text-warning" href="../../index.php"><i data-lucide="log-out"></i> Log Out</a></li>
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
            <div class="container mb-5">
                <h2 class="fw-bold mb-3 text-success">Data Info Akademik</h2>

                <div class="pembagian-tugas-mengajar mb-3">

                    <h4 class="fw-bold mb-3 text-success text-warning">Pembagian Tugas Mengajar</h4>
                    <a href="../crud/tambah.php?file=kegiatan_akademik&tabel=mengajar" class="btn btn-success mb-3">+ Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Pangkat/Gol.</th>
                                    <th>Jenis PTK</th>
                                    <th>Kelas/Mapel yang Diajar</th>
                                    <th>Jumlah JTM/Minggu</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data_mengajar = mysqli_fetch_assoc($result_mengajar)) : ?>
                                    <tr>
                                        <td><?= $data_mengajar['id']; ?></td>
                                        <td><?= $data_mengajar['nama']; ?></td>
                                        <td><?= $data_mengajar['nip']; ?></td>
                                        <td><?= $data_mengajar['pangkat_gol']; ?></td>
                                        <td><?= $data_mengajar['jenis_ptk']; ?></td>
                                        <td><?= $data_mengajar['kelas_mapel']; ?></td>
                                        <td><?= $data_mengajar['jtm_per_minggu']; ?></td>
                                        <td class="text-center">
                                            <a href="../crud/edit.php?file=kegiatan_akademik&tabel=mengajar&id=<?= $data_mengajar['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                            <a href="../crud/hapus.php?tabel=mengajar&id=<?= $data_mengajar['id']; ?>"
                                                onclick="return confirm('Yakin ingin menghapus data siswa ini?')"
                                                class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="pembagian-tugas-pembina-kegiatan mb-3">

                    <h4 class="fw-bold mb-3 text-success text-warning">Pembagian Tugas Pembina Kegiatan</h4>
                    <a href="../crud/tambah.php?file=kegiatan_akademik&tabel=pembina_kegiatan" class="btn btn-success mb-3">+ Tambah Data</a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Pangkat/Gol.</th>
                                    <th>Tugas Pembinaan</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data_pembina = mysqli_fetch_assoc($result_pembina)) : ?>
                                    <tr>
                                        <td><?= $data_pembina['id']; ?></td>
                                        <td><?= $data_pembina['nama']; ?></td>
                                        <td><?= $data_pembina['nip']; ?></td>
                                        <td><?= $data_pembina['pangkat_gol']; ?></td>
                                        <td><?= $data_pembina['tugas_pembinaan']; ?></td>
                                        <td class="text-center">
                                            <a href="../crud/edit.php?file=kegiatan_akademik&tabel=pembina_kegiatan&id=<?= $data_pembina['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                            <a href="../crud/hapus.php?tabel=pembina_kegiatan&id=<?= $data_pembina['id']; ?>"
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