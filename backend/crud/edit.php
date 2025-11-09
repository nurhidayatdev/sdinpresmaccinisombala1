<?php
session_start();
include '../koneksi.php';

// Cek apakah user sudah login
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

// Ambil dari session
$nama = $_SESSION['nama']; // dari database (bukan input login)
$email = $_SESSION['email'];

$file = $_GET['file'] ?? '';
$tabel = $_GET['tabel'] ?? '';
$id = $_GET['id'] ?? '';
$bagian = $_GET['bagian'] ?? '';

if (!$tabel || !$id) {
    die("Parameter tabel atau id tidak ditemukan!");
}

$tabel_diizinkan = ['profil_sekolah', 'visi', 'misi', 'tujuan', 'fasilitas_sekolah', 'login'];
if (!in_array($tabel, $tabel_diizinkan)) {
    die("Tabel tidak diizinkan!");
}

$query = mysqli_query($koneksi, "SELECT * FROM $tabel WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
if (!$data) {
    die("Data tidak ditemukan!");
}

if (isset($_POST['update'])) {
    switch ($tabel) {
        case 'profil_sekolah':
            if ($bagian === 'identitas') {
                $nama_sekolah = $_POST['nama_sekolah'];
                $npsn = $_POST['npsn'];
                $jenjang = $_POST['jenjang'];
                $status_sekolah = $_POST['status_sekolah'];
                $alamat = $_POST['alamat'];
                $kecamatan = $_POST['kecamatan'];
                $kabupaten = $_POST['kabupaten'];
                $provinsi = $_POST['provinsi'];
                $negara = $_POST['negara'];
                mysqli_query($koneksi, "UPDATE profil_sekolah SET 
                    nama_sekolah='$nama_sekolah',
                    npsn='$npsn',
                    jenjang='$jenjang',
                    status_sekolah='$status_sekolah',
                    alamat='$alamat',
                    kecamatan='$kecamatan',
                    kabupaten='$kabupaten',
                    provinsi='$provinsi',
                    negara='$negara'
                    WHERE id='$id'");
            } elseif ($bagian === 'pelengkap') {
                $sk_pendirian = $_POST['sk_pendirian'];
                $tanggal_sk = $_POST['tanggal_sk'];
                $status_kepemilikan = $_POST['status_kepemilikan'];
                $kebutuhan_khusus = $_POST['kebutuhan_khusus'];
                $nama_bank = $_POST['nama_bank'];
                $cabang_bank = $_POST['cabang_bank'];
                $rekening_atas_nama = $_POST['rekening_atas_nama'];
                $npwp = $_POST['npwp'];
                mysqli_query($koneksi, "UPDATE profil_sekolah SET 
                    sk_pendirian='$sk_pendirian',
                    tanggal_sk='$tanggal_sk',
                    status_kepemilikan='$status_kepemilikan',
                    kebutuhan_khusus='$kebutuhan_khusus',
                    nama_bank='$nama_bank',
                    cabang_bank='$cabang_bank',
                    rekening_atas_nama='$rekening_atas_nama',
                    npwp='$npwp'
                    WHERE id='$id'");
            } elseif ($bagian === 'lainnya') {
                $kepala_sekolah = $_POST['kepala_sekolah'];
                $operator = $_POST['operator'];
                $akreditasi = $_POST['akreditasi'];
                $kurikulum = $_POST['kurikulum'];
                mysqli_query($koneksi, "UPDATE profil_sekolah SET 
                    kepala_sekolah='$kepala_sekolah',
                    operator='$operator',
                    akreditasi='$akreditasi',
                    kurikulum='$kurikulum'
                    WHERE id='$id'");
            }
            header("Location: dashboard_profil_sekolah.php");
            break;

        case 'visi':
            $pernyataan_visi = $_POST['pernyataan_visi'];
            mysqli_query($koneksi, "UPDATE visi SET 
                pernyataan_visi='$pernyataan_visi'
                WHERE id='$id'");
            header("Location: dashboard_profil_sekolah.php");
            break;

        case 'misi':
            $pernyataan_misi = $_POST['pernyataan_misi'];
            mysqli_query($koneksi, "UPDATE misi SET 
                pernyataan_misi='$pernyataan_misi'
                WHERE id='$id'");
            header("Location: dashboard_profil_sekolah.php");
            break;

        case 'tujuan':
            $pernyataan_tujuan = $_POST['pernyataan_tujuan'];
            mysqli_query($koneksi, "UPDATE tujuan SET 
                pernyataan_tujuan='$pernyataan_tujuan'
                WHERE id='$id'");
            header("Location: dashboard_profil_sekolah.php");
            break;

        case 'fasilitas_sekolah':
            $fasilitas = $_POST['fasilitas'];
            $deskripsi = $_POST['deskripsi'];
            $gambar = $_POST['gambar'];
            mysqli_query($koneksi, "UPDATE fasilitas_sekolah SET 
                fasilitas='$fasilitas',
                deskripsi='$deskripsi',
                gambar='$gambar'
                WHERE id='$id'");
            header("Location: dashboard_fasilitas.php");
            break;

        case 'login':
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            mysqli_query($koneksi, "UPDATE login SET 
                nama='$nama',
                email='$email',
                password='$password'
                WHERE id='$id'");
            header("Location: dashboard_login.php");
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
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css" />
    <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../style.css" />
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
            <li><a class="nav-link " href="../dashboard/dashboard.php"><i data-lucide="grid"></i> Dashboard</a></li>
      <li><a class="nav-link" href="../dashboard/dashboard_profil.php"><i data-lucide="school"></i> Profil</a></li>
      <li><a class="nav-link active" href="../dashboard/dashboard_akademik.php"><i data-lucide="graduation-cap"></i> Akademik</a></li>
      <li><a class="nav-link" href="../dashboard/dashboard_user.php"><i data-lucide="users"></i> User</a></li>
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
            <div class="container">
                <h2 class="fw-bold mb-3 text-warning">Edit</h2>

                <form method="POST">
                    <?php if ($tabel === 'profil_sekolah' && $bagian === 'identitas'): ?>
                        <h4 class="fw-bold mb-3 text-warning">Identitas Sekolah</h4>
                        <div class="mb-3"><label>Nama Sekolah</label>
                            <input type="text" name="nama_sekolah" class="form-control" value="<?= $data['nama_sekolah']; ?>" required>
                        </div>
                        <div class="mb-3"><label>NPSN</label>
                            <input type="text" name="npsn" class="form-control" value="<?= $data['npsn']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Jenjang</label>
                            <input type="text" name="jenjang" class="form-control" value="<?= $data['jenjang']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Status Sekolah</label>
                            <input type="text" name="status_sekolah" class="form-control" value="<?= $data['status_sekolah']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Alamat</label>
                            <textarea name="alamat" class="form-control" required><?= $data['alamat']; ?></textarea>
                        </div>
                        <div class="mb-3"><label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" value="<?= $data['kecamatan']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control" value="<?= $data['kabupaten']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" value="<?= $data['provinsi']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Negara</label>
                            <input type="text" name="negara" class="form-control" value="<?= $data['negara']; ?>" required>
                        </div>

                    <?php elseif ($tabel === 'profil_sekolah' && $bagian === 'pelengkap'): ?>
                        <h4 class="fw-bold mb-3 text-warning">Data Pelengkap</h4>
                        <div class="mb-3"><label>SK Pendirian</label>
                            <input type="text" name="sk_pendirian" class="form-control" value="<?= $data['sk_pendirian']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Tanggal SK</label>
                            <input type="text" name="tanggal_sk" class="form-control" value="<?= $data['tanggal_sk']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Status Kepemilikan</label>
                            <input type="text" name="status_kepemilikan" class="form-control" value="<?= $data['status_kepemilikan']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Kebutuhan Khusus</label>
                            <input type="text" name="kebutuhan_khusus" class="form-control" value="<?= $data['kebutuhan_khusus']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Nama Bank</label>
                            <input type="text" name="nama_bank" class="form-control" value="<?= $data['nama_bank']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Cabang Bank</label>
                            <input type="text" name="cabang_bank" class="form-control" value="<?= $data['cabang_bank']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Rekening Atas Nama</label>
                            <input type="text" name="rekening_atas_nama" class="form-control" value="<?= $data['rekening_atas_nama']; ?>" required>
                        </div>
                        <div class="mb-3"><label>NPWP</label>
                            <input type="text" name="npwp" class="form-control" value="<?= $data['npwp']; ?>" required>
                        </div>

                    <?php elseif ($tabel === 'profil_sekolah' && $bagian === 'lainnya'): ?>
                        <h4 class="fw-bold mb-3 text-warning">Data Lainnya</h4>
                        <div class="mb-3"><label>Kepala Sekolah</label>
                            <input type="text" name="kepala_sekolah" class="form-control" value="<?= $data['kepala_sekolah']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Operator</label>
                            <input type="text" name="operator" class="form-control" value="<?= $data['operator']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Akreditasi</label>
                            <input type="text" name="akreditasi" class="form-control" value="<?= $data['akreditasi']; ?>" required>
                        </div>
                        <div class="mb-3"><label>Kurikulum</label>
                            <input type="text" name="kurikulum" class="form-control" value="<?= $data['kurikulum']; ?>" required>
                        </div>

                    <?php elseif ($tabel === 'visi'): ?>
                        <h4 class="fw-bold mb-3 text-warning">Visi Sekolah</h4>
                        <div class="mb-3"><label>Visi</label>
                            <input type="text" name="pernyataan_visi" class="form-control" value="<?= $data['pernyataan_visi']; ?>">
                        </div>

                    <?php elseif ($tabel === 'misi'): ?>
                        <h4 class="fw-bold mb-3 text-warning">Misi Sekolah</h4>
                        <div class="mb-3"><label>Misi</label>
                            <input type="text" name="pernyataan_misi" class="form-control" value="<?= $data['pernyataan_misi']; ?>">
                        </div>

                    <?php elseif ($tabel === 'tujuan'): ?>
                        <h4 class="fw-bold mb-3 text-warning">Tujuan Sekolah</h4>
                        <div class="mb-3"><label>Tujuan</label>
                            <input type="text" name="pernyataan_tujuan" class="form-control" value="<?= $data['pernyataan_tujuan']; ?>">
                        </div>

                    <?php elseif ($tabel === 'fasilitas_sekolah'): ?>
                        <h4 class="fw-bold mb-3 text-warning">Fasilitas Sekolah</h4>
                        <div class="mb-3"><label>Nama Fasilitas</label>
                            <input type="text" name="fasilitas" class="form-control" value="<?= $data['fasilitas']; ?>">
                        </div>
                        <div class="mb-3"><label>Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" value="<?= $data['deskripsi']; ?>">
                        </div>
                        <div class="mb-3">
                            <label>Upload Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                            <br>
                            <img src="../img/fasilitas/<?php echo htmlspecialchars($data['gambar']); ?>"
                                        alt="<?php echo htmlspecialchars($data['fasilitas']); ?>"
                                        class="img-fluid rounded"
                                        style="max-width:150px; height:auto;" />
                        </div>


                    <?php elseif ($tabel === 'login'): ?>
                        <h4 class="fw-bold mb-3 text-warning">Data Login</h4>
                        <div class="mb-3"><label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>">
                        </div>
                        <div class="mb-3"><label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?= $data['email']; ?>">
                        </div>
                        <div class="mb-3"><label>Password</label>
                            <input type="text" name="password" class="form-control" value="<?= $data['password']; ?>">
                        </div>
                    <?php endif; ?>

                    <button type="submit" name="update" class="btn btn-warning">Simpan Perubahan</button>
                    <a href="dashboard_<?= $file; ?>.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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