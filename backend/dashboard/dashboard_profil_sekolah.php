<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../../index.php");
    exit();
}

$nama = $_SESSION['nama'];
$email = $_SESSION['email'];

$query_profil = "SELECT * FROM profil_sekolah";
$result_profil = mysqli_query($koneksi, $query_profil);
$data_profil = mysqli_fetch_assoc($result_profil);

$query_visi = "SELECT * FROM visi";
$result_visi = mysqli_query($koneksi, $query_visi);
$data_visi = mysqli_fetch_assoc($result_visi);

$query_misi = "SELECT * FROM misi";
$result_misi = mysqli_query($koneksi, $query_misi);

$query_tujuan = "SELECT * FROM tujuan";
$result_tujuan = mysqli_query($koneksi, $query_tujuan);
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
            <li><a class="nav-link active" href="dashboard_profil.php"><i data-lucide="school"></i> Profil</a></li>
            <li><a class="nav-link" href="dashboard_akademik.php"><i data-lucide="graduation-cap"></i> Akademik</a></li>
            <li><a class="nav-link" href="dashboard_user.php"><i data-lucide="users"></i> User</a></li>
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
                <h2 class="fw-bold mb-3 text-success">Data Profil Sekolah</h2>

                <div class="identitas-sekolah">
                    <h4 class="fw-bold mb-3 text-success text-warning">Identitas Sekolah</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                    <th>Nama Sekolah</th>
                                    <th>NPSN</th>
                                    <th>Jenjang</th>
                                    <th>Status Sekolah</th>
                                    <th>Alamat</th>
                                    <th>Kecamatan</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Provinsi</th>
                                    <th>Negara</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><?= $data_profil['nama_sekolah']; ?></td>
                                    <td><?= $data_profil['npsn']; ?></td>
                                    <td><?= $data_profil['jenjang']; ?></td>
                                    <td><?= $data_profil['status_sekolah']; ?></td>
                                    <td><?= $data_profil['alamat']; ?></td>
                                    <td><?= $data_profil['kecamatan']; ?></td>
                                    <td><?= $data_profil['kabupaten']; ?></td>
                                    <td><?= $data_profil['provinsi']; ?></td>
                                    <td><?= $data_profil['negara']; ?></td>
                                    <td class="text-center">
                                        <a href="../crud/edit.php?file=profil_sekolah&tabel=profil_sekolah&id=1&bagian=identitas" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="data-pelengkap">
                    <h4 class="fw-bold mb-3 text-success text-warning">Data Pelengkap</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                    <th>SK Pendirian Sekolah</th>
                                    <th>Tanggal SK Pendirian</th>
                                    <th>Status Kepemilikan</th>
                                    <th>Kebutuhan Khusus Dilayani</th>
                                    <th>Nama Bank</th>
                                    <th>Cabang</th>
                                    <th>Rekening Atas Nama</th>
                                    <th>NPWP</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><?= $data_profil['sk_pendirian']; ?></td>
                                    <td><?= $data_profil['tanggal_sk']; ?></td>
                                    <td><?= $data_profil['status_kepemilikan']; ?></td>
                                    <td><?= $data_profil['kebutuhan_khusus']; ?></td>
                                    <td><?= $data_profil['nama_bank']; ?></td>
                                    <td><?= $data_profil['cabang_bank']; ?></td>
                                    <td><?= $data_profil['rekening_atas_nama']; ?></td>
                                    <td><?= $data_profil['npwp']; ?></td>
                                    <td class="text-center">
                                        <a href="../crud/edit.php?file=profil_sekolah&tabel=profil_sekolah&id=1&bagian=pelengkap" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="data-lainnya">
                    <h4 class="fw-bold mb-3 text-success text-warning">Data Lainnya</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                    <th>Kepala Sekolah</th>
                                    <th>Operator</th>
                                    <th>Akreditasi</th>
                                    <th>Kurikulum</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><?= $data_profil['kepala_sekolah']; ?></td>
                                    <td><?= $data_profil['operator']; ?></td>
                                    <td><?= $data_profil['akreditasi']; ?></td>
                                    <td><?= $data_profil['kurikulum']; ?></td>
                                    <td class="text-center">
                                        <a href="../crud/edit.php?file=profil_sekolah&tabel=profil_sekolah&id=1&bagian=lainnya" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="data-visi">
                    <h4 class="fw-bold mb-3 text-success text-warning">Data Visi</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                    <th>Visi</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><?= $data_visi['pernyataan_visi']; ?></td>
                                    <td class="text-center">
                                        <a href="../crud/edit.php?file=profil_sekolah&tabel=visi&id=<?= $data_visi['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="data-misi">
                    <h4 class="fw-bold mb-3 text-success text-warning">Data Misi</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                    <th>Misi</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data_misi = mysqli_fetch_assoc($result_misi)) : ?>
                                    <tr>
                                        <td><?= $data_misi['pernyataan_misi']; ?></td>
                                        <td class="text-center">
                                            <a href="../crud/edit.php?file=profil_sekolah&tabel=misi&id=<?= $data_misi['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="data-tujuan">
                    <h4 class="fw-bold mb-3 text-success text-warning">Data Tujuan</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-success text-center">
                                <tr>
                                    <th>Tujuan</th>
                                    <th width="150px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data_tujuan = mysqli_fetch_assoc($result_tujuan)) : ?>
                                    <tr>
                                        <td><?= $data_tujuan['pernyataan_tujuan']; ?></td>
                                        <td class="text-center">
                                            <a href="../crud/edit.php?file=profil_sekolah&tabel=tujuan&id=<?= $data_tujuan['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
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