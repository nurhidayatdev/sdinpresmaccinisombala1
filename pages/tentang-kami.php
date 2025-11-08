<?php
include '../koneksi.php';

$query = "SELECT * FROM kelompok";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Tentang Kami</title>
        <link rel="icon" href="../backend/img/main/icon.png" />
        <meta name="title" content="SD Inpres Maccini Sombala 1" />
        <meta name="description" content="© 2025 Kelompok 5" />
        <meta property="og:type" content="website" />
        <meta
            property="og:url"
            content="https://sdinpresmaccinisombala1.vercel.app/"
        />
        <meta property="og:title" content="SD Inpres Maccini Sombala 1" />
        <meta property="og:description" content="© 2025 Kelompok 5" />
        <meta property="og:image" content="https://iili.io/Kcm85Ov.md.png" />

        <meta property="twitter:card" content="summary_large_image" />
        <meta
            property="twitter:url"
            content="https://sdinpresmaccinisombala1.vercel.app/"
        />
        <meta property="twitter:title" content="SD Inpres Maccini Sombala 1" />
        <meta property="twitter:description" content="© 2025 Kelompok 5" />
        <meta
            property="twitter:image"
            content="https://iili.io/Kcm85Ov.md.png"
        />
        <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css" />
        <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../style.css" />
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
                <div class="container">
                    <a class="navbar-brand fw-bold" href="#"
                        >SD Inpres Maccini Sombala 1</a
                    >
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarNav"
                        aria-controls="navbarNav"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link " href="../index.php"
                                    >Beranda</a
                                >
                            </li>
                            <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="infoAkademikDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Akademik
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="infoAkademikDropdown">
                                <li><a class="dropdown-item" href="kegiatan_akademik.php">Kegiatan Akademik</a></li>
                                <li><a class="dropdown-item" href="info_akademik.php">Info Akademik</a></li>
                            </ul>
                        </li>
                            <li class="nav-item">
                                <a class="nav-link" href="fasilitas.php"
                                    >Fasilitas Sekolah</a
                                >
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="berita.php"
                                    >Berita & Pengumuman</a
                                >
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Tentang Kami</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="../backend/login/login.php">Login</a>
                        </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-5">
            <section id="about" class="container text-center">
                <h2 class="mb-4 fw-bold" style="color: #446b42">
                    Tentang Kami
                </h2>

                <figure>
                    <img
                        src="../img/kelompok/pictkelompok.jpg"
                        alt="Foto Kelompok"
                        class="img-fluid rounded shadow"
                    />
                </figure>

                <h3 class="mt-5 mb-4" style="color: #446b42">
                    Anggota Kelompok 5
                </h3>

                <div class="row justify-content-center g-4">
                     <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-6 col-md-4 col-lg-2">
                        <img
                            src="../img/kelompok/<?= htmlspecialchars($data['gambar']); ?>"
                            alt="<?= htmlspecialchars($data['nama'] ?? 'Gambar'); ?>"
                            class="img-fluid rounded shadow-sm mb-2"
                        />
                        <p>
                            <a
                                href="<?= $data['link_artikel']; ?>"
                                class="text-decoration-none fw-semibold"
                                style="color: #f8ae84"
                            >
                                <?= $data['nama']; ?> </a
                            ><br />
                            <?= $data['nim']; ?>
                        </p>
                    </div>
 <?php } ?>
                   
                </div>
            </section>
        </main>

        <br />
        <footer
            class="text-center py-4 mt-5"
            style="background-color: #446b42; color: #fffccf"
        >
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
                                style="color: #fffccf"
                            >
                                sdimacsombala1@gmail.com
                            </a>
                        </p>
                        <p class="mb-3">Alamat: Jl. Abdul Kadir No. 47</p>
                    </div>
                    <div
                        class="col-12 col-md-6 d-flex justify-content-center mb-3"
                    >
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
                            referrerpolicy="no-referrer-when-downgrade"
                        >
                        </iframe>
                    </div>
                </div>

                <hr
                    style="border-color: #f8ae84; width: 60%; margin: 15px auto"
                />
                <p class="mb-0">
                    <a
                        href="../index.html"
                        class="text-white text-decoration-none"
                        >&copy; 2025 SD Inpres Maccini Sombala 1</a
                    >
                </p>
            </div>
        </footer>
    </body>
</html>
