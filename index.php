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
    <link rel="icon" href="img/main/icon.png" />
    <meta name="title" content="SD Inpres Maccini Sombala 1" />
    <meta name="description" content="© 2025 Kelompok 5" />

    <meta property="og:type" content="website" />
    <meta
        property="og:url"
        content="https://sdinpresmaccinisombala1.vercel.app/" />
    <meta property="og:title" content="SD Inpres Maccini Sombala 1" />
    <meta property="og:description" content="© 2025 Kelompok 5" />
    <meta property="og:image" content="https://iili.io/Kcm85Ov.md.png" />

    <meta property="twitter:card" content="summary_large_image" />
    <meta
        property="twitter:url"
        content="https://sdinpresmaccinisombala1.vercel.app/" />
    <meta property="twitter:title" content="SD Inpres Maccini Sombala 1" />
    <meta property="twitter:description" content="© 2025 Kelompok 5" />
    <meta
        property="twitter:image"
        content="https://iili.io/Kcm85Ov.md.png" />

    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css" />
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">SD Inpres Maccini Sombala 1</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data$data_profil-bs-toggle="collapse"
                    data$data_profil-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="pages/info-akademik.php">Info Akademik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/fasilitas.php">Fasilitas Sekolah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/berita.html">Berita & Pengumuman</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="pages/tentang-kami.html">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="backend/login.php">Login</a>
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
                        src="img/main/icon.png"
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
                    <?php if ($data_profil) : // Memastikan data$data_profil profil sekolah tersedia 
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

    <footer
        class="text-center py-4 mt-5"
        style="background-color: #446b42; color: #fffccf">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <h3 class="fw-bold mb-3" style="color: #f8ae84">
                        Kontak Sekolah
                    </h3>
                    <p class="mb-1">
                        <strong>Email:</strong>
                        <a
                            href="mailto:sdimacsombala1@gmail.com"
                            class="text-decoration-none"
                            style="color: #fffccf">
                            sdimacsombala1@gmail.com
                        </a>
                    </p>
                    <p class="mb-3">Alamat: Jl. Abdul Kadir No. 47</p>
                </div>
                <div
                    class="col-12 col-md-6 d-flex justify-content-center mb-3">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3026.680277990639!2d119.4138257105302!3d-5.185698546535013!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbf1d883543ba69%3A0x421ca8de98e55d1a!2sSD%20Inpres%20Maccini%20Sombala!5e1!3m2!1sid!2sid!4v1758704755958!5m2!1sid!2sid"
                        width="300"
                        height="150"
                        style="
                                border: 2px solid #f8ae84;
                                border-radius: 10px;
                            "
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <hr
                style="border-color: #f8ae84; width: 60%; margin: 15px auto" />
            <p class="mb-0">
                <a
                    href="../index.html"
                    class="text-white text-decoration-none">© 2025 SD Inpres Maccini Sombala 1</a>
            </p>
        </div>
    </footer>

    
</body>

</html>