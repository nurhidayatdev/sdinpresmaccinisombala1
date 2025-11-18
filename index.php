<?php
include 'koneksi.php';

$query_profil = "SELECT * FROM profil_sekolah LIMIT 1";
$result_profil = mysqli_query($koneksi, $query_profil);
$data_profil = mysqli_fetch_assoc($result_profil);

$query_visi = "SELECT pernyataan_visi FROM visi LIMIT 1";
$result_visi = mysqli_query($koneksi, $query_visi);
$data_visi = mysqli_fetch_assoc($result_visi);

$query_misi = "SELECT pernyataan_misi FROM misi";
$result_misi = mysqli_query($koneksi, $query_misi);
$data_misi = mysqli_fetch_assoc($result_misi);

$query_tujuan = "SELECT pernyataan_tujuan FROM tujuan";
$result_tujuan = mysqli_query($koneksi, $query_tujuan);
$data_tujuan = mysqli_fetch_assoc($result_tujuan);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SD Inpres Maccini Sombala 1</title>
    <link rel="icon" href="backend/img/main/icon.png" />
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css" />
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="frontend/style.css" />
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">SD Inpres Maccini Sombala 1</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i data-lucide="home"></i> Beranda</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="infoAkademikDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i data-lucide="graduation-cap"></i> Akademik
                            </a>
                            <ul class="dropdown-menu custom-dropdown" aria-labelledby="infoAkademikDropdown">
                                <li><a class="dropdown-item" href="pages/kegiatan_akademik.php"><i data-lucide="calendar-check"></i> Kegiatan Akademik</a></li>
                                <li><a class="dropdown-item" href="pages/info_akademik.php"><i data-lucide="clipboard-check"></i> Info Akademik</a></li>
                            </ul>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="pages/fasilitas.php"><i data-lucide="building"></i> Fasilitas Sekolah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/berita.php"><i data-lucide="megaphone"></i> Berita & Pengumuman</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="pages/tentang-kami.php"><i data-lucide="users"></i> Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="backend/login/login.php"><i data-lucide="log-in"></i> Log In</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-5">
        <div class="container">
            <section
                id="beranda"
                class="text-center mb-5 row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="fw-bold">SD Inpres Maccini Sombala 1</h1>
                    <img
                        src="backend/img/main/icon.png"
                        alt="Logo SD Inpres Maccini Sombala 1"
                        class="img-fluid my-3"
                        style="width: 150px" />
                    <p>
                        Selamat datang di website resmi SD Inpres Maccini
                        Sombala 1. Kami berkomitmen untuk memberikan
                        pendidikan dasar yang berkualitas, membentuk
                        karakter, serta membekali siswa dengan ilmu
                        pengetahuan dan keterampilan untuk masa depan.
                    </p>
                </div>
            </section>

            <section id="info-umum" class="mb-5 row">
                <div class="col-lg-12">
                    <h2 class="fw-bold mb-3" style="color: #446b42">
                        Informasi Umum Sekolah
                    </h2>
                    <?php if ($data_profil) :
                    ?>
                        <p>
                            Saat ini UPT SPF SD Inpres Maccini Sombala 1 sudah
                            menggunakan Kurikulum Merdeka, mengikuti aturan
                            pemerintah terkait kurikulum pendidikan. Sekolah ini
                            dipimpin oleh Kepala Sekolah
                            <strong><?= htmlspecialchars($data_profil['kepala_sekolah']); ?></strong> dan operator
                            <strong><?= htmlspecialchars($data_profil['operator']); ?></strong>.
                        </p>
                    <?php endif; ?>
                </div>

                <div class="col-lg-6 mb-4">
                    <div
                        class="card shadow-sm h-100"
                        style="border-color: #f8ae84">
                        <div
                            class="card-header text-white"
                            style="background-color: #446b42">
                            <h5 class="mb-0">Identitas Sekolah</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    <?php if ($data_profil) : ?>
                                        <tr>
                                            <td>Nama Sekolah</td>
                                            <td><?= htmlspecialchars($data_profil['nama_sekolah']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>NPSN</td>
                                            <td><?= htmlspecialchars($data_profil['npsn']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Jenjang Pendidikan</td>
                                            <td><?= htmlspecialchars($data_profil['jenjang']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Sekolah</td>
                                            <td><?= htmlspecialchars($data_profil['status_sekolah']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Sekolah</td>
                                            <td><?= htmlspecialchars($data_profil['alamat']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td><?= htmlspecialchars($data_profil['kecamatan']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kabupaten/Kota</td>
                                            <td><?= htmlspecialchars($data_profil['kabupaten']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Provinsi</td>
                                            <td><?= htmlspecialchars($data_profil['provinsi']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Negara</td>
                                            <td><?= htmlspecialchars($data_profil['negara']); ?></td>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="2">Data identitas sekolah tidak tersedia.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-4">
                    <div
                        class="card shadow-sm h-100"
                        style="border-color: #f8ae84">
                        <div
                            class="card-header text-white"
                            style="background-color: #446b42">
                            <h5 class="mb-0">Data Pelengkap</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    <?php if ($data_profil) : ?>
                                        <tr>
                                            <td>SK Pendirian Sekolah</td>
                                            <td><?= htmlspecialchars($data_profil['sk_pendirian']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal SK Pendirian</td>
                                            <td><?= date('d-m-Y', strtotime($data_profil['tanggal_sk'])); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status Kepemilikan</td>
                                            <td><?= htmlspecialchars($data_profil['status_kepemilikan']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kebutuhan Khusus Dilayani</td>
                                            <td><?= htmlspecialchars($data_profil['kebutuhan_khusus']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Bank</td>
                                            <td><?= htmlspecialchars($data_profil['nama_bank']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Cabang</td>
                                            <td><?= htmlspecialchars($data_profil['cabang_bank']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Rekening Atas Nama</td>
                                            <td><?= htmlspecialchars($data_profil['rekening_atas_nama']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>NPWP</td>
                                            <td><?= htmlspecialchars($data_profil['npwp']); ?></td>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="2">Data pelengkap sekolah tidak tersedia.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div
                        class="card shadow-sm"
                        style="border-color: #f8ae84">
                        <div
                            class="card-header text-white"
                            style="background-color: #446b42">
                            <h5 class="mb-0">Data Lainnya</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    <?php if ($data_profil) : ?>
                                        <tr>
                                            <td>Kepala Sekolah</td>
                                            <td><?= htmlspecialchars($data_profil['kepala_sekolah']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Operator</td>
                                            <td><?= htmlspecialchars($data_profil['operator']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Akreditasi</td>
                                            <td><?= htmlspecialchars($data_profil['akreditasi']); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kurikulum</td>
                                            <td><?= htmlspecialchars($data_profil['kurikulum']); ?></td>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="2">Data lainnya tidak tersedia.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <section id="sejarah" class="mb-5 row">
                <div class="col-lg-12">
                    <h2 class="fw-bold mb-3" style="color: #446b42">
                        Sejarah Sekolah
                    </h2>
                    <p>
                        Sekolah ini dulunya merupakan sekolah dari tanah
                        wakaf masyarakat. Pada tahun 1960-an, sekolah ini
                        diambil alih pemerintah dan menjadi sekolah negeri.
                        Sejak awal berdirinya, sekolah ini dikenal unggul
                        karena menjadi salah satu sekolah pertama di wilayah
                        tersebut.
                    </p>
                </div>
            </section>

            <section id="visi-misi" class="row">
                <div class="col-lg-12">
                    <h2 class="fw-bold mb-3" style="color: #446b42">
                        Visi, Misi dan Tujuan
                    </h2>

                    <div class="mb-3">
                        <h4 style="color: #f8ae84">Visi</h4>
                        <p><?= htmlspecialchars($data_visi['pernyataan_visi']); ?>

                        </p>
                    </div>

                    <div class="mb-3">
                        <h4 style="color: #f8ae84">Misi</h4>
                        <ol>
                            <?php while ($data_misi = mysqli_fetch_assoc($result_misi)) { ?>
                                <li><?= htmlspecialchars($data_misi['pernyataan_misi']); ?></li>
                            <?php } ?>

                        </ol>
                    </div>

                    <div>
                        <h4 style="color: #f8ae84">Tujuan</h4>
                        <ul>
                            <?php while ($data_tujuan = mysqli_fetch_assoc($result_tujuan)) { ?>
                                <li><?= htmlspecialchars($data_tujuan['pernyataan_tujuan']); ?></li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="footer-custom mt-5 pt-5">
    <div class="container">

        <div class="row g-4 justify-content-between">

     
            <div class="col-12 col-md-4">
                <h5 class="footer-title">Menu</h5>
                <ul class="footer-menu">
                    <li><a href="#"><i data-lucide="home"></i> Beranda</a></li>
                    <li><a href="pages/kegiatan_akademik.php"><i data-lucide="calendar-check"></i> Kegiatan Akademik</a></li>
                    <li><a href="pages/info_akademik.php"><i data-lucide="clipboard-check"></i> Info Akademik</a></li>
                    <li><a href="pages/fasilitas.php"><i data-lucide="building"></i> Fasilitas Sekolah</a></li>
                    <li><a href="pages/berita.php"><i data-lucide="megaphone"></i> Berita</a></li>
                    <li><a href="pages/tentang-kami.php"><i data-lucide="users"></i> Tentang Kami</a></li>
                </ul>
            </div>

        
            <div class="col-12 col-md-4">
                <h5 class="footer-title">Kontak Sekolah</h5>

                <p class="footer-text mb-1">
                    <strong>Email:</strong><br>
                    <a href="mailto:sdimacsombala1@gmail.com" class="footer-link">
                        sdimacsombala1@gmail.com
                    </a>
                </p>

                <p class="footer-text mb-1">
                    <strong>Alamat:</strong><br>
                    Jl. Abdul Kadir No. 47
                </p>

                <p class="footer-text mb-0">
                    <strong>Telepon:</strong><br>
                    0821-XXXX-XXXX
                </p>
            </div>

       
            <div class="col-12 col-md-4">
                <h5 class="footer-title">Lokasi Sekolah</h5>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3026.680277990639!2d119.4138257105302!3d-5.185698546535013!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbf1d883543ba69%3A0x421ca8de98e55d1a!2sSD%20Inpres%20Maccini%20Sombala!5e1!3m2!1sid!2sid!4v1758704755958!5m2!1sid!2sid"
                    width="100%"
                    height="170"
                    style="border:2px solid #f8ae84; border-radius:12px;"
                    loading="lazy"
                    allowfullscreen=""
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <hr class="footer-divider">

        <p class="footer-copy text-center mb-0">
            © 2025 SD Inpres Maccini Sombala 1 — All Rights Reserved
        </p>
    </div>
</footer>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>