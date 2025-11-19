<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

$nama = $_SESSION['nama'];
$email = $_SESSION['email'];

$file = $_GET['file'] ?? '';
$tabel = $_GET['tabel'] ?? '';
$id = $_GET['id'] ?? '';
$bagian = $_GET['bagian'] ?? '';

if (!$tabel || !$id) {
    die("Parameter tabel atau id tidak ditemukan!");
}

$tabel_diizinkan = ['profil_sekolah', 'visi', 'misi', 'tujuan', 'guru', 'mengajar', 'pembina_kegiatan', 'ptk_pd', 'sarpras', 'rombongan_mengajar', 'fasilitas_sekolah', 'berita', 'form_futsal', 'kelompok', 'login'];
if (!in_array($tabel, $tabel_diizinkan)) {
    die("Tabel tidak diizinkan!");
}

$query = mysqli_query($koneksi, "SELECT * FROM $tabel WHERE id='$id'");
$data = mysqli_fetch_assoc($query);
if (!$data) {
    die("Data tidak ditemukan!");
}

if (isset($_POST['update'])) {

    $redirect = ""; 

    switch ($tabel) {

        case 'profil_sekolah':
            if ($bagian === 'identitas') {
                mysqli_query($koneksi, "UPDATE profil_sekolah SET 
                    nama_sekolah='{$_POST['nama_sekolah']}',
                    npsn='{$_POST['npsn']}',
                    jenjang='{$_POST['jenjang']}',
                    status_sekolah='{$_POST['status_sekolah']}',
                    alamat='{$_POST['alamat']}',
                    kecamatan='{$_POST['kecamatan']}',
                    kabupaten='{$_POST['kabupaten']}',
                    provinsi='{$_POST['provinsi']}',
                    negara='{$_POST['negara']}'
                    WHERE id='$id'");
            } elseif ($bagian === 'pelengkap') {
                mysqli_query($koneksi, "UPDATE profil_sekolah SET 
                    sk_pendirian='{$_POST['sk_pendirian']}',
                    tanggal_sk='{$_POST['tanggal_sk']}',
                    status_kepemilikan='{$_POST['status_kepemilikan']}',
                    kebutuhan_khusus='{$_POST['kebutuhan_khusus']}',
                    nama_bank='{$_POST['nama_bank']}',
                    cabang_bank='{$_POST['cabang_bank']}',
                    rekening_atas_nama='{$_POST['rekening_atas_nama']}',
                    npwp='{$_POST['npwp']}'
                    WHERE id='$id'");
            } elseif ($bagian === 'lainnya') {
                mysqli_query($koneksi, "UPDATE profil_sekolah SET 
                    kepala_sekolah='{$_POST['kepala_sekolah']}',
                    operator='{$_POST['operator']}',
                    akreditasi='{$_POST['akreditasi']}',
                    kurikulum='{$_POST['kurikulum']}'
                    WHERE id='$id'");
            };

            $redirect = "../dashboard/dashboard_profil_sekolah.php";
            break;

        case 'visi':
            mysqli_query($koneksi, "UPDATE visi SET 
                pernyataan_visi='{$_POST['pernyataan_visi']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_profil_sekolah.php";
            break;

        case 'misi':
            mysqli_query($koneksi, "UPDATE misi SET 
                pernyataan_misi='{$_POST['pernyataan_misi']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_profil_sekolah.php";
            break;

        case 'tujuan':
            mysqli_query($koneksi, "UPDATE tujuan SET 
                pernyataan_tujuan='{$_POST['pernyataan_tujuan']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_profil_sekolah.php";
            break;

        case 'fasilitas_sekolah':
            mysqli_query($koneksi, "UPDATE fasilitas_sekolah SET 
                fasilitas='{$_POST['fasilitas']}',
                deskripsi='{$_POST['deskripsi']}',
                gambar='{$_POST['gambar']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_fasilitas.php";
            break;

        case 'guru':
            mysqli_query($koneksi, "UPDATE guru SET 
                nama='{$_POST['nama']}',
                nip='{$_POST['nip']}',
                pangkat_gol='{$_POST['pangkat_gol']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_guru.php";
            break;

        case 'mengajar':
            mysqli_query($koneksi, "UPDATE mengajar SET 
                guru_id='{$_POST['guru_id']}',
                jenis_ptk='{$_POST['jenis_ptk']}',
                kelas_mapel='{$_POST['kelas_mapel']}',
                jtm_per_minggu='{$_POST['jtm_per_minggu']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_kegiatan_akademik.php";
            break;

        case 'pembina_kegiatan':
            mysqli_query($koneksi, "UPDATE pembina_kegiatan SET 
                guru_id='{$_POST['guru_id']}',
                tugas_pembinaan='{$_POST['tugas_pembinaan']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_kegiatan_akademik.php";
            break;

        case 'ptk_pd':
            mysqli_query($koneksi, "UPDATE ptk_pd SET 
                uraian='{$_POST['uraian']}',
                guru='{$_POST['guru']}',
                tendik='{$_POST['tendik']}',
                ptk='{$_POST['ptk']}',
                pd='{$_POST['pd']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_info_akademik.php";
            break;

        case 'sarpras':
            mysqli_query($koneksi, "UPDATE sarpras SET 
                uraian='{$_POST['uraian']}',
                jumlah='{$_POST['jumlah']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_info_akademik.php";
            break;

        case 'rombongan_mengajar':
            mysqli_query($koneksi, "UPDATE rombongan_mengajar SET 
                kelas='{$_POST['kelas']}',
                detail='{$_POST['detail']}',
                jumlah='{$_POST['jumlah']}',
                total='{$_POST['total']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_info_akademik.php";
            break;

        case 'berita':
            mysqli_query($koneksi, "UPDATE berita SET 
                judul='{$_POST['judul']}',
                link_youtube='{$_POST['link_youtube']}',
                deskripsi='{$_POST['deskripsi']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_berita.php";
            break;

        case 'form_futsal':
            mysqli_query($koneksi, "UPDATE form_futsal SET 
                nisn='{$_POST['nisn']}',
                nama='{$_POST['nama']}',
                kelas='{$_POST['kelas']}',
                jk='{$_POST['jk']}',
                nohp='{$_POST['nohp']}',
                alasan='{$_POST['alasan']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_futsal.php";
            break;

        case 'kelompok':
            mysqli_query($koneksi, "UPDATE kelompok SET 
                gambar='{$_POST['gambar']}',
                nama='{$_POST['nama']}',
                nim='{$_POST['nim']}',
                link_artikel='{$_POST['link_artikel']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_kelompok.php";
            break;

        case 'login':
            mysqli_query($koneksi, "UPDATE login SET 
                nama='{$_POST['nama']}',
                email='{$_POST['email']}',
                password='{$_POST['password']}'
                WHERE id='$id'");
            $redirect = "../dashboard/dashboard_login.php";
            break;
    }
    
    echo "
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Dashboard - SD Inpres Maccini Sombala 1</title>
    <link rel='icon' href='../img/main/icon.png' />
  <link rel='preconnect' href='https://fonts.googleapis.com'>
    <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
    <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap' rel='stylesheet'>
    <style>
        body { font-family: 'Poppins', sans-serif !important; }
    </style>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
   Swal.fire({
    title: 'Berhasil!',
    text: 'Data berhasil diperbarui!',
    icon: 'success',
    allowOutsideClick: false,
    allowEscapeKey: false,
    confirmButtonText: 'OK'
}).then(() => {
    window.location.href = '$redirect';
});
</script>

    </body>
    </html>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SD Inpres Maccini Sombala 1</title>
    <link rel="icon" href="../img/main/icon.png" />
    <link rel="stylesheet" href="../../bootstrap/dist/css/bootstrap.min.css" />
    <script src="../../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../frontend/style.css" />
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="db">
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
                <h4 class="fw-bold mb-3 text-warning">Edit</h4>

                <form method="POST">
                    <?php if ($tabel === 'profil_sekolah' && $bagian === 'identitas'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Identitas Sekolah</h5>
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
                        <h5 class="fw-bold mb-3 text-warning">Data Pelengkap</h5>
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
                        <h5 class="fw-bold mb-3 text-warning">Data Lainnya</h5>
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
                        <h5 class="fw-bold mb-3 text-warning">Visi Sekolah</h5>
                        <div class="mb-3"><label>Visi</label>
                            <input type="text" name="pernyataan_visi" class="form-control" value="<?= $data['pernyataan_visi']; ?>">
                        </div>

                    <?php elseif ($tabel === 'misi'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Misi Sekolah</h5>
                        <div class="mb-3"><label>Misi</label>
                            <input type="text" name="pernyataan_misi" class="form-control" value="<?= $data['pernyataan_misi']; ?>">
                        </div>

                    <?php elseif ($tabel === 'tujuan'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Tujuan Sekolah</h5>
                        <div class="mb-3"><label>Tujuan</label>
                            <input type="text" name="pernyataan_tujuan" class="form-control" value="<?= $data['pernyataan_tujuan']; ?>">
                        </div>

                    <?php elseif ($tabel === 'fasilitas_sekolah'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Fasilitas Sekolah</h5>
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

                    <?php elseif ($tabel === 'guru'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Data Guru</h5>
                        <div class="mb-3"><label>Nama Guru</label>
                            <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>">
                        </div>
                        <div class="mb-3"><label>NIP</label>
                            <input type="text" name="nip" class="form-control" value="<?= $data['nip']; ?>">
                        </div>
                        <div class="mb-3"><label>Pangkat / Golongan</label>
                            <input type="text" name="pangkat_gol" class="form-control" value="<?= $data['pangkat_gol']; ?>">
                        </div>

                    <?php elseif ($tabel === 'mengajar'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Data Mengajar</h5>
                        <div class="mb-3">
                            <label>Guru</label>
                            <select name="guru_id" class="form-select" required>
                                <option value="">-- Pilih Guru --</option>
                                <?php
                                $query_guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama ASC");
                                while ($guru = mysqli_fetch_assoc($query_guru)) {
                                    $selected = ($data['guru_id'] == $guru['id']) ? 'selected' : '';
                                    echo "<option value='{$guru['id']}' $selected>{$guru['nama']} - {$guru['nip']} ({$guru['pangkat_gol']})</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3"><label>Jenis PTK</label>
                            <input type="text" name="jenis_ptk" class="form-control" value="<?= $data['jenis_ptk']; ?>">
                        </div>
                        <div class="mb-3"><label>Kelas & Mata Pelajaran</label>
                            <input type="text" name="kelas_mapel" class="form-control" value="<?= $data['kelas_mapel']; ?>">
                        </div>
                        <div class="mb-3"><label>JTM per Minggu</label>
                            <input type="number" name="jtm_per_minggu" class="form-control" value="<?= $data['jtm_per_minggu']; ?>">
                        </div>

                    <?php elseif ($tabel === 'pembina_kegiatan'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Pembina Kegiatan</h5>
                        <div class="mb-3">
                            <label>Guru</label>
                            <select name="guru_id" class="form-select" required>
                                <option value="">-- Pilih Guru --</option>
                                <?php
                                $query_guru = mysqli_query($koneksi, "SELECT * FROM guru ORDER BY nama ASC");
                                while ($guru = mysqli_fetch_assoc($query_guru)) {
                                    $selected = ($data['guru_id'] == $guru['id']) ? 'selected' : '';
                                    echo "<option value='{$guru['id']}' $selected>{$guru['nama']} - {$guru['nip']} ({$guru['pangkat_gol']})</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3"><label>Tugas Pembinaan</label>
                            <input type="text" name="tugas_pembinaan" class="form-control" value="<?= $data['tugas_pembinaan']; ?>">
                        </div>

                    <?php elseif ($tabel === 'ptk_pd'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Data PTK dan PD</h5>
                        <div class="mb-3"><label>Uraian</label>
                            <input type="text" name="uraian" class="form-control" value="<?= $data['uraian']; ?>">
                        </div>
                        <div class="mb-3"><label>Guru</label>
                            <input type="text" name="guru" class="form-control" value="<?= $data['guru']; ?>">
                        </div>
                        <div class="mb-3"><label>Tendik</label>
                            <input type="text" name="tendik" class="form-control" value="<?= $data['tendik']; ?>">
                        </div>
                        <div class="mb-3"><label>PTK</label>
                            <input type="text" name="ptk" class="form-control" value="<?= $data['ptk']; ?>">
                        </div>
                        <div class="mb-3"><label>PD</label>
                            <input type="text" name="pd" class="form-control" value="<?= $data['pd']; ?>">
                        </div>

                    <?php elseif ($tabel === 'sarpras'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Data Sarana dan Prasarana</h5>
                        <div class="mb-3">
                            <label>Uraian</label>
                            <input type="text" name="uraian" class="form-control"
                                value="<?= htmlspecialchars($data['uraian']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control"
                                value="<?= htmlspecialchars($data['jumlah']); ?>" required>
                        </div>

                    <?php elseif ($tabel === 'rombongan_mengajar'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Data Rombongan Belajar</h5>
                        <div class="mb-3"><label>Kelas</label>
                            <input type="text" name="kelas" class="form-control" value="<?= $data['kelas']; ?>">
                        </div>
                        <div class="mb-3"><label>Detail</label>
                            <input type="text" name="detail" class="form-control" value="<?= $data['detail']; ?>">
                        </div>
                        <div class="mb-3"><label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah']; ?>">
                        </div>
                        <div class="mb-3"><label>Total</label>
                            <input type="number" name="total" class="form-control" value="<?= $data['total']; ?>">
                        </div>

                    <?php elseif ($tabel === 'berita'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Data Berita</h5>
                        <div class="mb-3"><label>Judul Berita</label>
                            <input type="text" name="judul" class="form-control" value="<?= $data['judul']; ?>">
                        </div>
                        <div class="mb-3"><label>Link YouTube</label>
                            <input type="text" name="link_youtube" class="form-control" value="<?= $data['link_youtube']; ?>">
                        </div>
                        <div class="mb-3"><label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"><?= $data['deskripsi']; ?></textarea>
                        </div>

                    <?php elseif ($tabel === 'form_futsal'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Formulir Futsal</h5>
                        <div class="mb-3"><label>NISN</label>
                            <input type="text" name="nisn" class="form-control" value="<?= $data['nisn']; ?>">
                        </div>
                        <div class="mb-3"><label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>">
                        </div>
                        <div class="mb-3"><label>Kelas</label>
                            
                            <select name="kelas" class="form-control">
                                <option value="4" <?= $data['kelas'] == '4' ? 'selected' : ''; ?>>Kelas 4</option>
                                <option value="5" <?= $data['kelas'] == '5' ? 'selected' : ''; ?>>Kelas 5</option>
                                <option value="6" <?= $data['kelas'] == '6' ? 'selected' : ''; ?>>Kelas 6</option>
                                
                            </select>
                        </div>
                        <div class="mb-3"><label>Jenis Kelamin</label>
                            <select name="jk" class="form-control">
                                <option value="Laki-laki" <?= $data['jk'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                                <option value="Perempuan" <?= $data['jk'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3"><label>No. HP</label>
                            <input type="text" name="nohp" class="form-control" value="<?= $data['nohp']; ?>">
                        </div>
                        <div class="mb-3"><label>Alasan</label>
                            <textarea name="alasan" class="form-control" rows="3"><?= $data['alasan']; ?></textarea>
                        </div>

                    <?php elseif ($tabel === 'kelompok'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Data Kelompok</h5>
                        <div class="mb-3"><label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>">
                        </div>
                        <div class="mb-3"><label>NIM</label>
                            <input type="text" name="nim" class="form-control" value="<?= $data['nim']; ?>">
                        </div>
                        <div class="mb-3"><label>Link Artikel</label>
                            <input type="text" name="link_artikel" class="form-control" value="<?= $data['link_artikel']; ?>">
                        </div>
                        <div class="mb-3">
                            <label>Upload Gambar</label>
                            <input type="file" name="gambar" class="form-control">
                            <input type="hidden" name="gambar_lama" value="<?= $data['gambar']; ?>">
                            <br>
                            <img src="../img/kelompok/<?php echo htmlspecialchars($data['gambar']); ?>"
                                alt="<?php echo htmlspecialchars($data['nama']); ?>"
                                class="img-fluid rounded"
                                style="max-width:150px; height:auto;" />
                        </div>

                    <?php elseif ($tabel === 'login'): ?>
                        <h5 class="fw-bold mb-3 text-warning">Data Login</h5>
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
                    <button type="submit" name="update" class="btn-db btn-cl me-2 mt-2" id="saveBtn">Simpan</button>
                    <a href="../dashboard/dashboard_<?= $file; ?>.php" class="btn-db btn-add">Kembali</a>
                </form>
            </div>
        </div>
        <p class="text-center mb-0 mt-4">
                © 2025 SD Inpres Maccini Sombala 1 — All Rights Reserved
            </p>
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