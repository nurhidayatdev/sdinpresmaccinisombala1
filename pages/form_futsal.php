<?php
include '../koneksi.php';

$alert_status = '';
$alert_message = '';

if (isset($_POST['tambah'])) {
    $nisn = trim($_POST['nisn']);
    $nama = trim($_POST['nama']);
    $kelas = trim($_POST['kelas']);
    $jk = trim($_POST['jk']);
    $nohp = trim($_POST['nohp']);
    $alasan = trim($_POST['alasan']);

    if (
        !preg_match('/^\d{10}$/', $nisn) ||
        empty($nama) ||
        empty($kelas) ||
        empty($jk) ||
        !preg_match('/^\d{10,13}$/', $nohp) ||
        empty($alasan)
    ) {
        $alert_status = 'error';
        $alert_message = 'Input tidak valid! Mohon isi semua kolom dengan benar.';
    } else {
        mysqli_query($koneksi, "INSERT INTO form_futsal (nisn, nama, kelas, jk, nohp, alasan)
                    VALUES ('$nisn', '$nama', '$kelas', '$jk', '$nohp', '$alasan')");
        $alert_status = 'success';
        $alert_message = 'Pendaftaran berhasil! Data kamu sudah disimpan.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Formulir Pendaftaran Ekskul Futsal - SD Negeri Maccini Sombala 1</title>

    <link rel="icon" href="../backend/img/main/icon.png" />
    <link rel="stylesheet" href="../bootstrap/dist/css/bootstrap.min.css" />
    <script src="../bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../frontend/style.css" />
    <script src="../jquery/dist/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body style="background-image: url('../backend/img/main/bg-login.svg');

 min-height: 100vh;">
    <div class="container">
        <div class="form-card">
            <h2>⚽ Formulir Pendaftaran Ekskul Futsal ⚽</h2>
            <p class="text-center text-success mb-3"><strong>SD Negeri Maccini Sombala 1</strong></p>

            <form method="POST" enctype="multipart/form-data" id="futsalForm">
                <div class="mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" placeholder="Masukkan NISN (10 digit)" />
                    <div class="invalid-feedback">NISN wajib diisi dan harus berupa 10 digit angka.</div>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama lengkap" />
                    <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                </div>

                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select id="kelas" class="form-select" name="kelas">
                        <option value="">Pilih kelas...</option>
                        <option value="4">Kelas 4</option>
                        <option value="5">Kelas 5</option>
                        <option value="6">Kelas 6</option>
                    </select>
                    <div class="invalid-feedback">Silakan pilih kelas.</div>
                </div>

                <div class="mb-3">
                    <label for="jk" class="form-label">Jenis Kelamin</label>
                    <select id="jk" class="form-select" name="jk">
                        <option value="">Pilih jenis kelamin...</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <div class="invalid-feedback">Silakan pilih jenis kelamin.</div>
                </div>

                <div class="mb-3">
                    <label for="nohp" class="form-label">Nomor HP Orang Tua</label>
                    <input type="number" class="form-control" id="nohp" name="nohp" placeholder="Contoh: 081234567890" />
                    <div class="invalid-feedback">Nomor HP wajib diisi dan hanya angka.</div>
                </div>

                <div class="mb-3">
                    <label for="alasan" class="form-label">Alasan Ingin Mengikuti Ekskul Futsal</label>
                    <textarea class="form-control" id="alasan" name="alasan" rows="3" placeholder="Tulis alasan kamu di sini..."></textarea>
                    <div class="invalid-feedback">Alasan wajib diisi.</div>
                </div>

                <button type="submit" name="tambah" class="btn btn-submit">Daftar</button>
            </form>

            <div class="footer">© 2025 SD Negeri Maccini Sombala 1</div>
        </div>
    </div>

    <script>
        // Validasi client-side
        $("#futsalForm").on("submit", function(e) {
            let valid = true;

            const nisn = $("#nisn").val().trim();
            const nama = $("#nama").val().trim();
            const kelas = $("#kelas").val();
            const jk = $("#jk").val();
            const nohp = $("#nohp").val().trim();
            const alasan = $("#alasan").val().trim();

            $("input, select, textarea").removeClass("is-invalid");

            if (!/^\d{10}$/.test(nisn)) {
                $("#nisn").addClass("is-invalid");
                valid = false;
            }

            if (nama === "") {
                $("#nama").addClass("is-invalid");
                valid = false;
            }

            if (kelas === "") {
                $("#kelas").addClass("is-invalid");
                valid = false;
            }

            if (jk === "") {
                $("#jk").addClass("is-invalid");
                valid = false;
            }

            if (!/^\d{10,13}$/.test(nohp)) {
                $("#nohp").addClass("is-invalid");
                valid = false;
            }

            if (alasan === "") {
                $("#alasan").addClass("is-invalid");
                valid = false;
            }

            if (!valid) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Harap isi semua kolom dengan benar sebelum mendaftar.',
                    confirmButtonColor: '#dc3545'
                });
            }
        });

        // Menampilkan alert dari PHP (server-side)
        <?php if ($alert_status === 'success'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= $alert_message ?>',
                confirmButtonColor: '#198754'
            }).then(() => {
                window.location.href = "berita.php";
            });
        <?php elseif ($alert_status === 'error'): ?>
            Swal.fire({
                icon: 'error',
                title: 'Input Tidak Valid!',
                text: '<?= $alert_message ?>',
                confirmButtonColor: '#dc3545'
            });
        <?php endif; ?>
    </script>
</body>

</html>