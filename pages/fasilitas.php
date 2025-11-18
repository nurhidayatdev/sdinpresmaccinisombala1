<?php
include '../koneksi.php';

$query = "SELECT * FROM fasilitas_sekolah";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fasilitas Sekolah - SD Inpres Maccini Sombala 1</title>
    <link rel="icon" href="../backend/img/main/icon.png" />
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css" />
    <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../frontend/style.css" />
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
                            <a class="nav-link " href="../index.php"><i data-lucide="home"></i> Beranda</a>
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
                                <li><a class="dropdown-item" href="kegiatan_akademik.php"><i data-lucide="calendar-check"></i> Kegiatan Akademik</a></li>
                                <li><a class="dropdown-item" href="info_akademik.php"><i data-lucide="clipboard-check"></i> Info Akademik</a></li>
                            </ul>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="#"><i data-lucide="building"></i> Fasilitas Sekolah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="berita.php"><i data-lucide="megaphone"></i> Berita & Pengumuman</a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link "
                                href="tentang-kami.php"><i data-lucide="users"></i> Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../backend/login/login.php"><i data-lucide="log-in"></i> Log In</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-5">
        <section id="fasilitas">
            <h2 class="text-center mb-5 fw-bold" style="color: #446b42">
                Fasilitas Sekolah
            </h2>

            <div class="row g-4">
                <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-12 col-lg-6">
                        <figure
                            class="text-center p-4 rounded shadow-sm"
                            style="background-color: #fffccf">
                            <img src="../backend/img/fasilitas/<?= htmlspecialchars($data['gambar']); ?>"
                                alt="<?= htmlspecialchars($data['fasilitas'] ?? 'Gambar Fasilitas'); ?>"
                                class="img-fluid rounded mb-3" />

                            <figcaption class="text-justify">
                                <b style="color: #f8ae84"><?= $data['fasilitas']; ?>:</b>
                                <?= $data['deskripsi']; ?>
                            </figcaption>
                        </figure>
                    </div>
                <?php } ?>
            </div>
        </section>
    </main>

    <br />
     <footer class="footer-custom mt-5 pt-5">
        <div class="container">

            <div class="row g-4 justify-content-between">


                <div class="col-12 col-md-4">
                    <h5 class="footer-title">Menu</h5>
                    <ul class="footer-menu">
                        <li><a href="../index.php"><i data-lucide="home"></i> Beranda</a></li>
                        <li><a href="kegiatan_akademik.php"><i data-lucide="calendar-check"></i> Kegiatan Akademik</a></li>
                        <li><a href="info_akademik.php"><i data-lucide="clipboard-check"></i> Info Akademik</a></li>
                        <li><a href="#"><i data-lucide="building"></i> Fasilitas Sekolah</a></li>
                        <li><a href="berita.php"><i data-lucide="megaphone"></i> Berita</a></li>
                        <li><a href="tentang-kami.php"><i data-lucide="users"></i> Tentang Kami</a></li>
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