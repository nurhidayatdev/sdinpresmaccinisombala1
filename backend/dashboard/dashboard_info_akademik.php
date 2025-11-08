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

$query_ptk = "SELECT * FROM ptk_pd";
$result_ptk = mysqli_query($koneksi, $query_ptk);

$query_sarpras = "SELECT * FROM sarpras";
$result_sarpras = mysqli_query($koneksi, $query_sarpras);

$query_rombongan = "SELECT * FROM rombongan_mengajar";
$result_rombongan = mysqli_query($koneksi, $query_rombongan);

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

                

                <div class="ptk-pd mb-3">

                    <h4 class="fw-bold mb-3 text-success text-warning">Data PTK PD</h4>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                  
                                    <th>Uraian</th>
                                    <th>Guru</th>
                                    <th>Tendik</th>
                                    <th>PTK</th>
                                    <th>PD</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data_ptk = mysqli_fetch_assoc($result_ptk)) : ?>
                                    <tr>
                                     
                                        <td><?= $data_ptk['uraian']; ?></td>
                                        <td><?= $data_ptk['guru']; ?></td>
                                        <td><?= $data_ptk['tendik']; ?></td>
                                        <td><?= $data_ptk['ptk']; ?></td>
                                        <td><?= $data_ptk['pd']; ?></td>
                                        <td class="text-center">
                                            <a href="../crud/edit.php?file=info-akademik&tabel=ptk_pd&id=<?= $data_ptk['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                            
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="sarpras mb-3">

                    <h4 class="fw-bold mb-3 text-success text-warning">Data Sarana dan Prasarana</h4>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                  
                                    <th>Uraian</th>
                                    <th>Jumlah</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data_sarpras = mysqli_fetch_assoc($result_sarpras)) : ?>
                                    <tr>
                                     
                                        <td><?= $data_sarpras['uraian']; ?></td>
                                        <td><?= $data_sarpras['jumlah']; ?></td>
                                       
                                        <td class="text-center">
                                            <a href="../crud/edit.php?file=info-akademik&tabel=sarpras&id=<?= $data_sarpras['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                           
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="rombongan mb-3">

                    <h4 class="fw-bold mb-3 text-success text-warning">Data Rombongan Mengajar</h4>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                  
                                    <th>Kelas</th>
                                    <th>Detail</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data_rombongan = mysqli_fetch_assoc($result_rombongan)) : ?>
                                    <tr>
                                     
                                        <td><?= $data_rombongan['kelas']; ?></td>
                                        <td><?= $data_rombongan['detail']; ?></td>
                                        <td><?= $data_rombongan['jumlah']; ?></td>
                                        <td><?= $data_rombongan['total']; ?></td>
                                       
                                        <td class="text-center">
                                            <a href="../crud/edit.php?file=info-akademik&tabel=rombongan&id=<?= $data_rombongan['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                           
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